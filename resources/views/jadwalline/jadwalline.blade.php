<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Include your CSS and JavaScript libraries here -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Jadwal Line 2, 3, dan 4</title>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>

    .col-md-4 {
    width: 33%;
    float: left;
    }


        </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4" >
                <hr>
                <h3 class="text-center my-4">Jadwal Line 2</h3>
                <div class="card-body create-form">
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
                                        <input type="time" name="Jam" class="form-control" />
                                    </td>
                                    <td>
                                        <input type="date" name="Tanggal" class="form-control" />
                                    </td>
                                    <td>
                                        <select name="PartNumber" class="form-control">
                                            <option value="" data-flange="">Pilih Part Number</option>
                                            @foreach ($line2Data as $partNumber2 => $flangeNon)
                                                <option value="{{ $partNumber2 }}">{{ $partNumber2 }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" name="FlangeNon" class="form-control" min="0" max="1">
                                    </td>
                                    <td>
                                        <input type="number" name="Quantity" class="form-control" min="0" step="1">
                                    </td>
                                    <td>
                                        <button type="submit" class="btn btn-success">Simpan</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
                <div class="mt-4">
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
                            @foreach ($jadwal_line2s as $jadwalline2)
                                <tr>
                                    <td>{{ $jadwalline2->Jam }}</td>
                                    <td>{{ $jadwalline2->Tanggal }}</td>
                                    <td>{{ $jadwalline2->PartNumber }}</td>
                                    <td>{{ $jadwalline2->FlangeNon }}</td>
                                    <td>{{ $jadwalline2->Quantity }}</td>
                                    <td class="text-center">
                                        <!-- Tombol Edit dan Hapus seperti yang ada di jadwalline2 -->
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-4">
                <hr>
                <h3 class="text-center my-4">Jadwal Line 3</h3>
                <div class="card-body create-form">
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
                                        <input type="time" name="Jam" class="form-control" />
                                    </td>
                                    <td>
                                        <input type="date" name="Tanggal" class="form-control" />
                                    </td>
                                    <td>
                                        <select name="PartNumber" class="form-control">
                                            <option value="" data-flange="">Pilih Part Number</option>
                                            @foreach ($line3Data as $partNumber3 => $flangeNon)
                                                <option value="{{ $partNumber3 }}">{{ $partNumber3 }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" name="FlangeNon" class="form-control" min="0" max="1">
                                    </td>
                                    <td>
                                        <input type="number" name="Quantity" class="form-control" min="0" step="1">
                                    </td>
                                    <td>
                                        <button type="submit" class="btn btn-success">Simpan</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
                <div class="mt-4">
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
                            @foreach ($jadwal_line3s as $jadwalline3)
                                <tr>
                                    <td>{{ $jadwalline3->Jam }}</td>
                                    <td>{{ $jadwalline3->Tanggal }}</td>
                                    <td>{{ $jadwalline3->PartNumber }}</td>
                                    <td>{{ $jadwalline3->FlangeNon }}</td>
                                    <td>{{ $jadwalline3->Quantity }}</td>
                                    <td class="text-center">
                                        <!-- Tombol Edit dan Hapus seperti yang ada di jadwalline3 -->
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-4">
                <hr>
                <h3 class="text-center my-4">Jadwal Line 4</h3>
                <div class="card-body create-form">
                    <form action="{{ route('jadwalline4.store') }}" method="POST">
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
                                        <input type="time" name="Jam" class="form-control" />
                                    </td>
                                    <td>
                                        <input type="date" name="Tanggal" class="form-control" />
                                    </td>
                                    <td>
                                        <select name="PartNumber" class="form-control">
                                            <option value="" data-flange="">Pilih Part Number</option>
                                            @foreach ($line4Data as $partNumber4 => $flangeNon)
                                                <option value="{{ $partNumber4 }}">{{ $partNumber4 }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="select" name="FlangeNon" class="form-control">
                                        <option hidden>Choose</option>
                                        <option value="Flange"> Flange</option>
                                        <option value="Non Flange">Non Flange</option>
                                    </td>
                                    <td>
                                        <input type="number" name="Quantity" class="form-control" min="0" step="1">
                                    </td>
                                    <td>
                                        <button type="submit" class="btn btn-success">Simpan</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
                <div class="mt-4">
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
                            @foreach ($jadwal_line4s as $jadwalline4)
                                <tr>
                                    <td>{{ $jadwalline4->Jam }}</td>
                                    <td>{{ $jadwalline4->Tanggal }}</td>
                                    <td>{{ $jadwalline4->PartNumber }}</td>
                                    <td>{{ $jadwalline4->FlangeNon }}</td>
                                    <td>{{ $jadwalline4->Quantity }}</td>
                                    <td class="text-center">
                                        <!-- Tombol Edit dan Hapus seperti yang ada di jadwalline4 -->
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
            $('#line2Dropdown').select2({
                width: '100%'
            });
        });
    </script>

</body>
</html>
