<?php

namespace App\Models;

use App\Models\Scopes\UserLogged;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[ScopedBy(UserLogged::class)]
class Menu extends BaseModel
{
    protected $hidden = ['pivot'];
    
    public function products(): belongsToMany
    {
        return $this->belongsToMany(Product::class, 'menu_products', 'menu_id', 'product_id');
    }
}
