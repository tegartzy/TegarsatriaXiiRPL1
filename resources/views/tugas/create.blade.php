@include('layouts.navbar')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <style>
        
    </style>

</head>

<body class="text-center">
    <div class="container">
        <div class="card">
            <h2>Tambah Tugas</h2>
            <form action="{{ route('tugas.submit') }}" method="post">
                @csrf
                <label for="tugas">Tugas</label>
                <input type="text" name="tugas" class="form-control mb-3" required>

                {{-- <label for="sub_tugas">Sub Tugas</label>
            <input type="text" name="sub_tugas" class="form-control mb-3"> --}}

                <label for="deadline">Deadline</label>
                <input type="datetime-local" name="deadline" class="form-control mb-3" required>

                <label for="prioritas">Prioritas</label>
                <select name="prioritas" class="form-control mb-3" required>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                </select>

                <button class="btn btn-primary">Tambah</button>
            </form>
        </div>
    </div>
</body>

</html>
