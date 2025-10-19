<?php

namespace App\Http\Controllers;

use App\Models\categories; // Cambiar a singular
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
  public function index(Request $request)
{
    $categories = categories::withCount('products')
        ->with('parent')
        ->when($request->search, function($query, $search) {
            return $query->search($search);
        })
        ->when($request->has('active') && $request->active !== '', function($query) use ($request) {
            return $query->where('is_active', $request->active);
        })
        ->orderBy('sort_order')
        ->orderBy('name')
        ->paginate(20); // 

    return view('categories.index', compact('categories'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         $categories = Categories::withCount('products')
        ->with('parent')
        ->orderBy('sort_order')
        ->orderBy('name')
        ->paginate(20); // O el número que prefieras

    return view('categories.create', compact('categories'));    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:categories,name',
                'code' => 'nullable|string|max:50|unique:categories,code',
                'description' => 'nullable|string|max:500',
                'color' => 'nullable|string|max:7',
                'is_active' => 'sometimes|boolean',
                'sort_order' => 'nullable|integer|min:0',
                'parent_id' => 'nullable|exists:categories,id'
            ]);

            // Generar código automático si no se proporciona
            if (empty($validated['code'])) {
                $validated['code'] = categories::generateCode($validated['name']);
            }

            // Valores por defecto
            $validated['is_active'] = $validated['is_active'] ?? true;
            $validated['sort_order'] = $validated['sort_order'] ?? 0;
            $validated['color'] = $validated['color'] ?? '#6B7280';

            $category = categories::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Categoría creada exitosamente',
                'category' => $category->load('parent')
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error de validación',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            \Log::error('Error creating category: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Error al crear la categoría: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(categories $category) // Cambiar parámetro a singular
    {
        $category->load(['parent', 'children', 'products']);
        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(categories $category) // Cambiar parámetro a singular
    {
        $categories = categories::active()
            ->where('id', '!=', $category->id) // Excluir la categoría actual
            ->main()
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('categories.edit', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, categories $category): JsonResponse
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
                'code' => 'nullable|string|max:50|unique:categories,code,' . $category->id,
                'description' => 'nullable|string|max:500',
                'color' => 'nullable|string|max:7',
                'is_active' => 'sometimes|boolean',
                'sort_order' => 'nullable|integer|min:0',
                'parent_id' => 'nullable|exists:categories,id'
            ]);

            // Evitar que una categoría sea su propio padre
            if ($validated['parent_id'] == $category->id) {
                return response()->json([
                    'success' => false,
                    'message' => 'Una categoría no puede ser su propio padre'
                ], 422);
            }

            // Evitar referencias circulares
            if ($this->hasCircularReference($category, $validated['parent_id'])) {
                return response()->json([
                    'success' => false,
                    'message' => 'No se puede asignar una subcategoría como padre (referencia circular)'
                ], 422);
            }

            $category->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Categoría actualizada exitosamente',
                'category' => $category->fresh(['parent'])
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error de validación',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            \Log::error('Error updating category: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar la categoría: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(categories $category): JsonResponse
    {
        try {
            // Verificar si la categoría tiene productos
            if ($category->hasProducts()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No se puede eliminar la categoría porque tiene productos asociados'
                ], 422);
            }

            // Verificar si la categoría tiene subcategorías
            if ($category->children()->exists()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No se puede eliminar la categoría porque tiene subcategorías'
                ], 422);
            }

            $category->delete();

            return response()->json([
                'success' => true,
                'message' => 'Categoría eliminada exitosamente'
            ]);

        } catch (\Exception $e) {
            \Log::error('Error deleting category: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar la categoría: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Obtener categorías para select (API)
     */
    public function getCategoriesForSelect(): JsonResponse
    {
        $category = categories::active()
            ->main()
            ->with(['children' => function($query) {
                $query->active()->orderBy('sort_order')->orderBy('name');
            }])
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return response()->json($category);
    }

    /**
     * Restaurar categoría eliminada
     */
    public function restore($id): JsonResponse
    {
        try {
            $category = categories::withTrashed()->findOrFail($id);
            $category->restore();

            return response()->json([
                'success' => true,
                'message' => 'Categoría restaurada exitosamente'
            ]);

        } catch (\Exception $e) {
            \Log::error('Error restoring category: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Error al restaurar la categoría: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Verificar referencias circulares
     */
    private function hasCircularReference(categories $category, $parentId): bool
    {
        if (!$parentId) {
            return false;
        }

        $parent = categories::find($parentId);
        
        // Verificar si el padre propuesto es un descendiente de la categoría actual
        while ($parent) {
            if ($parent->id === $category->id) {
                return true;
            }
            $parent = $parent->parent;
        }

        return false;
    }
   public function stats(): \Illuminate\Http\JsonResponse
{
    try {
        $all = \App\Models\Categories::withCount('products')->get();

        return response()->json([
            'success' => true,
            'total' => $all->count(),
            'active' => $all->where('is_active', true)->count(),
            'inactive' => $all->where('is_active', false)->count(),
            'with_products' => $all->where('products_count', '>', 0)->count(),
        ]);
    } catch (\Exception $e) {
        \Log::error('Error al obtener estadísticas: ' . $e->getMessage());
        return response()->json([
            'success' => false,
            'message' => 'Error al obtener estadísticas: ' . $e->getMessage(),
        ], 500);
    }
}
}

