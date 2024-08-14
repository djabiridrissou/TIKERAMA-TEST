<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'surname',
        'enterprise',
        'email',
        'address',
    ];
}
