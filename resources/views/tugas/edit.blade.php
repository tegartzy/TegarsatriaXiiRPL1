<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Tugas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Tugas</h2>
        <form action="{{ route('tugas.update', $tugas->id) }}" method="POST">
            @csrf
            @method('PATCH')  <!-- HARUS pakai PATCH agar sesuai dengan route -->

            <div class="mb-3">
                <label for="tugas" class="form-label">Tugas</label>
                <input type="text" name="tugas" id="tugas" class="form-control" value="{{ $tugas->tugas }}" required>
            </div>

            <div class="mb-3">
                <label for="deadline" class="form-label">Deadline</label>
                <input type="date" name="deadline" id="deadline" class="form-control" value="{{ $tugas->deadline }}" required>
            </div>

            <div class="mb-3">
                <label for="prioritas" class="form-label">Prioritas</label>
                <input type="number" name="prioritas" id="prioritas" class="form-control" value="{{ $tugas->prioritas }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('tugas.read') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</body>
</html>
