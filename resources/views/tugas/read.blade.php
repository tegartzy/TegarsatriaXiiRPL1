@include('layouts.navbar')
<style>
    .card-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      align-items: center;
    }
  
    .card {
      width: 300px;
      border-radius: 10px;
      box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
      padding: 15px;
      display: flex;
      flex-direction: column;
      margin: 0 auto;
      margin-top: 2%;
    }
  
    .cardHead {
      width: 90%;
      border-radius: 10px;
      box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
      padding: 15px;
      display: flex;
      flex-direction: column;
      margin: 0 auto;
      justify-content: center;
      align-items: center;
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
  
    .plus-button {
      display: flex;
      justify-content: center;
      align-items: center;
      width: 900px;
      height: 80px;
      border: 2px dashed rgb(0, 0, 0);
      border-radius: 10px;
      margin: 0 auto;
    }
  
    .plus-button svg {
      width: 40px;
      color: black; 
      height: 40px;
    }
  
    @media (max-width: 768px) {
      .card-container {
        flex-direction: column;
      }
      .card {
        width: 100%;
      }
      .plus-button {
        width: 100%;
      }
    }
  
    @media (max-width: 480px) {
      .card {
        padding: 10px;
      }
      .cardHead {
        padding: 10px;
      }
      .sub-tugas {
        padding: 0;
      }
      .form-tambah-subtugas {
        flex-direction: column;
      }
    }
  </style>
  
  <div class="container mt-3">
    <div class="cardHead">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-center">
          <button class="plus-button" onclick="window.location='{{ route('tugas.create') }}'">
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-plus"
              viewBox="0 0 16 16">
              <path
                d="M8 1a.5.5 0 0 1 .5.5V7.5h6a.5.5 0 0 1 0 1h-6v6a.5.5 0 0 1-1 0v-6h-6a.5.5 0 0 1 0-1h6V1.5A.5.5 0 0 1 8 1z" />
            </svg>
          </button>
        </div>
  
        <div class="row mt-4">
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
                            <a href="{{ route('tugas.update', $item->id) }}" class="btn btn-warning"><i class="bi bi-pencil"></i></a>
                            
                           
                        @endif

                         <!-- Form untuk menghapus tugas -->
                         <form action="{{ route('tugas.delete', $item->id) }}" method="POST" class="d-inline mt-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"><i class="bi bi-trash3"></i></button>
                        </form>
                    </div>

                </div>
            @endforeach
        @else
            <p class="text-center">Tidak ada tugas yang tersedia.</p>
        @endif
        </div>
      </div>
    </div>
  </div>