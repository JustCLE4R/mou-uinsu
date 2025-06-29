<?php

namespace App\Http\Controllers;

use App\Models\MouGalleries;
use Illuminate\Http\Request;
use App\Models\MouSubmissions;

class MouGalleriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $galleries = MouGalleries::with('mouSubmission')->paginate(20);

        return view('mou-galleries.index', [
            'title' => 'MOU Galleries',
            'galleries' => $galleries,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(MouSubmissions $MouSubmission)
    {
        $MouSubmission->load('mouGalleries');
        
        return view('mou-galleries.show', [
            'title' => 'MOU Gallery',
            'submission' => $MouSubmission,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MouGalleries $MouGalleries)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MouGalleries $MouGalleries)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MouGalleries $MouGalleries)
    {
        //
    }
}
