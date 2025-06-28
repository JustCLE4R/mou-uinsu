<?php

namespace App\Models;

use App\Models\MouSubmissions;
use Illuminate\Database\Eloquent\Model;

class MouGalleries extends Model
{
    protected $guarded = [
        'id',
    ];

    public function mou()
    {
        return $this->belongsTo(MouSubmissions::class);
    }
}
