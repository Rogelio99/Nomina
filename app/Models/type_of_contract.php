<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class type_of_contract extends Model
{
    use HasFactory;

    protected $table = 'type_of_contract';
    protected $fillable = [
        'name', 'description'
    ];
}
