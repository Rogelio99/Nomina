<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $table = 'employee';
    protected $fillable = [
        'code', 'name', 'emai', 'paternal_surname', 'maternal_surname', 'status', 'is_active'
    ];

    public function type_of_contract()
    {
        return $this->hasOne('App\Models\type_of_contract', 'id', 'type_of_contract_id');
    }
}
