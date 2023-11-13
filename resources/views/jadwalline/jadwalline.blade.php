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
            grid-template-columns: repeat(4, 1fr);
            gap: 30px;
        }

        .col-md-12 {
            width: 100%;
        }

        .col-md-12 h3 {
            text-align: center;
        }

        .col-md-12 table {
            width: 100%;
        }

        .form-control {
            width: 200px;
        }

        .form-control {
            height: 40px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <!-- Form Input Jadwal Line -->
        <div class="col-md-12">
            <div>
                <h3 class="text-center my-5">Input Jadwal Line</h3>
                <hr>
                <form id="lineForm" method="POST">
                    @csrf
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
                    <div>
                    <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                    <div>
                        <button id="exportButton" class="btn btn-primary">Export</button>
                    </div>
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
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
       // Event listener saat dokumen siap
       $(document).ready(function() {
        // $("#Tanggal").datepicker({
        //     dateFormat: 'yy-mm-dd'
        // });

 // Event listener saat tombol "Export" diklik
$("#exportButton").on("click", function(e) {
    e.preventDefault(); // Mencegah tindakan default tombol

    // Mendefinisikan data untuk setiap Line
    var line2Data = collectTableData("#line2Jadwal");
    var line3Data = collectTableData("#line3Jadwal");
    var line4Data = collectTableData("#line4Jadwal");

    // Menggabungkan data dari ketiga Line
    var combinedData = combineData(line2Data, line3Data, line4Data);

    // Menggabungkan data menjadi satu string CSV
    var csvContent = formatDataToCSV(combinedData);

    // Menghasilkan file CSV dan mengizinkan pengguna mengunduhnya
    var blob = new Blob([csvContent], { type: "text/csv;charset=utf-8;" });
    var url = URL.createObjectURL(blob);
    var a = document.createElement("a");
    a.style.display = "none";
    a.href = url;
    a.download = "combined_line_data.csv";
    document.body.appendChild(a);
    a.click();
    URL.revokeObjectURL(url);

    // Setelah kode ekspor selesai, tombol akan melanjutkan tindakan defaultnya (yang telah dicegah di atas)
});

// Fungsi untuk menggabungkan data dari ketiga Line secara horizontal
function combineData(line2Data, line3Data, line4Data) {
    var combinedData = [];
    // Tambahkan baris untuk nama Line
    var lineNames = [ "", "","Line 2 Data", "","","","","","",  "Line 3 Data", "","","","","","", "Line 4 Data"];
    combinedData.push(lineNames);

    for (var i = 0; i < Math.max(line2Data.length, line3Data.length, line4Data.length); i++) {
        var rowData = [];

        if (i < line2Data.length) {
            rowData = rowData.concat(line2Data[i]);
        } else {
            rowData = rowData.concat(["", ""]); // Add empty cells if data not available
        }

        rowData = rowData.concat(["", ""]); // Add empty cells to create space

        if (i < line3Data.length) {
            rowData = rowData.concat(line3Data[i]);
        } else {
            rowData = rowData.concat(["", ""]); // Add empty cells if data not available
        }

        rowData = rowData.concat(["", ""]); // Add empty cells to create space

        if (i < line4Data.length) {
            rowData = rowData.concat(line4Data[i]);
        } else {
            rowData = rowData.concat(["", ""]); // Add empty cells if data not available
        }

        combinedData.push(rowData);
    }

    return combinedData;
}


// Fungsi untuk mengumpulkan data dari tabel
function collectTableData(tableSelector) {
    var tableData = [];
    $(tableSelector + " tbody tr").each(function() {
        var rowData = [];
        $(this).find("td").each(function() {
            rowData.push($(this).text());
        });
        tableData.push(rowData);
    });
    return tableData;
}

// Fungsi untuk mengformat data ke dalam format CSV
function formatDataToCSV(data) {
    var csvData = data.map(function(row) {
        return row.join(",");
    });
    return csvData.join("\n");
}



        // Event listener saat Line berubah
        $("#Line").on("change", function() {
            var selectedLine = $(this).val();
            updatePartNumberDropdown(selectedLine);
        });

// Fungsi untuk mengisi Part Numbers berdasarkan Line yang dipilih
function updatePartNumberDropdown(selectedLine) {
    var partNumberDropdown = $("#PartNumber");
    partNumberDropdown.empty();
    partNumberDropdown.append('<option value="" data-flange="">Pilih Part Number</option>');

    // Di sini Anda dapat menggunakan data yang dikirim dari server untuk mengisi opsi Part Number
    if (selectedLine === "Line2") {
        var line2Data = {!! json_encode($line2Data) !!}; // Ambil data Part Number dan Flange/Non dari server
        $.each(line2Data, function(partNumber, flangeNon) {
            partNumberDropdown.append('<option value="' + partNumber + '" data-flange="' + flangeNon + '">' + partNumber + '</option>');
        });
    } else if (selectedLine === "Line3") {
        var line3Data = {!! json_encode($line3Data) !!}; // Ambil data Part Number dan Flange/Non dari server
        $.each(line3Data, function(partNumber, flangeNon) {
            partNumberDropdown.append('<option value="' + partNumber + '" data-flange="' + flangeNon + '">' + partNumber + '</option>');
        });
    } else if (selectedLine === "Line4") {
        var line4Data = {!! json_encode($line4Data) !!}; // Ambil data Part Number dan Flange/Non dari server
        $.each(line4Data, function(partNumber, flangeNon) {
            partNumberDropdown.append('<option value="' + partNumber + '" data-flange="' + flangeNon + '">' + partNumber + '</option>');
        });
    }
}
$("#PartNumber").on("change", function() {
            var selectedPartNumber = $(this).val();
            var selectedFlangeNon = $(this).find('option:selected').data('flange');

            if (selectedPartNumber) {
                $('#FlangeNon').val(selectedFlangeNon);
            } else {
                $('#FlangeNon').val('');
            }
        });

        $('#lineForm').submit(function(e) {
            e.preventDefault();

    var line = $('#Line').val();
    var jam = $('#Jam').val();
    var tanggal = $('#Tanggal').val();
    var partNumber = $('#PartNumber').val();
    var flangeNon = $('#FlangeNon').val();
    var quantity = $('#Quantity').val();

    // Membuat objek data untuk dikirim
    var data = {
        Line: line,
        Jam: jam,
        Tanggal: tanggal,
        PartNumber: partNumber,
        FlangeNon: flangeNon,
        Quantity: quantity
    };

    // Menyesuaikan URL aksi berdasarkan Line yang dipilih
    var actionUrl = '/simpanJadwal'; // URL default

    if (line === 'Line2') {
        actionUrl = '/simpanJadwalLine2'; // Sesuaikan dengan URL untuk Line 2
    } else if (line === 'Line3') {
        actionUrl = '/simpanJadwalLine3'; // Sesuaikan dengan URL untuk Line 3
    } else if (line === 'Line4') {
        actionUrl = '/simpanJadwalLine4'; // Sesuaikan dengan URL untuk Line 4
    }

    // Mengirim data ke server melalui AJAX dengan URL aksi yang sesuai
    $.ajax({
    url: actionUrl, // Ini harus sesuai dengan URL yang sesuai dengan Line yang dipilih
    method: 'POST',
    data: {
        Line: line,
        Jam: jam,
        Tanggal: tanggal,
        PartNumber: partNumber,
        FlangeNon: flangeNon,
        Quantity: quantity
    },
    success: function(response) {
        showToastMessage('success', response.message);
    },
             error: function(error) {
    console.log(error); // Tampilkan pesan kesalahan di konsol
    if (error.status === 422) {
        var errors = error.responseJSON.errors;
        for (var key in errors) {
            showToastMessage('error', errors[key][0]);
        }
    } else {
        showToastMessage('error', 'Gagal menyimpan jadwal Line.');
    }
}

            });
        });
    });
</script>
</body>
</html>
