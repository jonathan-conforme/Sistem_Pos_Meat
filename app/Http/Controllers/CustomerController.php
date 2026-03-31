<?php

namespace App\Http\Controllers;

use App\Models\customer;
use Illuminate\Http\Request;


class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');

        $query = Customer::query();

        if ($search) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('cedula', 'like', "%{$search}%");
        }

        $customers = $query->orderBy('created_at', 'desc')->paginate(20);
        $totalCustomers = Customer::count(); // Total global de clientes
  $highlightId = session()->pull('highlight_customer_id');
        return view('customer.create', compact('customers', 'totalCustomers', 'highlightId'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()

    {
        $customers = Customer::latest()->paginate(20);
        $totalCustomers = Customer::count(); // Total global de clientes
        return view('customer.create', compact('customers', 'totalCustomers'));
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


        $customer = Customer::create($validatedData);

        // Guardar el ID en sesión para resaltarlo
        session(['highlight_customer_id' => $customer->id]);

        return redirect()->route('customer.index', ['page' => 1])
                         ->with('success', 'Cliente registrado exitosamente');   }

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
        return response()->json($customer);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, customer $customer)
    {

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'cedula' => 'required|string|regex:/^[0-9]{6,15}$/|unique:customers,cedula,' . $customer->id,
            'email' => 'required|email|max:255' . $customer->id ,
            'phone' => 'required|digits_between:7,15',
            'address' => 'required|string|max:255',
            'comments' => 'nullable|string|max:1000',
        ], [
            'cedula.required' => 'La cédula es obligatoria.',
            'cedula.regex' => 'La cédula solo puede contener números.',
            'cedula.unique' => 'Esta cédula ya está registrada.',
            'phone.required' => 'El teléfono es obligatorio.',
            'phone.digits_between' => 'El teléfono debe tener entre 7 y 15 dígitos.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Ingresa un correo válido.',
            'name.required' => 'El nombre es obligatorio.',
            'address.required' => 'La dirección es obligatoria.',
        ]);

           $customer->update($validatedData);
// Obtener la página actual del request o usar la página 1 por defecto
        $currentPage = $request->input('current_page', 1);

        return redirect()->route('customer.index', ['page' => $currentPage, 'edited' => $customer->id])
                         ->with('info', 'Cliente actualizado exitosamente');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(customer $customer)
    {
        $customer->delete();

        return redirect()->route('customer.create')->with('success', 'Cliente eliminado correctamente.');
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
