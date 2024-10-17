<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\LoginHistory;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Permission;


class UserController extends Controller
{
    public function index(Request $request)
{
    $query = User::query();

    // Apply filters based on query parameters
    if ($request->filled('id')) {
        $query->where('id', $request->input('id'));
    }
    if ($request->filled('name')) {
        $query->where('name', 'like', '%' . $request->input('name') . '%');
    }
    if ($request->filled('authorities')) {
        $query->whereHas('roles', function ($q) use ($request) {
            $q->where('name', 'like', '%' . $request->input('authorities') . '%');
        });
    }
    if ($request->has('active')) {
        $query->where('active', 1);
    }

    $users = $query->paginate(10);

    return view('users.index', compact('users'));
}

    public function create()
    {
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'roles' => 'required|array'
        ]);

        $user = User::create($request->only('name', 'email', 'password'));

        if ($request->roles) {
            $user->assignRole($request->roles);
        }

        return response()->json([
            'success' => true,
            'message' => 'User Berhasil Di Simpan',
            'url' => route('users.index')
        ], 201);
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6|confirmed',
            'roles' => 'required|array'
        ]);
    
        $user->update($request->only('name', 'email'));
    
        if ($request->input('password')) {
            $user->password = bcrypt($request->input('password'));
          }
    
        $user->syncRoles($request->roles);
    
        return response()->json([
            'success' => true,
            'message' => 'User Berhasil Di Simpan',
            'url' => route('users.index')
        ], 201);
    }
    

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }

    public function updateStatus(User $user)
    {
        $user->active = !$user->active;
        $user->save();

        return redirect()->route('users.index')->with('success', 'User status updated successfully.');
    }

    public function Fitur()
    {
        $roles = Role::all();
        return view('role.index', compact('roles'));
    }
    

    public function createFitur()
    {

         // Mengambil data fitur dari database dan mengelompokkan sesuai kategori
         $featuresMasterAdmin = Permission::where('category', 'master-admin')->get();
         $featuresLainnya = Permission::where('category', 'lainnya')->get();
 
         return view('role.create', compact('featuresMasterAdmin', 'featuresLainnya'));
    }

    public function storeFitur(Request $request)
    {
        // Validasi input
        $request->validate([
            'role_name' => 'required|string|max:255|unique:roles,name',
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,name',
        ]);
    
        // Buat role baru
        $role = Role::create(['name' => $request->role_name]);
    
        // Kaitkan permissions yang dipilih dengan role
        $role->givePermissionTo($request->permissions);
    
        // Redirect atau beri respon sukses
        return response()->json([
            'success' => true,
            'message' => 'Fitur Berhasil Di Simpan',
            'url' => route('fitur.index')
        ], 201);
    }
    

    

public function editFitur($roleId)
{
    // Temukan role berdasarkan ID
    $role = Role::findOrFail($roleId);

    // Mengambil data fitur dari database dan mengelompokkan sesuai kategori
    $featuresMasterAdmin = Permission::where('category', 'master-admin')->get();
    $featuresLainnya = Permission::where('category', 'lainnya')->get();
   

    // Mengambil permissions yang sudah dimiliki oleh role
    $rolePermissions = $role->permissions->pluck('id')->toArray();

    return view('role.edit', compact('role', 'featuresMasterAdmin', 'featuresLainnya', 'rolePermissions'));
}

public function updateFitur(Request $request, $roleId)
{
    // Validasi input
    $request->validate([
        'role_name' => 'required|string|max:255',
        'permissions' => 'required|array',
        'permissions.*' => 'exists:permissions,id',
    ]);

    $role = Role::findById($roleId);

    // Perbarui nama role
    $role->name = $request->role_name;
    $role->save();

    // Sinkronkan permissions yang dipilih dengan role
    $role->syncPermissions(Permission::whereIn('id', $request->permissions)->get());

    // Redirect atau beri respon sukses
    return response()->json([
        'success' => true,
        'message' => 'Fitur Berhasil Di Simpan',
        'url' => route('fitur.index')
    ], 201);
}


public function destroyFitur($roleId)
{
    // Temukan role berdasarkan ID
    $role = Role::findOrFail($roleId);

    // Hapus semua permissions yang terkait dengan role
    $role->revokePermissionTo($role->permissions);

    // Hapus role
    $role->delete();

    // Redirect atau beri respon sukses
    return redirect()->route('fitur.index')->with('success', 'Role dan fitur berhasil dihapus.');
}

// Show profile form
public function editProfile()
{
    $user = auth()->user();
    return view('profile.edit', compact('user'));
}

// Update profile
public function updateProfile(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'password' => 'nullable|string|min:8|confirmed',
        'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $user = auth()->user();
    $user->name = $request->input('name');
    $user->email = $request->input('email');

    // Handle file upload
    if ($request->hasFile('avatar')) {
        // Delete old avatar if it exists
        if ($user->avatar && Storage::exists($user->avatar)) {
            Storage::delete($user->avatar);
        }

        // Upload new avatar
        $avatarPath = $request->file('avatar')->store('avatars', 'public');
        $user->avatar = $avatarPath;
    }

    if ($request->filled('password')) {
        $user->password = Hash::make($request->input('password'));
    }

    $user->save();

    return redirect()->route('profile.edit')->with('success', 'Profile updated successfully.');
}

// protected function authenticated($request, $user)
// {
//     // Record the login history
//     LoginHistory::create([
//         'user_id' => $user->id,
//         'ip_address' => $request->ip(),
//     ]);
// }



}
