<?php

namespace App\Models;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [
        'id',
    ];

    protected $casts = [
        'created_at' => 'datetime:d/m/Y',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', Status::ATIVO);
    }
}
