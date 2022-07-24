<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Screen\AsSource;

class Item extends Model
{
    use AsSource,Attachable,HasFactory;

    protected $fillable = [
        'name','slot_no','price','image'
    ];

    /**
     * Belongs to Slot
     */
    public function slot(Type $var = null)
    {
        return $this->belongsTo(Slot::class);
    }
    
}
