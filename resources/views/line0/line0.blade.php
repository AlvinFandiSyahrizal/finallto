<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>

    <div class="content">
        @yield('content')

    <div class="container">
        <h1 class="display-4">hello world</h1>
    </div>

    <div class="container">
        <form action="" method="post" enctype="multipart/form-data" name="ContohUploadCSV" id="ContohUploadCSV">
            <p>Pilih file CSV
                <input type="file" id="csvFileInput" accept=".csv" />
                <button id="hapusTabel" type="button">Hapus Tabel</button>
            </p>
        </form>
    </div>

    <div class="container">
        <table id="csvTable" class="table table-bordered">
        </table>
    </div>

    <script>
        var fileImported = false;

        document.getElementById('csvFileInput').addEventListener('change', function (e) {
            if (fileImported) {
                alert('Anda telah mengimpor file sebelumnya. Hanya satu file yang diizinkan.');
                this.value = '';
                return;
            }

            var file = e.target.files[0];
            var reader = new FileReader();

            reader.onload = function (event) {
                var csvData = event.target.result;
                var lines = csvData.split('\n');
                var table = document.getElementById('csvTable');

                for (var i = 0; i < lines.length; i++) {
                    var row = table.insertRow(-1);
                    var cells = lines[i].split(',');

                    for (var j = 0; j < cells.length; j++) {
                        var cell = row.insertCell(-1);
                        cell.innerHTML = cells[j];
                    }
                }

                fileImported = true;

                localStorage.setItem('csvData', csvData);
            };

            reader.readAsText(file);
        });

        var storedCsvData = localStorage.getItem('csvData');
        if (storedCsvData) {
            var table = document.getElementById('csvTable');
            var lines = storedCsvData.split('\n');
            for (var i = 0; i < lines.length; i++) {
                var row = table.insertRow(-1);
                var cells = lines[i].split(',');

                for (var j = 0; j < cells.length; j++) {
                    var cell = row.insertCell(-1);
                    cell.innerHTML = cells[j];
                }
            }
            fileImported = true;
        }

        document.getElementById('hapusTabel').addEventListener('click', function () {
            var table = document.getElementById('csvTable');
            while (table.rows.length > 0) {
                table.deleteRow(0);
            }
            fileImported = false;

            localStorage.removeItem('csvData');
        });
    </script>
</body>
</html>
