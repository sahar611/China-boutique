<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeBanner extends Model
{
    protected $fillable = [
        'position','sort_order','is_active',
        'discount_percent',
        'title_en','title_ar','subtitle_en','subtitle_ar',
       'link',
        'image'
    ];

    public function getTitleAttribute(){
        return app()->getLocale()=='ar' ? $this->title_ar : $this->title_en;
    }
    public function getSubtitleAttribute(){
        return app()->getLocale()=='ar' ? $this->subtitle_ar : $this->subtitle_en;
    }
    public function getButtonTextAttribute(){
        return app()->getLocale()=='ar' ? $this->button_text_ar : $this->button_text_en;
    }
}
