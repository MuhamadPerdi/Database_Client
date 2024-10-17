<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\Monitoring;
use App\Models\ProjekOption;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\KeteranganOption;
use Illuminate\Contracts\Queue\Monitor;
use Illuminate\Support\Facades\Auth;

class MonitoringController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $monitorings = Monitoring::with('projek')->latest()->take(10)->get(); 
        return view('monitoring.index', compact('monitorings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $projekOptions = ProjekOption::all();
        $keteranganOptions = KeteranganOption::all();
        return view('monitoring.create', compact('projekOptions', 'keteranganOptions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $allowedProjek = ProjekOption::pluck('id')->toArray();
        $allowedKeterangan = KeteranganOption::pluck('id')->toArray();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'projek_id' => ['required', Rule::in($allowedProjek)],
            'bidang' => 'required|string|max:255',
            'mulai' => 'required|date|date_format:Y-m-d', 
            'selesai' => 'required|date|date_format:Y-m-d',
            'domain' => 'required|string|max:255',
            'keterangan_id' => ['required', Rule::in($allowedKeterangan)],
        ]);

        $monitoring = Monitoring::create([
            'name' => $request->name,
            'projek_id' => $request->projek_id,
            'bidang' => $request->bidang,
            'mulai' => $request->mulai,
            'selesai' => $request->selesai,
            'domain' => $request->domain,
            'keterangan_id' => $request->keterangan_id,
            'user_name' => Auth::user()->id
            
        ]);

        History::create([
            'action' => 'create',
            'model_type' => Monitoring::class,
            'model_name' => $monitoring->name, // Menggunakan nama monitoring
            'user_name' => Auth::user()->name, // Menggunakan nama pengguna yang sedang masuk
           'changes' => json_encode([
                'name' => $monitoring->name,
                'created_at' => $monitoring->created_at->isoFormat('D MMMM Y, HH:mm') // Tanggal dibuat
            ]), // Menyimpan data monitoring yang baru ditambahkan
            
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Monitoring Berhasil Di Simpan',
            'url' => route('monitorings.index')
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Monitoring $monitoring)
    {
        return view('monitoring.show', compact('monitoring'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $monitoring = Monitoring::findOrFail($id);
        $projekOptions = ProjekOption::all();
        $keteranganOptions = KeteranganOption::all(); 
        return view('monitoring.edit', compact('monitoring','projekOptions', 'keteranganOptions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Monitoring $monitoring)
    {

        $allowedProjek = ProjekOption::pluck('id')->toArray();
        $allowedKeterangan = KeteranganOption::pluck('id')->toArray();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'projek_id' => ['required', Rule::in($allowedProjek)],
            'bidang' => 'required|string|max:255',
            'mulai' => 'required|date|date_format:Y-m-d', 
            'selesai' => 'required|date|date_format:Y-m-d',
            'domain' => 'required|string|max:255',
            'keterangan_id' => ['required', Rule::in($allowedKeterangan)],
        ]);
        $oldData = $monitoring->getOriginal();

        $monitoring->update([
            'name' => $request->name,
            'projek_id' => $request->projek_id,
            'bidang' => $request->bidang,
            'mulai' => $request->mulai,
            'selesai' => $request->selesai,
            'domain' => $request->domain,
            'keterangan_id' => $request->keterangan_id,
            'user_name' => Auth::user()->id
        ]);

        
        $changes = [];
        $newData = $monitoring->getAttributes();
    
        foreach ($newData as $key => $value) {
            if ($oldData[$key] != $value) {
                $changes[$key] = [
                    'old' => $oldData[$key],
                    'new' => $value
                ];
            }
        }
    
        if (!empty($changes)) {
            // Mencatat histori perubahan
            History::create([
                'action' => 'update',
                'model_type' => Monitoring::class,
                'model_name' => $monitoring->name, // Menyimpan nama monitoring
                'user_name' => Auth::user()->name, // Menggunakan nama pengguna yang sedang login
                'changes' => json_encode($changes) // Menyimpan perubahan yang terjadi dalam format JSON
            ]);
        }


        return response()->json([
            'success' => true,
            'message' => 'Monitoring Berhasil Di Simpan',
            'url' => route('monitorings.index')
        ], 201);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $monitoring = Monitoring::find($id);
        History::create([
            'action' => 'delete',
            'model_type' => Monitoring::class,
            'model_name' => $monitoring->name, // Menggunakan nama monitoring
            'user_name' => Auth::user()->name, // Menggunakan nama pengguna yang sedang masuk
           'changes' => json_encode([
                'id' => $monitoring->id,
                'name' => $monitoring->name // Tanggal dibuat
            ]),  // Menyimpan data monitoring yang akan dihapus
        ]);

        if ($monitoring) {
            $monitoring->delete();
            return response()->json(['message' => 'Produk berhasil dihapus.'], 200);
        }

        return response()->json(['message' => 'Produk tidak ditemukan.'], 404);
    
    }
}
