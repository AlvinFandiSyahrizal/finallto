<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Line 4</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>
<body style="background: lightgray">

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <h3 class="text-center my-4">Tambah Data Line4</h3>
                    <hr>
                </div>
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <form action="{{ route('line4s.store') }}" method="POST">
                            @csrf
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Part Number</th>
                                        <th>Assy</th>
                                        <th>Flange Non</th>
                                        <th>Wclutch</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <input type="text" name="PartNumber" class="form-control">
                                        </td>
                                        <td>
                                            <input type="text" name="Assy" class="form-control">
                                        </td>
                                        <td>
                                            <select id="FlangeNon" name="FlangeNon" class="form-control">
                                            <option hidden>Choose</option>
                                            <option value="Flange"> Flange</option>
                                            <option value="Non Flange">Non Flange</option>
                                        </td>
                                        <td>
                                            <input type="text" name="Wclutch" class="form-control">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <h3 class="text-center my-4">Line4</h3>
                    <div class="text-right mb-3">
                        <button class="btn btn-primary" onclick="exportToCSV()">Export</button>
                    <hr>
                </div>
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <table id="line4Table" class="table table-bordered">
                            <thead>
                <tr>
                    <th>Part Number</th>
                    <th>Assy</th>
                    <th>Flange/Non</th>
                    <th>Wclutch</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($line4s as $line4)
                    <tr>
                        <td>{{ $line4->PartNumber }}</td>
                        <td>{{ $line4->Assy }}</td>
                        <td>{{ $line4->FlangeNon }}</td>
                        <td>{{ $line4->Wclutch }}</td>


                        <td class="text-center">
                            <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('line4s.destroy', $line4->id) }}" method="POST">
                                <a href="{{ route('line4s.edit', $line4->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                            <form action="{{ route('line4s.destroy', $line4->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</div>
</div>
</div>
<script>
    function exportToCSV() {
        const table = document.getElementById('line4Table');
        const rows = table.querySelectorAll('tbody tr');
        let csvData = [];

        // Mencari baris header dengan nama kolom
        const headerRow = table.querySelector('thead tr');
        const headerCells = headerRow.querySelectorAll('th:not(:last-child)');
        const headerRowData = Array.from(headerCells).map(cell => cell.textContent);
        csvData.push(headerRowData);

        for (let i = 0; i < rows.length; i++) {
            const row = [];
            const cells = rows[i].querySelectorAll('td:not(:last-child)');
            for (let j = 0; j < cells.length; j++) {
                row.push(cells[j].textContent);
            }
            csvData.push(row);
        }

        const csvContent = 'data:text/csv;charset=utf-8,' + csvData.map(row => row.join(',')).join('\n');
        const encodedUri = encodeURI(csvContent);
        const link = document.createElement('a');
        link.setAttribute('href', encodedUri);
        link.setAttribute('download', 'line4_data.csv');
        link.click();
    }
</script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

</body>
</html>
