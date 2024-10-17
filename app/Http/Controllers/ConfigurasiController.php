<?php

namespace App\Http\Controllers;

use App\Models\configurasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ConfigurasiController extends Controller
{
    public function configurasi()
    {
        $konfigurasi = Configurasi::first();
        return view('configurasi.index', compact('konfigurasi'));
    }

    public function configurasi_update(Request $request, $id)
{
    // Find the konfigurasi record
    $konfigurasi = configurasi::find($id);

    if (!$konfigurasi) {
        return redirect()->back()->with('error', 'Konfigurasi not found.');
    }

    // Validate data input
    $request->validate([
        'title' => 'required|string|max:255',
        'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'favicon' => 'nullable|image|mimes:ico,png,jpg|max:2048',
        'email' => 'required|email|max:255',
        'email2' => 'required|email|max:255',
        'phone' => 'required|string|max:20',
        'alamat' => 'required|string|max:255',
        'map' => 'required|string',
        'footer' => 'required|string|max:255',
        'instagram' => 'nullable|url|max:255',
        'facebook' => 'nullable|url|max:255',
        'twitter' => 'nullable|url|max:255',
        'youtube' => 'nullable|url|max:255',
        'whatsapp' => 'nullable|url|max:255',
        'linkedin' => 'nullable|url|max:255',
        'overview' => 'required|string',
        'metakeyword' => 'required|string',
        'metadeskripsi' => 'required|string',
    ]);

    // Update the fields
    $konfigurasi->title = $request->title;
    $konfigurasi->email = $request->email;
    $konfigurasi->email2 = $request->email2;
    $konfigurasi->phone = $request->phone;
    $konfigurasi->alamat = $request->alamat;
    $konfigurasi->map = $request->map;
    $konfigurasi->footer = $request->footer;
    $konfigurasi->instagram = $request->instagram;
    $konfigurasi->facebook = $request->facebook;
    $konfigurasi->twitter = $request->twitter;
    $konfigurasi->youtube = $request->youtube;
    $konfigurasi->whatsapp = $request->whatsapp;
    $konfigurasi->linkedin = $request->linkedin;
    $konfigurasi->overview = $request->overview;
    $konfigurasi->metakeyword = $request->metakeyword;
    $konfigurasi->metadeskripsi = $request->metadeskripsi;

    // Handle file uploads
    if ($request->hasFile('logo')) {
        if ($konfigurasi->logo) {
            Storage::delete(str_replace('/storage/', 'public/', $konfigurasi->logo)); // Remove old logo
        }
        $logoPath = $request->file('logo')->store('public/logos');
        $konfigurasi->logo = Storage::url($logoPath);
    }

    if ($request->hasFile('favicon')) {
        if ($konfigurasi->favicon) {
            Storage::delete(str_replace('/storage/', 'public/', $konfigurasi->favicon)); // Remove old favicon
        }
        $faviconPath = $request->file('favicon')->store('public/favicons');
        $konfigurasi->favicon = Storage::url($faviconPath);
    }

    // Save the updated record
    $konfigurasi->save();

    return response()->json([
        'success' => true,
        'message' => 'Configurasi Berhasil Di Simpan',
        'url' => route('configurasi')
    ], 200);
}
}
