<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Data Line2</title>
</head>
<body style="background: lightgray">

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <h3 class="text-center my-4">Edit Data Line2</h3>
                    <hr>
                </div>
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <form action="{{ route('jadwal_line2s.update', $jadwal_line2->id) }}" method="POST">
                            @csrf
                            @method('PUT') <!-- Untuk metode update -->
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Jam</th>
                                        <th>Tanggal</th>
                                        <th>Part Number</th>
                                        <th>Flange/Non</th>
                                        <th>Quantity</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <input type="time" name="Jam" class="form-control" value="{{ $jadwal_line2s->PartNumber }}">
                                        </td>
                                        <td>
                                            <input type="date" name="Tanggal" class="form-control" value="{{ $jadwal_line2s->PartNumber }}">
                                        </td>
                                        <td>
                                            <input type="text" name="PartNumber" class="form-control" value="{{ $jadwal_line2s->PartNumber }}">
                                        </td>
                                        <td>
                                            <input type="text" name="Assy" class="form-control" value="{{ $jadwal_line2s->Assy }}">
                                        </td>
                                        <td>
                                            <input type="text" name="FlangeNon" class="form-control" value="{{ $jadwal_line2s->FlangeNon }}">
                                        </td>
                                        <td>
                                            <input type="number" name="Quantity" class="form-control" value="{{ $jadwal_line2s->Wclutch }}">
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        $(document).ready(function() {
            $("#from-datepicker").datepicker({
                format: 'yyyy-mm-dd'
            });
            $("#from-datepicker").on("change", function() {
                var fromdate = $(this).val();
                alert(fromdate);
            });
        });
    </script>
</body>
</html>
