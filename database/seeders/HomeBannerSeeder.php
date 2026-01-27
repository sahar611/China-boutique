<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
 use App\Models\HomeBanner;
class HomeBannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   

public function run()
{
    HomeBanner::updateOrCreate(
        ['position'=>'promo_section','sort_order'=>1],
        [
            'is_active'=>1,
            'discount_percent'=>50,
            'title_en'=>'Exclusive Kids & Adults',
            'title_ar'=>'ملابس حصرية للأطفال والكبار',
            'subtitle_en'=>'Summer Outfits',
            'subtitle_ar'=>'أزياء صيفية',
           
            'link'=>'/shop',
            'image'=>'uploads/banners/promo-1.png',
            
        ]
    );

    HomeBanner::updateOrCreate(
        ['position'=>'promo_section','sort_order'=>2],
        [
            'is_active'=>1,
            'discount_percent'=>70,
            'title_en'=>'Exclusive Kids & Adults',
            'title_ar'=>'ملابس حصرية للأطفال والكبار',
            'subtitle_en'=>'Summer Outfits',
            'subtitle_ar'=>'أزياء صيفية',
           
            'link'=>'/shop',
            'image'=>'uploads/banners/promo-2.png',
            
        ]
    );
}

}
