<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Routing\Loader\ProtectedPhpFileLoader;

class MouSubmissions extends Model
{
    protected $fillable = [
        'institution_name',
        'institution_type',
        'institution_address',
        'institution_website',
        'pic_name',
        'pic_position',
        'pic_phone',
        'pic_email',
        'letter_file',
        'proposal_file',
        'profile_file',
        'draft_mou_file',
        'legal_doc_akta',
        'legal_doc_nib',
        'legal_doc_operasional',
        'cooperation_title',
        'cooperation_description',
        'cooperation_scope',
        'planned_activities',
        'target_unit',
        'start_date',
        'end_date',
        'signing_location',
        'special_request',
        'additional_notes',
        'status',
        'status_message',
        'status_updated_at',
        'reference_number',
    ];

    protected $casts = [
        'cooperation_scope' => 'array',
        'start_date' => 'date',
        'end_date' => 'date',
        'status_updated_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function galleries()
    {
        return $this->hasMany(MouGalleries::class);
    }
}
