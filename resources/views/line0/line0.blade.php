<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>

<div class="content">
    @yield('content')
</div>

<div class="container">
    <h1 class="display-4">hello world</h1>
</div>

<div class="container">
    <form action="" method="post" enctype="multipart/form-data" name="ContohUploadFile" id="ContohUploadFile">
        <p>Pilih file
            <input type="file" id="fileInput" />
            <button id="hapusTabel" type="button">Hapus Tabel</button>
        </p>
    </form>
</div>

<div class="container">
    <table id="excelTable" class="table table-bordered">
    </table>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/PapaParse/5.3.0/papaparse.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.5/xlsx.full.min.js"></script>

<script>
    var fileImported = false;

    document.getElementById('fileInput').addEventListener('change', function (e) {
        if (fileImported) {
            alert('Anda telah mengimpor file sebelumnya. Hanya satu file yang diizinkan.');
            this.value = '';
            return;
        }

        var file = e.target.files[0];
        var reader = new FileReader();

        reader.onload = function (event) {
            var data = event.target.result;

            if (file.name.endsWith(".csv")) {
                parseCSV(data);
            } else if (file.name.endsWith(".xlsx")) {
                parseXLSX(data);
            } else {
                alert('Format file tidak didukung.');
                return;
            }

            fileImported = true;
            localStorage.setItem('excelData', JSON.stringify({ fileName: file.name, data: data }));
        };

        reader.readAsBinaryString(file);
    });

    var storedExcelData = localStorage.getItem('excelData');
    if (storedExcelData) {
        var excelData = JSON.parse(storedExcelData);
        var file = new File([excelData.data], excelData.fileName);

        if (excelData.fileName.endsWith(".csv")) {
            parseCSV(excelData.data);
        } else if (excelData.fileName.endsWith(".xlsx")) {
            parseXLSX(excelData.data);
        }
        fileImported = true;
    }

    document.getElementById('hapusTabel').addEventListener('click', function () {
        var table = document.getElementById('excelTable');
        while (table.rows.length > 0) {
            table.deleteRow(0);
        }
        fileImported = false;

        localStorage.removeItem('excelData');
    });

    function parseCSV(data) {
        Papa.parse(data, {
            complete: function (results) {
                displayTable(results.data);
            }
        });
    }

    function parseXLSX(data) {
        var workbook = XLSX.read(data, { type: 'binary' });
        var sheetName = workbook.SheetNames[0];
        var sheet = workbook.Sheets[sheetName];
        var excelData = XLSX.utils.sheet_to_json(sheet, { header: 1 });
        displayTable(excelData);
    }

    function displayTable(data) {
        var table = document.getElementById('excelTable');
        for (var i = 0; i < data.length; i++) {
            var row = table.insertRow(-1);
            for (var j = 0; j < data[i].length; j++) {
                var cell = row.insertCell(-1);
                cell.innerHTML = data[i][j];
            }
        }
    }
</script>

</body>
</html>
