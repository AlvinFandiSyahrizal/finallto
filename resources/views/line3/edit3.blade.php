<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Data Line3</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body style="background: lightgray">

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <h3 class="text-center my-4">Edit Data Line3</h3>
                    <hr>
                </div>
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <form action="{{ route('line2s.update', $line2s->id) }}" method="POST">
                            @csrf
                            @method('PUT') <!-- Untuk metode update -->
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
                                            <input type="text" name="PartNumber" class="form-control" value="{{ $line3s->PartNumber }}">
                                        </td>
                                        <td>
                                            <input type="text" name="Assy" class="form-control" value="{{ $line3s->Assy }}">
                                        </td>
                                        <td>
                                            <input type="text" name="FlangeNon" class="form-control" value="{{ $line3s->FlangeNon }}">
                                        </td>
                                        <td>
                                            <input type="text" name="Wclutch" class="form-control" value="{{ $line3s->Wclutch }}">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
