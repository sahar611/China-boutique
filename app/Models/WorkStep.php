<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkStep extends Model
{
  protected $fillable = [
    'step_no','title_en','title_ar','desc_en','desc_ar',
    'icon_type','icon_class','icon_image',
    'sort_order','is_active'
  ];
}
