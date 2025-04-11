@include('layouts.navbar')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <style>
        body,
        html {
            margin: 0;
            padding: 0;
            height: 100%;
            background-color: #e5e5ff;
        }

        .container {
            height: 70%;
            justify-content: center;
            align-content: center;
            display: flex;
        }

        .card {
            margin-top: 70px;
            background-color: #9f9fe0;
            padding: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            width: 100%;
            max-width: 500px;
        }
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
                <input type="datetime-local" name="deadline" id="deadline" class="form-control mb-3" required>


                <label for="prioritas">Prioritas</label>
                <select id="prioritas" name="prioritas" class="form-control mb-3" required>
                    <option value="1" style="color: #ff0000;">GENTING !!!🔥🔥🔥</option>
                    <option value="2" style="color: #ff8800;">Penting </option>
                    <option value="3" style="color: #21adff;">Tidak buru buru</option>
                    <option value="4" style="color: #4fff7b;">Santaiii ~~~</option>
                </select>


                <button class="btn btn-primary">Tambah</button>
            </form>
        </div>
    </div>
</body>

<script>
    //setting untuk milih tanggal
    document.addEventListener('DOMContentLoaded', function () {
        const now = new Date();
        now.setMinutes(now.getMinutes() - now.getTimezoneOffset()); // supaya sesuai zona waktu lokal

        const formatted = now.toISOString().slice(0,16); // ambil format 'YYYY-MM-DDTHH:MM'
        document.getElementById('deadline').min = formatted;
    });

    //warna isi select
    const select = document.getElementById('prioritas');

    function updateColor() {
        const selectedOption = select.options[select.selectedIndex];
        select.style.color = selectedOption.style.color;
    }

    select.addEventListener('change', updateColor);

    // Set initial color on load
    window.addEventListener('DOMContentLoaded', updateColor);
</script>


</html>
