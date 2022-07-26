<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Slot extends Model
{
    use AsSource,HasFactory;

    /**
     * Has many items
     */
    public function item()
    {
        return $this->hasOne(Item::class);
    }
    
}
