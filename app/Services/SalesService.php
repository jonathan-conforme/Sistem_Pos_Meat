<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Sale;
use App\Models\sale_items;
use Illuminate\Support\Facades\DB;

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
