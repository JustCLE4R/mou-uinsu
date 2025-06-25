<?php

namespace App\Http\Controllers;

use App\Models\MouSubmissions;
use Illuminate\Http\Request;

class LandingPublicController extends Controller
{
    public function index()
    {
        $submissions = MouSubmissions::select('institution_type', 'cooperation_title', 'end_date', 'start_date', 'institution_name', 'cooperation_description')
            ->where('status', 'approved')
            ->whereAfterToday('end_date')
            ->get();

        return view('index',[
            'submissions' => $submissions
        ]);
    }
}
