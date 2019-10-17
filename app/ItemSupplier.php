<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ItemSupplier extends Model

{    
    use Notifiable;
    
    protected $guarded = [];
    protected $table = 'item_suppliers';
    
    public function items()
    {
        return $this->belongsTo('App\Item');
    }
}
