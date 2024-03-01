<?php

namespace App\Models;

use App\Models\Scopes\UserLogged;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[ScopedBy(UserLogged::class)]
class Product extends BaseModel
{
    protected $hidden = ['pivot'];

    public function menus(): BelongsToMany
    {
        return $this->belongsToMany(Menu::class, 'menu_products', 'product_id', 'menu_id');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'product_categories', 'product_id', 'category_id');
    }
}
