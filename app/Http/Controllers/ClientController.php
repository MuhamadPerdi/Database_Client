<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\History;
use Illuminate\Http\Request;
use App\Models\jenis_options;
use App\Models\status_options;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;


class ClientController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::with('jenis', 'status')->latest()->take(10)->get(); 
        return view('clients.index', compact('clients'));
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jenisOptions = jenis_options::all();
        $statusOptions = status_options::all();
        return view('clients.create',(compact('jenisOptions', 'statusOptions')));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         // Retrieve allowed values
         $allowedJenis = jenis_options::pluck('id')->toArray();
         $allowedStatus = status_options::pluck('id')->toArray();

        $request->validate([
            'name' => 'required|string|max:255',
            'tanggal' => 'required|date|date_format:Y-m-d', 
            'jenis_id' => ['required', Rule::in($allowedJenis)],
            'kebutuhan' => 'required|string',
            'no_telp' => 'required|string|max:15', 
            'alamat' => 'required|string', 
            'sumber' => 'required|string',
            'keterangan' => 'required|string',
            'status_id' => ['required', Rule::in($allowedStatus)],
        ]);
       
       $client = Client::create([
            'name' => $request->name,
            'tanggal' => $request->tanggal,
            'jenis_id' => $request->jenis_id,
            'kebutuhan' => $request->kebutuhan,
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
            'sumber' => $request->sumber,
            'keterangan' => $request->keterangan,
            'status_id' => $request->status_id,
            'user_name' => Auth::user()->id
        ]);
        // History::create([
        //     'action' => 'create',
        //     'model_type' => Client::class,
        //     'model_name' => $client->name, // Nama client yang baru dibuat
        //     'user_name' => Auth::user()->name, // Nama user yang membuat
        //     'changes' => json_encode([
        //         'name' => $client->name,
        //         'created_at' => $client->created_at->isoFormat('D MMMM Y, HH:mm')  // Tanggal dibuat
        //     ]), // Menyimpan perubahan dengan nama dan tanggal dalam format JSON
        // ]);

        
        return response()->json([
            'success' => true,
            'message' => 'Client Berhasil Di Simpan',
            'url' =>  route('clients.index')
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = Client::findOrFail($id);
        $client->tanggal = Carbon::parse($client->tanggal);
        return view('clients.show' , compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = Client::findOrFail($id);
        $client->tanggal = Carbon::parse($client->tanggal);
        $jenisOptions = jenis_options::all();
        $statusOptions = status_options::all();
        return view('clients.edit', compact('client','jenisOptions', 'statusOptions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        // Retrieve allowed values
        $allowedJenis = jenis_options::pluck('id')->toArray();
        $allowedStatus = status_options::pluck('id')->toArray();
    
        $request->validate([
            'name' => 'required|string|max:255',
            'tanggal' => 'required|date|date_format:Y-m-d', 
            'jenis_id' => ['required', Rule::in($allowedJenis)],
            'kebutuhan' => 'required|string',
            'no_telp' => 'required|string|max:15', 
            'alamat' => 'required|string',
            'sumber' => 'required|string',
            'keterangan' => 'required|string',
            'status_id' => ['required', Rule::in($allowedStatus)],
        ]);
    
        // // Menyimpan data lama sebelum update
        // $oldData = $client->getOriginal();
    
     
        $client->update([
            'name' => $request->name,
            'jenis_id' => $request->jenis_id,
            'status_id' => $request->status_id,
            'alamat' => $request->alamat,
            'kebutuhan' => $request->kebutuhan,
            'sumber' => $request->sumber,
            'no_telp' => $request->no_telp,
            'keterangan' => $request->keterangan,
            'tanggal' => $request->tanggal,
            'user_name' => Auth::user()->id
        ]);
    
        // // Menyimpan perubahan hanya jika ada perubahan
        // $changes = [];
        // $newData = $client->getAttributes();
    
        // foreach ($newData as $key => $value) {
        //     if ($oldData[$key] != $value) {
        //         $changes[$key] = [
        //             'old' => $oldData[$key],
        //             'new' => $value
        //         ];
        //     }
        // }
    
        // if (!empty($changes)) {
        //     // Mencatat histori perubahan
        //     History::create([
        //         'action' => 'update',
        //         'model_type' => Client::class,
        //         'model_name' => $client->name, 
        //         'user_name' => Auth::user()->name,
        //         'changes' => json_encode($changes) 
        //     ]);
        // }
    
        return response()->json([
            'success' => true,
            'message' => 'Client Berhasil Di Simpan',
            'url' => route('clients.index')
        ], 200);
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        // History::create([
        //     'action' => 'delete',
        //     'model_type' => Client::class,
        //     'model_name' => $client->name, 
        //     'user_name' => Auth::user()->name, 
        //     'changes' => json_encode([
        //         'id' => $client->id,
        //         'name' => $client->name
        //     ]), 
        // ]);
        $client->delete();

        return redirect()->route('clients.index')
                         ->with('success', 'client deleted successfully');
    }


}
