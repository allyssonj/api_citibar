<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

class Menu extends BaseModel
{
    public function products(): HasMany
    {
        return $this->hasMany(MenuProduct::class);
    }
}
