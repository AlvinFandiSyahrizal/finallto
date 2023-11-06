<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Jadwal Line 3</title>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>
<!-- Bagian Form Input -->
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div>
                <h3 class="text-center my-4">Tambah Input</h3>
                <hr>
            </div>
            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">
                    <form action="{{ route('jadwalline3.store') }}" method="POST">
                        @csrf
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Jam</th>
                                    <th>Tanggal</th>
                                    <th>Part Number</th>
                                    <th>Flange/Non</th>
                                    <th>Quantity</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <input type="time" id="Jam" name="Jam" class="form-control" />
                                    </td>
                                    <td>
                                        <input type="date" id="from-datepicker" name="Tanggal" class="form-control" />
                                    </td>
                                    <td>
                                        <select id="line3Dropdown" name="PartNumber" class="form-control">
                                            <option value="" data-flange="">Pilih Part Number</option>
                                            @foreach ($line3Data as $partNumber3 => $flangeNon)
                                                <option value="{{ $partNumber3 }}">{{ $partNumber3 }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" id="FlangeNon" name="FlangeNon" class="form-control" min="0" max="1">
                                    </td>
                                    <td>
                                        <input type="number" name="Quantity" class="form-control" min="0" step="1">
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
<!-- Bagian Tabel Data Line 2 -->

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div>
                <h3 class="text-center my-4">Jadwal Line3</h3>
                <hr>
            </div>
            <div class="mb-3">
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
                        @foreach ($jadwal_line3s as $jadwalline3)
                            <tr>
                                <td>{{ $jadwalline3->Jam }}</td>
                                <td>{{ $jadwalline3->Tanggal }}</td>
                                <td>{{ $jadwalline3->PartNumber }}</td>
                                <td>{{ $jadwalline3->FlangeNon }}</td>
                                <td>{{ $jadwalline3->Quantity }}</td>
                                <td class="text-center">
                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                        action="{{ route('jadwalline3.destroy', $jadwalline3->id) }}" method="POST">
                                        <a href="{{ route('jadwalline3.edit', $jadwalline3->id) }}"
                                            class="btn btn-sm btn-primary">EDIT</a>
                                        <form action="{{ route('jadwalline3.destroy', $jadwalline3->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Apakah Anda yakin?')">Delete</button>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        $(document).ready(function() {
            $("#Tanggal").datepicker({
                dateFormat: 'yy-mm-dd'
            });

            $('#line3Dropdown').on('change', function() {
                var selectedPartNumber = $(this).val();

                if (selectedPartNumber) {
                    $.ajax({
                        url: '/getFlangeNon/' + selectedPartNumber,
                        type: 'GET',
                        success: function(data) {
                            $('#FlangeNon').val(data.FlangeNon);
                        }
                    });
                } else {
                    $('#FlangeNon').val('');
                }
            });
        });
    </script>


</body>
</html>
