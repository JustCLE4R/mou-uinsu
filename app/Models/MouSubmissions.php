<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Routing\Loader\ProtectedPhpFileLoader;

class MouSubmissions extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'cooperation_scope' => 'array',
        'start_date' => 'date',
        'end_date' => 'date',
        'status_updated_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function mouGalleries()
    {
        return $this->hasMany(MouGalleries::class, 'mou_submission_id');
    }
}
