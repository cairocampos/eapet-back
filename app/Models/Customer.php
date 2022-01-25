<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function addresses()
    {
        return $this->hasMany(CustomerAddress::class);
    }

    public function contacts()
    {
        return $this->hasMany(CustomerContact::class);
    }

    public function setCpfAttribute($value)
    {
        $this->attributes['cpf'] = apenasNumeros($value);
    }

    public function getCpfAttribute()
    {
        return formataCpf($this->attributes['cpf']);
    }
}
