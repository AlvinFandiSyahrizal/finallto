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
                                            <input type="number" name="FlangeNon" class="form-control" min="o" max="1">
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
                    <hr>
                </div>
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <a href="{{ route('line4s.create') }}" class="btn btn-md btn-success mb-3">TAMBAH POST</a>
                        <table class="table table-bordered">
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


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

</body>
</html>
