<?php

namespace App\Http\Controllers;

use App\Models\suppliers;
use Illuminate\Http\Request;

class SuppliersController extends Controller
{
    /**
     * Mostrar lista de proveedores (paginado)
     */
    public function create()
    {
        $supplier = suppliers::paginate(20);
        return view('suppliers.create', compact('supplier'));
    }

    /**
     * Guardar nuevo proveedor
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'contact_name' => 'required|string|max:255',
                'phone' => 'required|digits_between:7,15',
                'email' => 'required|email|max:255',
                'address' => 'required|string|max:255',
                'ruc' => 'required|max:15|unique:suppliers,ruc',
                'notes' => 'nullable|string|max:1000'
            ]);

            $supplier = Suppliers::create($validated);

            // 🔥 Si la petición viene de AJAX (fetch)
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Proveedor registrado correctamente',
                    'supplier' => $supplier
                ]);
            }

            // En caso de ser una petición normal (desde navegador)
            return redirect()
                ->route('suppliers.create')
                ->with('success', 'Proveedor registrado correctamente');
        } catch (\Exception $e) {
            // Manejo de error
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Ocurrió un error al guardar el proveedor',
                    'error' => $e->getMessage()
                ], 500);
            }

            return redirect()->back()->with('error', 'Ocurrió un error al guardar el proveedor');
        }
    }

    /**
     * Actualizar un proveedor existente
     */
    public function update(Request $request, Suppliers $supplier)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'contact_name' => 'required|string|max:255',
                'phone' => 'required|digits_between:7,15',
                'email' => 'required|email|max:255',
                'address' => 'required|string|max:255',
                'ruc' => 'required|max:15|unique:suppliers,ruc,' . $supplier->id,
                'notes' => 'nullable|string|max:1000'
            ]);

            $supplier->update($validated);

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Proveedor actualizado correctamente',
                    'supplier' => $supplier
                ]);
            }

            return redirect()
                ->route('suppliers.create')
                ->with('success', 'Proveedor actualizado correctamente');
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error al actualizar el proveedor',
                    'error' => $e->getMessage()
                ], 500);
            }

            return redirect()->back()->with('error', 'Error al actualizar el proveedor');
        }
    }
    public function destroy(Request $request, suppliers $supplier)
    {
        try {
            $supplier->delete();

            return redirect()
                ->route('suppliers.create')
                ->with('success', 'Proveedor eliminado correctamente')->with('toast', 'deleted');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al eliminar el proveedor') ->with('toast', 'error'); 
        }
    }   
}
