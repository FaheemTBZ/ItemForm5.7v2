<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $guarded = [];
    
    public function itemSuppliers()
    {
        return $this->hasMany('App\ItemSupplier');
    }
    
}
