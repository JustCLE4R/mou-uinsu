<?php

namespace App\Http\Controllers;

use App\Models\MouSubmissions;
use Illuminate\Http\Request;

class LandingPublicController extends Controller
{
    public function index()
    {
        $submissions = MouSubmissions::select('id', 'institution_type', 'cooperation_title', 'end_date', 'start_date', 'institution_name', 'cooperation_description', 'final_agreement_file', 'final_mou_file')
            ->selectRaw('(CASE WHEN EXISTS(SELECT 1 FROM mou_galleries WHERE mou_galleries.mou_submission_id = mou_submissions.id) THEN 1 ELSE 0 END) as gallery_available')
            ->where('status', 'approved')
            ->whereAfterToday('end_date')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('index',[
            'submissions' => $submissions
        ]);
    }
}
