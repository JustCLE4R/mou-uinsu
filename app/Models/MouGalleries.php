<?php

namespace App\Models;

use App\Models\MouSubmissions;
use Illuminate\Database\Eloquent\Model;

class MouGalleries extends Model
{
    protected $guarded = [
        'id',
    ];

    public function mouSubmission()
    {
        return $this->belongsTo(MouSubmissions::class, 'mou_submission_id');
    }
}
