<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CustomerContact extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function setContactAttribute($value)
    {
        if(!Str::contains($value, '@')) {
            $this->attributes['contact'] = apenasNumeros($value);
        } else {
            $this->attributes['contact'] = $value;
        }
    }
}
