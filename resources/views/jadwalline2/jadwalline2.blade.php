<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Jadwal Line 2</title>
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
                    <form action="{{ route('jadwalline2.store') }}" method="POST">
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
                                        <select id="line2Dropdown" name="PartNumber" class="form-control">
                                            <option value="" data-flange="">Pilih Part Number</option>
                                            @foreach ($line2Data as $partNumber2 => $flangeNon)
                                                <option value="{{ $partNumber2 }}">{{ $partNumber2 }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select id="FlangeNon" name="FlangeNon" class="form-control">
                                        <option hidden>Choose</option>
                                        <option value="Flange"> Flange</option>
                                        <option value="Non Flange">Non Flange</option>
                                    </td>
                                    <td>
                                        <input type="number" name="Quantity" class="form-control" min="0" step="10">
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
                <h3 class="text-center my-4">Jadwal Line2</h3>
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
                        @foreach ($jadwal_line2s as $jadwalline2)
                            <tr>
                                <td>{{ $jadwalline2->Jam }}</td>
                                <td>{{ $jadwalline2->Tanggal }}</td>
                                <td>{{ $jadwalline2->PartNumber }}</td>
                                <td>{{ $jadwalline2->FlangeNon }}</td>
                                <td>{{ $jadwalline2->Quantity }}</td>
                                <td class="text-center">
                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                        action="{{ route('jadwalline2.destroy', $jadwalline2->id) }}" method="POST">
                                        <a href="{{ route('jadwalline2.edit', $jadwalline2->id) }}"
                                            class="btn btn-sm btn-primary">EDIT</a>
                                        <form action="{{ route('jadwalline2.destroy', $jadwalline2->id) }}" method="POST"
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

            $('#line2Dropdown').on('change', function() {
                var selectedPartNumber = $(this).val();

                if (selectedPartNumber) {
                    // Lakukan permintaan AJAX untuk mendapatkan data FlangeNon berdasarkan PartNumber yang dipilih
                    $.ajax({
                        url: '/getFlangeNon/' + selectedPartNumber,
                        type: 'GET',
                        success: function(data) {
                            // Mengatur nilai 'FlangeNon' sesuai dengan data yang diterima dari server
                            $('#FlangeNon').val(data.FlangeNon);
                        }
                    });
                } else {
                    // Jika tidak ada PartNumber yang dipilih, atur nilai 'FlangeNon' menjadi kosong
                    $('#FlangeNon').val('');
                }
            });
        });
    </script>


</body>
</html>
