<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use App\Models\MouGalleries;
use App\Models\MouSubmissions;
use Illuminate\Http\Request;

class MouGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($mouSubmissionId)
    {
        $mouSubmission = MouSubmissions::findOrFail($mouSubmissionId);
        if ($mouSubmission->status !== 'approved') {
            abort(404, 'Submission not found or not approved.');
        }

        return view('superadmin.mou-galleries.create', [
            'title' => 'Create Mou Gallery',
            'submission' => $mouSubmission,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $mouSubmissionId)
    {
        // Validate the request
        $request->validate([
            'image_path.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'image_path.*.required' => 'Each image is required.',
            'image_path.*.image' => 'Each file must be an image.',
            'image_path.*.mimes' => 'Each image must be a file of type: jpeg, png, jpg, gif.',
            'image_path.*.max' => 'Each image may not be greater than 2MB.',
        ]);

        // Check if the submission exists and status is 'approved'
        $mouSubmission = MouSubmissions::findOrFail($mouSubmissionId);
        if ($mouSubmission->status !== 'approved') {
            abort(404, 'Submission not found or not approved.');
        }

        // Store each image
        foreach ($request->file('image_path') as $image) {
            $path = $image->store('mou-galleries', 'public');

            MouGalleries::create([
                'mou_submission_id' => $mouSubmissionId,
                'image_path' => $path,
            ]);
        }

        return redirect()->route('superadmin.mou.gallery.show', $mouSubmissionId)
                         ->with('success', 'Gallery images uploaded successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($mouSubmissionId)
    {
        // Check if the submission exists and status is 'approved'
        $mouSubmission = MouSubmissions::findOrFail($mouSubmissionId);
        if ($mouSubmission->status !== 'approved') {
            abort(404, 'Submission not found or not approved.');
        }

        $mouGalleries = MouGalleries::where('mou_submission_id', $mouSubmissionId)->get();

        return view('superadmin.mou-galleries.show', [
            'title' => 'Mou Gallery',
            'submission' => $mouSubmission,
            'mouGalleries' => $mouGalleries,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MouGalleries $mouGalleries)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MouGalleries $mouGalleries)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MouGalleries $mouGalleries)
    {
        $mouGalleries->delete();

        // Delete the image file from storage
        if (file_exists(public_path('storage/' . $mouGalleries->image_path))) {
            unlink(public_path('storage/' . $mouGalleries->image_path));
        }

        return redirect()->back()->with('success', 'Gallery image deleted successfully.');
    }
}
