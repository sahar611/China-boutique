<?php
namespace Database\Seeders;

use App\Models\WorkStep;
use Illuminate\Database\Seeder;

class WorkStepSeeder extends Seeder
{
  public function run(): void
  {
    $data = [
      [
        'step_no'=>1,
        'title_en'=>'Browsing & Choosing',
        'title_ar'=>'تصفّح واختيار المنتجات',
        'desc_en'=>'This is where customers visit your online store, browse your products.',
        'desc_ar'=>'هنا يقوم العملاء بزيارة المتجر وتصفح المنتجات واختيار ما يناسبهم.',
        'icon_type'=>'class',
        'icon_class'=>'flaticon-search',
        'sort_order'=>1,
        'is_active'=>1
      ],
      [
        'step_no'=>2,
        'title_en'=>'Checkout & Payment',
        'title_ar'=>'الدفع وإتمام الطلب',
        'desc_en'=>'Once they have picked their items, customers proceed to checkout.',
        'desc_ar'=>'بعد اختيار المنتجات ينتقل العميل لإتمام عملية الدفع.',
        'icon_type'=>'class',
        'icon_class'=>'flaticon-payment',
        'sort_order'=>2,
        'is_active'=>1
      ],
      [
        'step_no'=>3,
        'title_en'=>'Order Fulfillment',
        'title_ar'=>'تجهيز الطلب',
        'desc_en'=>"After the order is placed, it's sent to your fulfillment team.",
        'desc_ar'=>'بعد إنشاء الطلب يتم إرساله لفريق التجهيز.',
        'icon_type'=>'class',
        'icon_class'=>'flaticon-box',
        'sort_order'=>3,
        'is_active'=>1
      ],
      [
        'step_no'=>4,
        'title_en'=>'Delivery to Customer',
        'title_ar'=>'توصيل للعميل',
        'desc_en'=>'The packed order is then sent off with a shipping carrier.',
        'desc_ar'=>'بعد تجهيز الطلب يتم شحنه للعميل عبر شركة التوصيل.',
        'icon_type'=>'class',
        'icon_class'=>'flaticon-delivery',
        'sort_order'=>4,
        'is_active'=>1
      ],
    ];

    foreach ($data as $row) {
      WorkStep::updateOrCreate(['step_no' => $row['step_no']], $row);
    }
  }
}
