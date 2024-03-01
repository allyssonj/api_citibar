<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MenuProduct extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function menu(): belongsTo
    {
        return $this->belongsTo(Menu::class);
    }

    public function product(): belongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
