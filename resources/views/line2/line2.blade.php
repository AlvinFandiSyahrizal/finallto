<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Line 2</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>
<body style="background: lightgray">

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <h3 class="text-center my-4">Tambah Data Line2</h3>
                    <hr>
                </div>
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <form action="{{ route('line2s.store') }}" method="POST">
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
                                            <select name="FlangeNon" class="form-control">
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
                    <h3 class="text-center my-4">Line2</h3>
                    <hr>
                </div>
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
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
                                @foreach($line2s as $line2)
                                    <tr>
                                        <td>{{ $line2->PartNumber }}</td>
                                        <td>{{ $line2->Assy }}</td>
                                        <td>{{ $line2->FlangeNon }}</td>
                                        <td>{{ $line2->Wclutch }}</td>

                                        <td class="text-center">
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('line2s.destroy', $line2->id) }}" method="POST">
                                                <a href="{{ route('line2s.edit', $line2->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                                <form action="{{ route('line2s.destroy', $line2->id) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin?')">Delete</button>
                                                </form>
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
