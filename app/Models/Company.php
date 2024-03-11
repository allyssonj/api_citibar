<?php

namespace App\Models;

use App\Models\Scopes\UserLogged;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;

#[ScopedBy(UserLogged::class)]
class Company extends BaseModel
{
    //
}
