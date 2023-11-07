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
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

   <style>
        .container {
            display: grid;
            grid-template-columns: repeat(4, 1fr); /* Menyusun dalam 3 kolom sejajar */
            gap: 30px; /* Jarak antar elemen */
        }

        .col-md-12 {
            width: 100%;
        }

        .col-md-12 h3 {
            text-align: center;
        }

        .col-md-12 table {
            width: 0%;
        }

        .form-control {
        width: 200px;
    }

    /* Mengatur tinggi form input */
    .form-control {
        height: 40px; /* Ganti dengan tinggi yang Anda inginkan */
    }

        </style>
</head>
<body>


<div class="container mt-5">
   <!-- Form Input Jadwal Line  -->
   <div class="col-md-20">
    <div>
        <h3 class="text-center my-9">Input Jadwal Line</h3>
        <hr>
        <form id="lineForm">
            <div class="form-group">
                <label for="Line">Line:</label>
                <select id="Line" name="Line" class="form-control" required>
                    <option hidden>Choose</option>
                    <option value="Line2">Line 2</option>
                    <option value="Line3">Line 3</option>
                    <option value="Line4">Line 4</option>
                </select>
            </div>
            <div class="form-group">
                <label for="Jam">Jam:</label>
                <input type="time" id="Jam" name="Jam" class="form-control">
            </div>
            <div class="form-group">
                <label for="Tanggal">Tanggal:</label>
                <input type="date" id="Tanggal" name="Tanggal" class="form-control" />
            </div>
            <div class="form-group">
                <label for="PartNumber">Part Number:</label>
                <select id="PartNumber" name="PartNumber" class="form-control">
                    <option value="" data-flange="">Pilih Part Number</option>

                </select>
            </div>
            <div class="form-group">
                <label for="FlangeNon">Flange/Non:</label>
                <input type="text" id="FlangeNon" name="FlangeNon" class="form-control" readonly>
            </div>
            <div class="form-group">
                <label for="Quantity">Quantity:</label>
                <input type="number" name="Quantity" class="form-control" min="0" step="1">
            </div>
            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
    </div>
</div>

    <!-- Bagian Tabel Data Line 2 -->
    <div class="col-md-12">
        <div class="mb-3">
            <div>
            <h3 class="text-center my-4">Jadwal Line 2</h3>
            <hr>
            <table id="line2Jadwal" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Jam</th>
                        <th style="min-width: 110px;">Tanggal</th>
                        <th style="min-width: 200px;">Part Number</th>
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
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        </div>

<!-- Bagian Tabel Data Line 3 -->
<div class="col-md-12">
    <div class="mb-3">
        <div>
        <h3 class="text-center my-4">Jadwal Line 3</h3>
        <hr>
        <table id="line3Jadwal" class="table table-bordered">
            <thead>
                <tr>
                    <th>Jam</th>
                    <th style="min-width: 110px;">Tanggal</th>
                    <th style="min-width: 200px;">Part Number</th>
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
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        </div>

<!-- Bagian Tabel Data Line 4 -->

<div class="col-md-12">
    <div class="mb-3">
        <div>
        <h3 class="text-center my-4">Jadwal Line 4</h3>
        <hr>
        <table id="line4Jadwal" class="table table-bordered">
            <thead>
                <tr>
                    <th>Jam</th>
                    <th style="min-width: 110px;">Tanggal</th>
                    <th style="min-width: 200px;">Part Number</th>
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
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


    <script>
        $(document).ready(function() {
            $("#Tanggal").datepicker({
                dateFormat: 'yy-mm-dd'
            });
});

//             $('#line2Dropdown').on('change', function() {
//                 var selectedPartNumber = $(this).val();
//                 var selectedFlangeNon = $(this).find('option:selected').data('flange');

//                 if (selectedPartNumber) {
//                     $('#FlangeNon').val(selectedFlangeNon);
//                 } else {
//                     $('#FlangeNon').val(''); // Mengosongkan nilai jika 'Part Number' tidak dipilih
//                 }
//             });

//  $('#line3Dropdown').on('change', function() {
//     var selectedPartNumber = $(this).val();
//     var selectedFlangeNon = $(this).find('option:selected').data('flange');
//     var flangeNonField = $('#FlangeNon3'); // Menggunakan ID yang sesuai

//     if (selectedPartNumber) {
//         flangeNonField.val(selectedFlangeNon);
//     } else {
//         flangeNonField.val(''); // Mengosongkan nilai jika 'Part Number' tidak dipilih
//     }
// });

// $('#line4Dropdown').on('change', function() {
//     var selectedPartNumber = $(this).val();
//     var selectedFlangeNon = $(this).find('option:selected').data('flange');
//     var flangeNonField = $('#FlangeNon4'); // Menggunakan ID yang sesuai

//     if (selectedPartNumber) {
//         flangeNonField.val(selectedFlangeNon);
//     } else {
//         flangeNonField.val(''); // Mengosongkan nilai jika 'Part Number' tidak dipilih
//     }
// });


    </script>
</body>
</html>
