@include('layouts.navbar')

<style>
    body {
        background-color: #e5e5ff;
    }

    .card-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
    }

    .card,
    .cardHead {

        width: 300px;
        border-radius: 10px;
        box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
        padding: 15px;
        display: flex;
        flex-direction: column;
        margin: 2% auto;
    }

    .cardHead {
        background-color: #56568f;
        width: 90%;
        justify-content: center;
        align-items: center;
    }

    .card{
        background-color: #e5e5ff;
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
        border: 2px solid #9f9fe0;
        border-radius: 10px;
        background-color: #f5f0ff;
        color: purple;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .plus-button svg {
        width: 40px;
        height: 40px;
        color: #9f9fe0;
    }

    .plus-button:hover {
        background-color: #9f9fe0;
        color: white;
    }

    .plus-button:hover svg {
        color: white;
    }

    .warna-ungu{
        background-color: #e5e5ff;
        border: 2px solid #e5e5ff;
        color:black; 
    }    

    .warna-ungu:hover {
        background-color: #9f9fe0;
        border:2px solid #9f9fe0;
        color:white;
    }

    footer {
        background-color: #333;
        color: white;
        width: 100%;
        position: absolute;
        margin-top: 30px;
    }

    @media (max-width: 768px) {
        .card-container {
            flex-direction: column;
        }

        .card,
        .plus-button {
            width: 100%;
        }
    }

    @media (max-width: 480px) {

        .card,
        .cardHead {
            padding: 10px;
        }

        .form-tambah-subtugas {
            flex-direction: column;
        }
    }
</style>


<div class="container mt-3">
    <!-- Modal untuk Edit Tugas -->
    <div class="modal fade" id="editTugasModal" tabindex="-1" aria-labelledby="editTugasModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editTugasModalLabel">Edit Tugas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editTugasForm" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="tugas" class="form-label">Nama Tugas</label>
                            <input type="text" class="form-control" id="tugas" name="tugas" required>
                        </div>
                        <div class="mb-3">
                            <label for="deadline" class="form-label">Deadline</label>
                            <input type="datetime-local" class="form-control" id="deadline" name="deadline" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="cardHead">
        <div class="card-body">
            <!-- Tombol Tambah Tugas -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <button class="plus-button" onclick="window.location='{{ route('tugas.create') }}'">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                        <path
                            d="M8 1a.5.5 0 0 1 .5.5V7.5h6a.5.5 0 0 1 0 1h-6v6a.5.5 0 0 1-1 0v-6h-6a.5.5 0 0 1 0-1h6V1.5A.5.5 0 0 1 8 1z" />
                    </svg>
                </button>
            </div>


            <!-- Form Search dan Sorting -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <!-- Form Search -->
                <form action="{{ route('tugas.read') }}" method="GET" class="d-flex gap-2">
                    <input type="text" name="search" class="form-control" placeholder="Cari tugas..."
                        value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary warna-ungu"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                      </svg>
                    </button>
                    @if (request('search'))
                        <a href="{{ route('tugas.read') }}" class="btn btn-secondary warna-ungu"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                            <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
                          </svg></a>
                    @endif
                </form>

                <!-- Form Sorting -->
                <form action="{{ route('tugas.read') }}" method="GET" class="d-flex gap-2">
                    <select name="sort" id="sort" class="form-select" onchange="this.form.submit()">
                        <option value="created_at" {{ request('sort') == 'created_at' ? 'selected' : '' }}>Waktu
                            Ditambahkan</option>
                        <option value="deadline" {{ request('sort') == 'deadline' ? 'selected' : '' }}>Deadline</option>
                        <option value="prioritas" {{ request('sort') == 'prioritas' ? 'selected' : '' }}>Prioritas
                        </option>
                    </select>
                </form>
            </div>

            <!-- Daftar Tugas -->
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
                            <p>Prioritas: <strong
                                    class="prioritas-{{ $item->prioritas }}">{{ $item->prioritas_text }}</strong></p>

                            <!-- Form untuk mengubah status tugas -->
                            <form id="toggle-tugas-{{ $item->id }}"
                                action="{{ route('tugas.toggleStatus', $item->id) }}" method="POST" class="d-none">
                                @csrf
                                @method('PATCH')
                            </form>

                            <!-- Menampilkan daftar sub-tugas jika ada -->
                            @if ($item->subTugas->count() > 0)
                                <ul class="sub-tugas">
                                    @foreach ($item->subTugas as $sub)
                                        <li
                                            class="{{ $sub->status === 'Selesai' ? 'text-decoration-line-through' : '' }}">
                                            <!-- Checkbox untuk menandai sub-tugas selesai -->
                                            <input type="checkbox"
                                                onclick="event.preventDefault(); document.getElementById('toggle-subtugas-{{ $sub->id }}').submit();"
                                                {{ $sub->status === 'Selesai' || $item->isPastDeadline() ? 'disabled' : '' }}>
                                            {{ $sub->nama }}

                                            <!-- Form untuk mengubah status sub-tugas -->
                                            <form id="toggle-subtugas-{{ $sub->id }}"
                                                action="{{ route('subtugas.toggleStatus', $sub->id) }}" method="POST"
                                                class="d-none">
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
                                    <form action="{{ route('subtugas.submit', $item->id) }}" method="POST"
                                        class="form-tambah-subtugas">
                                        @csrf
                                        <input type="text" name="nama" class="form-control"
                                            placeholder="Tambah sub-tugas..." required>
                                        <button type="submit" class="btn btn-primary">+</button>
                                    </form>

                                    <!-- Tombol untuk mengedit tugas -->
                                    <a href="#" class="btn btn-warning" data-id="{{ $item->id }}"
                                        data-name="{{ $item->tugas }}"
                                        data-deadline="{{ date('Y-m-d\TH:i', strtotime($item->deadline)) }}">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                @endif

                                <!-- Form untuk menghapus tugas -->
                                <form action="{{ route('tugas.delete', $item->id) }}" method="POST"
                                    class="delete-form d-inline mt-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"><i
                                            class="bi bi-trash3"></i></button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="text-center">Tidak ada tugas yang ditemukan.</p>
                @endif
            </div>
        </div>
    </div>
</div>

<footer class="text-center bg-gray-800 text-white">
    <p>Alamat email: <a href="tegarsatria106@gmail.com">tegarsatria106@gmail.com</a> Nomor telepon: <a
            href="tel:+6289516088293">+6289516088293</a></p>
    <p>&copy; 2025 Tegar satria. All rights reserved.</p>

</footer>


<!-- Script untuk Modal dan Konfirmasi -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Tangkap semua tombol edit
        const editButtons = document.querySelectorAll('.btn-warning');
        editButtons.forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault(); // Mencegah navigasi default
                const tugasId = button.getAttribute('data-id');
                const tugasName = button.getAttribute('data-name');
                const tugasDeadline = button.getAttribute('data-deadline');

                // Isi form modal dengan data yang ada
                document.getElementById('tugas').value = tugasName;
                document.getElementById('deadline').value = tugasDeadline;
                document.getElementById('editTugasForm').action = `/tugas/${tugasId}`;

                // Tampilkan modal
                const modal = new bootstrap.Modal(document.getElementById('editTugasModal'));
                modal.show();
            });
        });

        // Konfirmasi sebelum menghapus
        const deleteForms = document.querySelectorAll('.delete-form');
        deleteForms.forEach(form => {
            form.addEventListener('submit', function(event) {
                event.preventDefault(); // Mencegah form submit langsung
                if (confirm('Apakah Anda yakin ingin menghapus tugas ini?')) {
                    form.submit(); // Lanjutkan submit jika dikonfirmasi
                }
            });
        });
    });
</script>
