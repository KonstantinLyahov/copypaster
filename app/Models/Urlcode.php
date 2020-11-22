<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Urlcode extends Model
{
    public function copypasta()
    {
        return $this->belongsTo('App\Models\Copypasta');
    }
}
