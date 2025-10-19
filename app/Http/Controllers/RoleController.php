<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::with('permissions')->paginate(10);
          $permissions = Permission::all(); 
        return view('admin.roles.index', compact('roles', 'permissions'));
    }

    public function create()
    {
       return redirect()->route('admin.roles.index'); }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permissions' => 'array'
        ]);

        $role = Role::create(['name' => $request->name]);
        if ($request->has('permissions')) {
            $role->syncPermissions($request->permissions);
        }

        return redirect()->route('admin.roles.index')->with('success', 'Rol creado correctamente');
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('admin.roles.edit', compact('role', 'permissions'));
    }

   public function update(Request $request, Role $role)
{
    // Validación solo para permisos
    $request->validate([
        'permissions' => 'array'
    ]);

    // Actualiza nombre solo si viene en el request
    if ($request->filled('name')) {
        $role->update(['name' => $request->name]);
    }

    // Actualiza permisos
    $role->syncPermissions($request->permissions ?? []);

    return redirect()->route('admin.roles.index')->with('success', 'Rol actualizado correctamente');
}


    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('admin.roles.index')->with('success', 'Rol eliminado correctamente');
    }
}
