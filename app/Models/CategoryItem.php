<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\MasterItem;

class CategoryItem extends Model
{
    use HasFactory;
    use SoftDeletes;

    // relasi many-many ke MasterItem
    public function masterItem() {
        return $this->belongsToMany(MasterItem::class, 'category_item_master_item', 'category_item_id', 'master_item_id');
    }
}
