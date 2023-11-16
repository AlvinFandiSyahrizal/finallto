<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Import Excel</title>

    <!-- Tambahkan Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Tambahkan jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- Tambahkan PapaParse untuk parsing file CSV -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/PapaParse/5.3.0/papaparse.min.js"></script>

    <!-- Tambahkan XLSX untuk parsing file Excel -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.5/xlsx.full.min.js"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .container {
            max-width: 400px;
        }

        input {
            margin-bottom: 16px;
        }

        button {
            width: 100%;
        }

        #result {
            margin-top: 20px;
        }

        #sheetSelector {
            margin-bottom: 16px;
        }
    </style>

    <script>
        $(document).ready(function() {
            // Tampilkan nama file setelah dipilih
            $('#file').change(function() {
                var fileName = $(this).val().split('\\').pop();
                $('#fileLabel').text(fileName);
            });

            // Proses formulir tanpa menggunakan AJAX
            $('form').submit(function(e) {
                e.preventDefault(); // Mencegah formulir dikirim secara default
                var formData = new FormData(this);

                // Menggunakan FileReader untuk membaca file Excel
                var reader = new FileReader();
                reader.onload = function(e) {
                    var data = new Uint8Array(e.target.result);
                    var workbook = XLSX.read(data, { type: 'array' });

                    // Tampilkan pilihan sheet pada dropdown
                    var sheetSelector = $('#sheetSelector');
                    sheetSelector.empty();
                    workbook.SheetNames.forEach(function(sheetName) {
                        sheetSelector.append('<option value="' + sheetName + '">' + sheetName + '</option>');
                    });

                    // Tampilkan hasil setelah sheet dipilih
                    $('#sheetSelector').change(function() {
                        var selectedSheet = $(this).val();
                        var roa = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[selectedSheet]);
                        var htmlResult = '<h3>' + selectedSheet + '</h3>';
                        htmlResult += '<table class="table">';
                        htmlResult += '<tr>';
                        Object.keys(roa[0]).forEach(function(col) {
                            htmlResult += '<th>' + col + '</th>';
                        });
                        htmlResult += '</tr>';
                        roa.forEach(function(row) {
                            htmlResult += '<tr>';
                            Object.keys(row).forEach(function(col) {
                                htmlResult += '<td>' + row[col] + '</td>';
                            });
                            htmlResult += '</tr>';
                        });
                        htmlResult += '</table>';
                        $('#result').html(htmlResult);
                    });
                };

                // Membaca file Excel
                reader.readAsArrayBuffer(formData.get('file'));
            });
        });
    </script>
</head>
<body>

    <div class="container mt-5">
        <h2 class="mb-4">Formulir Import Excel</h2>

        <form enctype="multipart/form-data">
            <div class="form-group">
                <label for="file">Pilih file Excel:</label>
                <input type="file" class="form-control" id="file" name="file" accept=".xls, .xlsx" required>
                <small id="fileLabel" class="form-text text-muted"></small>
            </div>

            <!-- Dropdown untuk memilih sheet -->
            <div class="form-group">
                <label for="sheetSelector">Pilih Sheet:</label>
                <select class="form-control" id="sheetSelector"></select>
            </div>

            <button type="submit" class="btn btn-primary">Import</button>
        </form>

        <div id="result"></div>
    </div>

</body>
</html>
