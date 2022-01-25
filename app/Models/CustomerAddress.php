<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerAddress extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function setCityAttribute($value)
    {
        $this->attributes['city'] = strtoupper($value);
    }

    public function setStateAttribute($value)
    {
        $this->attributes['state'] = strtoupper($value);
    }
}
