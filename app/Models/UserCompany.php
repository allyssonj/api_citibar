<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserCompany extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function user(): belongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function company(): belongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
