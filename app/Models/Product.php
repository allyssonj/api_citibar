<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends BaseModel
{
    public function categories(): HasMany
    {
        return $this->hasMany(ProductCategory::class);
    }
}
