<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    protected $table='students';
    protected $guarded = [];

public function country()
{
    return $this->belongsTo(Countries::class, 'country_id');
}
}