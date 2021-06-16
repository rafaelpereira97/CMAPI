<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    public function entity(){
        return $this->belongsTo(Entity::class);
    }

    public function subcategory(){
        return $this->belongsTo(Subcategory::class);
    }
}
