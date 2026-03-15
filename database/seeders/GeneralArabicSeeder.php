<?php

namespace Database\Seeders;

use App\Models\Section;
use App\Models\Product;
use App\Models\Invoice;
use App\Models\InvoiceDetails;
use Illuminate\Database\Seeder;

class GeneralArabicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sections = [
            [
                'name' => 'البنك الاهلي المصري',
                'description' => 'قسم خاص بمنتجات البنك الاهلي المصري',
                'products' => ['قروض شخصية', 'بطاقات ائتمانية', 'حسابات توفير'],
            ],
            [
                'name' => 'بنك مصر',
                'description' => 'قسم خاص بمنتجات بنك مصر',
                'products' => ['قروض عقارية', 'شهادات ادخار', 'خدمات في اي بي'],
            ],
            [
                'name' => 'بنك القاهرة',
                'description' => 'قسم خاص بمنتجات بنك القاهرة',
                'products' => ['قروض سيارات', 'تمويل مشروعات', 'بطاقات خصم مباشر'],
            ],
        ];

        foreach ($sections as $index => $sectionData) {
            $section = Section::firstOrCreate(
                ['name' => $sectionData['name']],
                [
                    'description' => $sectionData['description'],
                    'created_by' => 'Admin',
                ]
            );

            foreach ($sectionData['products'] as $productName) {
                Product::firstOrCreate(
                    [
                        'name' => $productName,
                        'section_id' => $section->id,
                    ],
                    [
                        'description' => 'وصف لمنتج ' . $productName,
                    ]
                );
            }

        // إضافة 100 فاتورة متنوعة
        $statuses = [
            ['Status' => 'مدفوعة', 'Value_Status' => 1],
            ['Status' => 'غير مدفوعة', 'Value_Status' => 2],
            ['Status' => 'مدفوعة جزئيا', 'Value_Status' => 3],
        ];

        $allSections = Section::all();
        
        for ($i = 1; $i <= 100; $i++) {
            $section = $allSections->random();
            $products = Product::where('section_id', $section->id)->pluck('name')->toArray();
            $product = $products[array_rand($products)];
            $status = $statuses[array_rand($statuses)];
            
            $amountCommission = rand(1000, 5000);
            $discount = rand(0, 500);
            $rateVat = '14%';
            $valueVat = ($amountCommission - $discount) * 0.14;
            $total = ($amountCommission - $discount) + $valueVat;

            $invoice = Invoice::updateOrCreate(
                ['invoice_number' => 'INV-2025-' . str_pad($i, 3, '0', STR_PAD_LEFT)],
                [
                    'invoice_Date' => now()->subDays(rand(1, 60))->format('Y-m-d'),
                    'Due_date' => now()->addDays(rand(1, 30))->format('Y-m-d'),
                    'product' => $product,
                    'section_id' => $section->id,
                    'Amount_collection' => rand(10000, 50000),
                    'Amount_Commission' => $amountCommission,
                    'Discount' => $discount,
                    'Value_VAT' => $valueVat,
                    'Rate_VAT' => $rateVat,
                    'Total' => $total,
                    'Status' => $status['Status'],
                    'Value_Status' => $status['Value_Status'],
                    'note' => 'فاتورة تلقائية رقم ' . $i,
                ]
            );

            InvoiceDetails::updateOrCreate(
                ['invoice_id' => $invoice->id],
                [
                    'invoice_number' => $invoice->invoice_number,
                    'product' => $invoice->product,
                    'section' => $section->name,
                    'status' => $invoice->Status,
                    'value_status' => $invoice->Value_Status,
                    'notes' => $invoice->note,
                    'user' => 'Abdallah',
                ]
            );
        }
    }
}
}