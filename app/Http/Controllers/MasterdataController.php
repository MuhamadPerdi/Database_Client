<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\ProjekOption;
use Illuminate\Http\Request;
use App\Models\jenis_options;
use App\Models\status_options;
use App\Models\KeteranganOption;
use Illuminate\Support\Facades\DB;


class MasterdataController extends Controller

{
    public function jenis()
    {
        $jenisOptions = jenis_options::withCount('client')->get();
        return view('master data.jenis client.index', compact('jenisOptions'));
    }

    public function addjenis()
    {
      
        return view('master data.jenis client.create');
    }

    public function editjenis($id)
    {
        $jenis = jenis_options::findOrFail($id);
        return view('master data.jenis client.edit',(compact('jenis')));
    }
    public function storejenis(Request $request)
{
    $request->validate([
        'jenis' => 'required|string|unique:jenis_options,jenis',
    ]);

    jenis_options::create([
        'jenis' => $request->jenis,
    ]);

    
    return response()->json([
        'success' => true,
        'message' => 'Jenis Berhasil Di Simpan',
        'url' => route('jenis.index')
    ], 201);
}

public function updatejenis(Request $request, $id)
{
    $request->validate([
        'jenis' => 'required|string|unique:jenis_options,jenis,' . $id,
    ]);

    $jenis = jenis_options::findOrFail($id);
    $jenis->jenis = $request->jenis;
    $jenis->save();

  
    return response()->json([
        'success' => true,
        'message' => 'Data Berhasil Di Simpan',
        'url' => route('jenis.index')
    ], 201);
}

public function destroyjenis($id)
{
    $jenis = jenis_options::findOrFail($id);
    $jenis->delete();

    return redirect()->route('jenis.index')->with('success', 'Jenis deleted successfully!');
}


public function status()
{
    $status = status_options::withCount('client')->get();
    return view('master data.status client.index', compact('status'));
}

public function addstatus()
{ 
    return view('master data.status client.create');
}
public function editstatus($id)
{
    $status = status_options::findOrFail($id);
    return view('master data.status client.edit',(compact('status')));
}
public function storeStatus(Request $request)
{
    $request->validate([
        'status' => 'required|string|unique:status_options,status',
    ]);

    status_options::create([
        'status' => $request->status,
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Data Berhasil Di Simpan',
        'url' => route('status.index')
    ], 201);
}

public function updatestatus(Request $request, $id)
{
    $request->validate([
        'status' => 'required|string|unique:status_options,status,' . $id,
    ]);

    $status = status_options::findOrFail($id);
    $status->status = $request->status;
    $status->save();

    return response()->json([
        'success' => true,
        'message' => 'Data Berhasil Di Simpan',
        'url' => route('status.index')
    ], 201);
}


public function destroystatus($id)
{
    $status = status_options::findOrFail($id);
    $status->delete();

    return redirect()->route('status.index')->with('success', 'Status deleted successfully!');
}
public function keterangan()
{
    $keterangan = KeteranganOption::withCount('monitoring')->get();
    return view('master data.keterangan monitoring.index', compact('keterangan'));
}

public function addketerangan()
{
  
    return view('master data.keterangan monitoring.create');
}
public function editketerangan($id)
{
    $keterangan = KeteranganOption::findOrFail($id);
    return view('master data.keterangan monitoring.edit',(compact('keterangan')));
}
public function storeketerangan(Request $request)
{
    $request->validate([
        'name' => 'required|string|unique:keterangan_options',
    ]);

    KeteranganOption::create([
        'name' => $request->name,
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Data Berhasil Di Simpan',
        'url' => route('keterangan.index')
    ], 201);
}

public function updateketerangan(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|unique:keterangan_options' . $id,
    ]);

    $keterangan = KeteranganOption::findOrFail($id);
    $keterangan->name = $request->name;
    $keterangan->save();

    return response()->json([
        'success' => true,
        'message' => 'Data Berhasil Di Simpan',
        'url' => route('keterangan.index')
    ], 201);
}


public function destroyketerangan($id)
{
    $keterangan = KeteranganOption::findOrFail($id);
    $keterangan->delete();

    return redirect()->route('keterangan.index')->with('success', 'keterangan deleted successfully!');
}
public function projek()
{
     $projek = ProjekOption::withCount('monitoring')->get();
    return view('master data.projek monitoring.index', compact('projek'));
}

public function addprojek()
{
  
    return view('master data.projek monitoring.create');
}
public function editprojek($id)
{
    $projek = ProjekOption::findOrFail($id);
    return view('master data.projek monitoring.edit',(compact('projek')));
}
public function storeprojek(Request $request)
{
    $request->validate([
        'name' => 'required|string|unique:projek_options'
    ]);

    ProjekOption::create([
        'name' => $request->name,
    ]);

    return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Di Simpan',
            'url' => route('projek.index')
        ], 201);
}

public function updateprojek(Request $request, $id)
{
        $request->validate([
            'name' => 'required|string|unique:projek_options,name,' . $id,
        ]);

        DB::beginTransaction();

        $projek = ProjekOption::findOrFail($id);
        $projek->name = $request->name;
        $projek->save();

        DB::commit();

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Disimpan',
            'url' => route('projek.index')
        ], 200);
}





public function destroyprojek($id)
{
    $projek = ProjekOption::findOrFail($id);
    $projek->delete();

    return redirect()->route('projek.index')->with('success', 'projek deleted successfully!');
}


public function history()
{
    $history = History::with('user')->orderBy('created_at', 'desc')->get();
    return view('users.history', compact('history'));
}

}
