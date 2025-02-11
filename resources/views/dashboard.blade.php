
    <style>
   
        .card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

     
        .card {
            width: 300px;
            border-radius: 10px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
            padding: 15px;
            display: flex;
            flex-direction: column;
        }

    
        .sub-tugas {
            list-style: none;
            padding: 0;
            margin-bottom: 10px;
        }

        .sub-tugas li {
            margin-bottom: 5px;
        }


        .form-tambah-subtugas {
            display: flex;
            gap: 5px;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    @include('layouts.navbar')

    <div class="container mt-3">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Daftar Tugas</h2>
            <a class="btn btn-success" href="{{ route('tugas.create') }}">Tambah Tugas</a>
        </div>

        <div class="card-container mt-4">
            @if (!empty($tugas) && count($tugas) > 0)
                @foreach ($tugas as $item)
                    <div class="card {{ $item->status === 'Selesai' ? 'text-decoration-line-through' : '' }}">
                        <h3>
                            <!-- Checkbox untuk menandai tugas selesai -->
                            <input type="checkbox" 
                                   onclick="event.preventDefault(); document.getElementById('toggle-tugas-{{ $item->id }}').submit();"
                                   {{ $item->status === 'Selesai' || $item->isPastDeadline() ? 'disabled' : '' }}>
                            {{ $item->tugas }}
                        </h3>
                        <p>Deadline: {{ $item->deadline }}</p>
                        <p>Status: <strong>{{ $item->status }}</strong></p>

                        <!-- Form untuk mengubah status tugas -->
                        <form id="toggle-tugas-{{ $item->id }}" 
                              action="{{ route('tugas.toggleStatus', $item->id) }}" 
                              method="POST" class="">
                            @csrf
                            @method('PATCH')
                        </form>

                        <!-- Menampilkan daftar sub-tugas jika ada -->
                        @if ($item->subTugas->count() > 0)
                            <ul class="sub-tugas">
                                @foreach ($item->subTugas as $sub)
                                    <li class="{{ $sub->status === 'Selesai' ? 'text-decoration-line-through' : '' }}">
                                        
                                        <!-- Checkbox untuk menandai sub-tugas selesai -->
                                        <input type="checkbox" 
                                               onclick="event.preventDefault(); document.getElementById('toggle-subtugas-{{ $sub->id }}').submit();"
                                               {{ $sub->status === 'Selesai' || $item->isPastDeadline() ? 'disabled' : '' }}>
                                        {{ $sub->nama }}

                                        <!-- Form untuk mengubah status sub-tugas -->
                                        <form id="toggle-subtugas-{{ $sub->id }}" 
                                              action="{{ route('subtugas.toggleStatus', $sub->id) }}" 
                                              method="POST" class="d-none">
                                            @csrf
                                            @method('PATCH')
                                        </form>
                                    </li>
                                @endforeach
                            </ul>
                        @endif

                        <!-- Bagian untuk menambahkan sub-tugas dan tombol aksi -->
                        <div class="mt-auto">
                            @if (!$item->isPastDeadline() && $item->status !== 'Selesai')
                                <!-- Form untuk menambahkan sub-tugas -->
                                <form action="{{ route('subtugas.submit', $item->id) }}" method="POST" class="form-tambah-subtugas">
                                    @csrf
                                    <input type="text" name="nama" class="form-control" placeholder="Tambah sub-tugas..." required>
                                    <button type="submit" class="btn btn-primary">+</button>
                                </form>

                                <!-- Tombol untuk mengedit tugas -->               
                                <a href="{{ route('tugas.edit', $item->id) }}" class="btn btn-warning mt-2">Edit</a>
                                
                            @endif

                             <!-- Form untuk menghapus tugas -->
                             <form action="{{ route('tugas.delete', $item->id) }}" method="POST" class="d-inline mt-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </div>

                    </div>
                @endforeach
            @else
                <p class="text-center">Tidak ada tugas yang tersedia.</p>
            @endif
        </div>
    </div>
</body>
</html>


{{-- git remote add origin https://github.com/tegartzy/todolistTegar.git --}}
