<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie-edge">
    <title>Schedule Flange</title>
    <style>
        /* Gaya untuk tabel */
        table {
            border-collapse: collapse;
            width: 100%;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        /* Gaya untuk judul */
        h1 {
            text-align: center;
            font-size: 24px;
        }

        /* Gaya untuk paragraf */
        p {
            font-size: 18px;
        }

        /* Gaya untuk kolom grup */
        .group {
            display: flex;
            width: 100%;
            justify-content: space-between;
            gap: 0px;
        }

        .group table {
            width: 30%;
        }

        .container {
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>
<body>
    <h1>Schedule Flange</h1>
    <div class="text-right mb-3">
        <label for="selected-date">Date:</label>
        <input type="date" id="selected-date" class="form-control">
        <button class="btn btn-primary" id="filter-button">Filter</button>
    </div>

    <p id="day-display">Day:</p>

    <div class="container">
        <div class="group">
            <table>
                <tr>
                    <th colspan="2">Jadwal</th>
                </tr>
                <tr>
                    <th>Jam</th>
                </tr>
                <tbody id="schedule-line">
                    <!-- inibuatjam -->
                </tbody>
            </table>

            <table>
                <tr>
                    <th colspan="2">LINE 2</th>
                </tr>
                <tr>
                    <td>PART NUMBER</td>
                    <td>QUANTITY</td>
                </tr>
                <tbody id="schedule-line2" class="table table-bordered">
                    <!-- Line 2 schedule will be displayed here. -->
                </tbody>
            </table>
            <table>
                <tr>
                    <th colspan="2">LINE 3</th>
                </tr>
                <tr>
                    <td>PART NUMBER</td>
                    <td>QUANTITY</td>
                </tr>
                <tbody id="schedule-line3" class="table table-bordered">
                    <!-- Line 3 schedule will be displayed here. -->
                </tbody>
            </table>
            <table>
                <tr>
                    <th colspan="2">LINE 4</th>
                </tr>
                <tr>
                    <td>PART NUMBER</td>
                    <td>QUANTITY</td>
                </tr>
                <tbody id="schedule-line4" class="table table-bordered">
                    <!-- Line 4 schedule will be displayed here. -->
                </tbody>
            </table>
        </div>
    </div>

    <div class="break"></div>
    <table>
        <tr>
            <td>Istirahat</td>
        </tr>
    </table>

    <!-- Tambahkan script jQuery (pastikan Anda sudah memasang jQuery) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            const selectedDateInput = document.getElementById("selected-date");
            const filterButton = document.getElementById("filter-button");

            // Fungsi untuk memuat jadwal berdasarkan tanggal yang dipilih
            function loadSchedule(selectedDate) {
                // Kirim permintaan ke server untuk mengambil jadwal
                $.ajax({
                    url: "/get-schedule", // Ganti dengan URL yang sesuai di aplikasi Laravel Anda
                    method: "GET",
                    data: { date: selectedDate },
                    dataType: "json",
                    success: function (data) {
                        // Mengosongkan tabel jadwal sebelum mengisi dengan data baru
                        scheduleLine2.innerHTML = "";
                        scheduleLine3.innerHTML = "";
                        scheduleLine4.innerHTML = "";

                        // Mengisi tabel jadwal LINE 2
                        data.line2.forEach(function (schedule) {
                            const row = document.createElement("tr");
                            const cellJam = document.createElement("td");
                            cellJam.textContent = schedule.Jam;
                            row.appendChild(cellJam);
                            scheduleLine2.appendChild(row);
                        });

                        // Mengisi tabel jadwal LINE 3
                        data.line3.forEach(function (schedule) {
                            const row = document.createElement("tr");
                            const cellJam = document.createElement("td");
                            cellJam.textContent = schedule.Jam;
                            row.appendChild(cellJam);
                            scheduleLine3.appendChild(row);
                        });

                        // Mengisi tabel jadwal LINE 4
                        data.line4.forEach(function (schedule) {
                            const row = document.createElement("tr");
                            const cellJam = document.createElement("td");
                            cellJam.textContent = schedule.Jam;
                            row.appendChild(cellJam);
                            scheduleLine4.appendChild(row);
                        });

                        // Lakukan hal yang sama untuk jadwal LINE 3 dan LINE 4
                    }
                });
            }

            // Memanggil fungsi untuk memuat jadwal saat tanggal dipilih atau tombol "Filter" ditekan
            filterButton.addEventListener("click", function () {
                const selectedDate = selectedDateInput.value;
                loadSchedule(selectedDate);
            });

            // Event listener untuk memperbarui tanggal hari ini saat kalender dipilih
            selectedDateInput.addEventListener("change", function () {
                const selectedDate = selectedDateInput.value;
                const dayName = getDayName(selectedDate);
                dayDisplay.textContent = `Day: ${dayName}`;

                // Memuat jadwal untuk tanggal yang baru dipilih
                loadSchedule(selectedDate);
            });

            // Tambahkan fungsi untuk mendapatkan hari dari tanggal
            function getDayName(dateString) {
                const daysOfWeek = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
                const date = new Date(dateString);
                const dayIndex = date.getDay();
                return daysOfWeek[dayIndex];
            }

            // Tambahkan kode untuk menampilkan hari saat halaman dimuat
            const dayDisplay = document.getElementById("day-display");
            const today = new Date();
            const todayString = today.toISOString().split('T')[0];  // Format tanggal menjadi YYYY-MM-DD
            const todayDayName = getDayName(todayString);
            dayDisplay.textContent = `Day: ${todayDayName}`;

            // Inisialisasi tabel jadwal untuk hari ini
            loadSchedule(todayString);
        });
    </script>
</body>
</html>
