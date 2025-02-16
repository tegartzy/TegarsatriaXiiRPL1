<?php

namespace App\Http\Controllers;

use App\Models\Tugas;
use App\Models\SubTugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TugasController extends Controller
{

    public function read(Request $request)
{
    // Ambil parameter sorting dari request
    $sort = $request->query('sort', 'created_at'); // Default: sorting by created_at

    // Query untuk mengambil tugas berdasarkan user_id dan sorting
    $tugas = Tugas::where('user_id', Auth::id())
        ->with('subTugas') // Eager load subTugas
        ->when($sort, function ($query, $sort) {
            switch ($sort) {
                case 'created_at':
                    return $query->orderBy('created_at', 'desc'); // Terbaru pertama
                case 'deadline':
                    return $query->orderBy('deadline', 'asc'); // Deadline terdekat pertama
                case 'prioritas':
                    return $query->orderBy('prioritas', 'asc'); // Prioritas tertinggi (angka terkecil) pertama
                default:
                    return $query->orderBy('created_at', 'desc'); // Default sorting
            }
        })
        ->get(); // Ambil data

    return view('tugas.read', compact('tugas', 'sort'));
}
    // public function read()
    // {
    //     $tugas = Tugas::where('user_id', Auth::id())->with('subTugas')->get();
    //     return view('tugas.read', compact('tugas'));

    //     // Ambil parameter sorting dari request
    //     $sort = $request->query('sort', 'created_at'); // Default: sorting by created_at

    //     $sort = $request->query('sort', 'created_at'); // Default: sorting by created_at

    //     // Query untuk sorting
    //     $tugas = Tugas::query();

    //     switch ($sort) {
    //         case 'created_at':
    //             $tugas->orderBy('created_at', 'desc'); // Terbaru pertama
    //             break;
    //         case 'deadline':
    //             $tugas->orderBy('deadline', 'asc'); // Deadline terdekat pertama
    //             break;
    //         case 'prioritas':
    //             $tugas->orderBy('prioritas', 'asc'); // Prioritas tertinggi (angka terkecil) pertama
    //             break;
    //         default:
    //             $tugas->orderBy('created_at', 'desc'); // Default sorting
    //             break;
    //     }

    //     $tugas = $tugas->get();

    //     return view('tugas.read', compact('tugas', 'sort'));
    // }

    public function create()
    {
        return view('tugas.create');
    }

    public function submit(Request $request)
    {
        $request->validate([
            'tugas' => 'required|string|max:255',
            'deadline' => 'required|date',
            'prioritas' => 'required|integer',
        ]);

        Tugas::create([
            'user_id' => Auth::id(),
            'tugas' => $request->tugas,
            'deadline' => $request->deadline,
            'prioritas' => $request->prioritas,
            'status' => 'Belum Selesai',
        ]);

        return redirect()->route('tugas.read')->with('success', 'Tugas berhasil ditambahkan!');
    }


    public function edit($id)
    {
        $tugas = Tugas::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        return view('tugas.edit', compact('tugas'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'tugas' => 'required|string|max:255',
            'deadline' => 'required|date',
        ]);

        // Temukan tugas berdasarkan ID
        $tugas = Tugas::find($id);

        // Jika tugas tidak ditemukan
        if (!$tugas) {
            return redirect()->route('tugas.read')->with('error', 'Tugas tidak ditemukan.');
        }

        // Update data tugas
        $tugas->update([
            'tugas' => $request->tugas,
            'deadline' => $request->deadline,

        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('tugas.read')->with('success', 'Tugas berhasil diupdate!');
    }

    public function delete($id)
    {
        $tugas = Tugas::where('id', $id)->where('user_id', Auth::id())->firstOrFail();


        $tugas->delete();
        return redirect()->route('tugas.read')->with('success', 'Tugas berhasil dihapus!');
    }



    public function toggleStatus($id)
    {
        $tugas = Tugas::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        if ($tugas->isPastDeadline() || $tugas->status === 'Selesai') {
            return redirect()->route('tugas.read')->with('error', 'Tidak dapat mengubah status!');
        }

        $tugas->status = 'Selesai';
        $tugas->save();

        return redirect()->route('tugas.read')->with('success', 'Status tugas diperbarui!');

    }

    public function toggleSubTugasStatus($id)
    {
        $subTugas = SubTugas::where('id', $id)->whereHas('tugas', function ($query) {
            $query->where('user_id', Auth::id());
        })->firstOrFail();

        if ($subTugas->tugas->isPastDeadline() || $subTugas->status === 'Selesai') {
            return redirect()->route('tugas.read')->with('error', 'Tidak dapat mengubah status!');
        }

        $subTugas->status = 'Selesai';
        $subTugas->save();

        return redirect()->route('tugas.read')->with('success', 'Status sub-tugas diperbarui!');
    }

    public function addSubTugas(Request $request, $tugas_id)
    {
        $tugas = Tugas::where('id', $tugas_id)->where('user_id', Auth::id())->firstOrFail();

        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        SubTugas::create([
            'tugas_id' => $tugas->id,
            'user_id' => Auth::id(),
            'nama' => $request->nama,
            'status' => 'Belum Selesai',
        ]);

        return redirect()->route('tugas.read')->with('success', 'Sub-tugas berhasil ditambahkan!');
    }


}

