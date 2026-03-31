<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Sale;
use App\Models\sale_items;
use Illuminate\Support\Facades\DB;
use App\Models\Inventory;
use App\Models\InventoryMovement;
class SalesService
{
    public function createSale(array $data, int $userId): Sale
    {
        return DB::transaction(function () use ($data, $userId) {

            $subtotal = collect($data['items'])
                ->sum(fn ($i) => $i['qty'] * $i['price']);

            $tax = $subtotal * 0.15;
            $total = $subtotal + $tax;

            $amountPaid = isset($data['amount_paid'])
    ? (float) str_replace(',', '.', trim($data['amount_paid']))
    : $total;

            if (($data['payment_type'] ?? 'cash') === 'cash' && round($amountPaid, 2) < round($subtotal, 2)) {
                throw new \Exception('El monto recibido es insuficiente');
            }

            $change = max(0, $amountPaid - $subtotal);

            $sale = Sale::create([
                'sale_number' => $this->generateSaleNumber(),
                'subtotal' => $subtotal,
                'tax' => $tax,
                'discount' => 0,
                'total' => $total,
                'payment_type' => $data['payment_type'],
                'status' => $data['payment_type'] === 'credit' ? 'pending' : 'completed',
                'amount_paid' => $amountPaid,
                'change' => $change,
                'customer_id' => $data['customer_id'] ?? null,
                'created_by' => $userId,
            ]);

            foreach ($data['items'] as $item) {
                $product = Product::findOrFail($item['id']);
// 2. Obtener o crear el registro de inventario para este producto
                $inventory = Inventory::firstOrCreate(
                    ['product_id' => $product->id],
                    ['available_quantity' => 0, 'created_by' => $userId]
                );

                // 3. Validar Stock
                if ($inventory->available_quantity < $item['qty']) {
                    throw new \Exception("Stock insuficiente para {$product->name}. Disponible: {$inventory->available_quantity}");
                }

                $stockBefore = $inventory->available_quantity;
                $stockAfter = $stockBefore - $item['qty'];

                // 4. Actualizar la tabla 'inventories'
                $inventory->update([
                    'available_quantity' => $stockAfter,
                    'updated_by' => $userId
                ]);

                // 5. Registrar el movimiento en 'inventory_movements'
                InventoryMovement::create([
                    'product_id' => $product->id,
                    'type' => 'sale',
                    'quantity' => $item['qty'],
                    'stock_before' => $stockBefore,
                    'stock_after' => $stockAfter,
                    'reference_id' => $sale->id,
                    'reference_type' => Sale::class,
                    'created_by' => $userId,
                    'notes' => "Venta POS #{$sale->sale_number}"
                ]);
                sale_items::create([
                    'sale_mode' => 'unit',
                    'quantity' => $item['qty'],
                    'price_per_unit' => $item['price'],
                    'cost_per_unit' => $product->cost ?? 0,
                    'subtotal' => $item['qty'] * $item['price'],
                    'profit' => ($item['qty'] * $item['price']) - (($product->cost ?? 0) * $item['qty']),
                    'sale_id' => $sale->id,
                    'product_id' => $product->id,
                ]);

                if (! is_null($product->stock)) {
                    if ($product->stock < $item['qty']) {
                        throw new \Exception("Stock insuficiente para {$product->name}");
                    }

                    $product->decrement('stock', $item['qty']);
                }
            }

            return $sale;
        });
    }

    private function generateSaleNumber(): string
    {
        $last = Sale::orderBy('id', 'desc')->first();
        $next = $last ? ((int) substr($last->sale_number, -9)) + 1 : 1;

        return '001-001-'.str_pad($next, 9, '0', STR_PAD_LEFT);
    }
}
