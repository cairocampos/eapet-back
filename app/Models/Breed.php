<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Breed extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['name_search'] = strtoupper(tirarAcentos($value));
    }
}
