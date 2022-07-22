<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','slot_no','price','image'
    ];

    /**
     * Belongs to Slot
     */
    public function slot(Type $var = null)
    {
        $this->belongsTo(Slot::class);
    }
    
}
