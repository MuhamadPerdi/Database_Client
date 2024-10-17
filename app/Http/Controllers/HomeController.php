<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Client;
use App\Models\Monitoring;
use App\Models\ProjekOption;
use Illuminate\Http\Request;
use App\Models\jenis_options;
use App\Models\status_options;
use Illuminate\Support\Carbon;
use App\Models\KeteranganOption;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */public function index()
{
     // Fetch data for clients by type and status
     $clientsByType = Client::select('jenis_id', DB::raw('COUNT(*) as count'))
     ->groupBy('jenis_id')
     ->pluck('count', 'jenis_id')
     ->toArray();

 $clientsByStatus = Client::select('status_id', DB::raw('COUNT(*) as count'))
     ->groupBy('status_id')
     ->pluck('count', 'status_id')
     ->toArray();

 // Fetch the names for labels
 $jenisOptions = jenis_options::pluck('jenis', 'id')->toArray();
 $statusOptions = status_options::pluck('status', 'id')->toArray();

 // Prepare data for charts
 $jenisLabels = array_map(function($id) use ($jenisOptions) {
     return $jenisOptions[$id] ?? 'Unknown';
 }, array_keys($clientsByType));

 $jenisData = array_values($clientsByType);

 $statusLabels = array_map(function($id) use ($statusOptions) {
     return $statusOptions[$id] ?? 'Unknown';
 }, array_keys($clientsByStatus));

 $statusData = array_values($clientsByStatus);

 // Fetch data for monitoring by projek and keterangan
 $monitoringsByProjek = Monitoring::select('projek_id', DB::raw('COUNT(*) as count'))
     ->groupBy('projek_id')
     ->pluck('count', 'projek_id')
     ->toArray();

 $monitoringsByKeterangan = Monitoring::select('keterangan_id', DB::raw('COUNT(*) as count'))
     ->groupBy('keterangan_id')
     ->pluck('count', 'keterangan_id')
     ->toArray();

 // Fetch the names for labels
 $projekOptions = ProjekOption::pluck('name', 'id')->toArray();
 $keteranganOptions = KeteranganOption::pluck('name', 'id')->toArray();

 // Prepare data for monitoring charts
 $projekLabels = array_map(function($id) use ($projekOptions) {
     return $projekOptions[$id] ?? 'Unknown';
 }, array_keys($monitoringsByProjek));

 $projekData = array_values($monitoringsByProjek);

 $keteranganLabels = array_map(function($id) use ($keteranganOptions) {
     return $keteranganOptions[$id] ?? 'Unknown';
 }, array_keys($monitoringsByKeterangan));

 $keteranganData = array_values($monitoringsByKeterangan);

 // Return view with chart data
 return view('dashboard', [
     'jenisLabels' => $jenisLabels,
     'jenisData' => $jenisData,
     'statusLabels' => $statusLabels,
     'statusData' => $statusData,
     'projekLabels' => $projekLabels,
     'projekData' => $projekData,
     'keteranganLabels' => $keteranganLabels,
     'keteranganData' => $keteranganData,
     'clientCount' => Client::count(),
     'monitoringCount' => Monitoring::count(),
     'userCount' => User::count(),
    'latestMonitoring' => Monitoring::with('user')->latest()->take(5)->get(),
    'latestClient' => Client::with('user')->latest()->take(5)->get()
 ]);
}
}
