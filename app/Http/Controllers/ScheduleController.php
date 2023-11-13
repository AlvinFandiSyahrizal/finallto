<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Jadwalline;
use App\Models\JadwalLine2;
use App\Models\JadwalLine3;
use App\Models\JadwalLine4;
use App\Models\Line2;
use App\Models\Line3;
use App\Models\Line4;
use App\Models\Schedule;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

use Illuminate\Http\Request;
class ScheduleController extends Controller
{
    public function index()
    {

        $jadwal_line2s = JadwalLine2::orderBy('Tanggal')->orderBy('Jam')->get();
        $jadwal_line3s = JadwalLine3::orderBy('Tanggal')->orderBy('Jam')->get();
        $jadwal_line4s = JadwalLine4::orderBy('Tanggal')->orderBy('Jam')->get();
        $line2Data = Line2::pluck('FlangeNon', 'PartNumber');
        $line3Data = Line3::pluck('FlangeNon', 'PartNumber');
        $line4Data = Line4::pluck('FlangeNon', 'PartNumber');
        $jadwalLines = JadwalLine::all(); // Mengambil semua data JadwalLine
        return view('schedule.schedule', compact('jadwalLines', 'jadwal_line2s','jadwal_line3s', 'jadwal_line4s', 'line2Data', 'line3Data', 'line4Data'));
    }

    public function getSchedule(Request $request) {
        $selectedDate = $request->input('date');
        $line2 = Schedule::where('date', $selectedDate)->where('line', 'Line 2')->get();
        $line3 = Schedule::where('date', $selectedDate)->where('line', 'Line 3')->get();
        $line4 = Schedule::where('date', $selectedDate)->where('line', 'Line 4')->get();

        return response()->json(['line2' => $line2, 'line3' => $line3, 'line4' => $line4]);
    }

}

