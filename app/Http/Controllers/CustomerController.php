<?php

namespace App\Http\Controllers;

use App\Models\customer;
use Illuminate\Http\Request;


class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()

    {
         $customers = customer::paginate(10); // 10 por página, puedes cambiar el número
    return view('customer.create', compact('customers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $validatedData = $request->validate([
    'name' => 'required|string|max:255',
    'cedula' => 'required|string|regex:/^[0-9]{6,15}$/|unique:customers,cedula',
    'email' => 'required|email|max:255',
    'phone' => 'required|digits_between:7,15',
    'address' => 'required|string|max:255',
    'comments' => 'nullable|string|max:1000',
], [
    'cedula.required' => 'La cédula es obligatoria.',
    'cedula.regex' => 'La cédula solo puede contener números. ¡Ponte pilas!',
    'cedula.unique' => 'Esta cédula ya está registrada.',
    'phone.required' => 'El teléfono es obligatorio.',
    'phone.digits_between' => 'El teléfono debe tener entre 7 y 15 dígitos y solo números.',
    'email.required' => 'El correo electrónico es obligatorio.',
    'email.email' => 'Ingresa un correo válido.',
    'name.required' => 'El nombre es obligatorio.',
    'address.required' => 'La dirección es obligatoria.',
]);


        customer::create($validatedData);

        return redirect()->route('customer.create')->with('success', 'Cliente registrado exitosamente.');

    }

    /**
     * Display the specified resource.
     */
    public function show(customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(customer $customer)
    {
        //
    }
    public function search(Request $request)
{
    $query = $request->get('q');
    
    $customers = Customer::where('name', 'like', "%{$query}%")
                        ->orWhere('cedula', 'like', "%{$query}%")
                        ->orWhere('phone', 'like', "%{$query}%")
                        ->limit(10)
                        ->get(['id', 'name', 'cedula', 'phone', 'email']);
    
    return response()->json($customers);
}
public function buscar($cedula)
{
    $cliente = Customer::where('cedula', $cedula)->first();
    if ($cliente) {
        return response()->json($cliente);
    } else {
        return response()->json(['error' => 'No encontrado'], 404);
    }
}

}
