<?php

namespace App\Http\Controllers\superadmin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\MouSubmissions;
use App\Helpers\WhatsappGateway;
use App\Http\Controllers\Controller;
use App\Http\Requests\superadmin\MouSubmissionRequest;
use App\Http\Requests\superadmin\UpdateMouSubmissionRequest;
use App\Http\Requests\superadmin\UpdateStatusMouSubmissionRequest;

class MouController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = MouSubmissions::query();

        if ($request->filled('institution_type')) {
            $query->where('institution_type', $request->institution_type);
        }
        
        if ($request->filled('status')) {
            if ($request->status === 'postApproved') {
                $query->where('status', 'approved')
                    ->whereNull('final_agreement_file')
                    ->whereNull('final_mou_file');
            } else {
                $query->where('status', $request->status);
            }
        } else {
            $query->orderByRaw("CASE WHEN status = 'review' THEN 1 WHEN status = 'pending' THEN 2 ELSE 3 END")->orderBy('created_at', 'asc');
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
            $q->where('institution_name', 'like', "%{$search}%")
            ->orWhere('cooperation_title', 'like', "%{$search}%")
            ->orWhere('pic_name', 'like', "%{$search}%");
            });
        }

        $postApproved = MouSubmissions::where('status', 'approved')
            ->whereNull('final_agreement_file')
            ->whereNull('final_mou_file')
            ->get();

        return view('superadmin.mou.index', [
            'title' => 'MoU Submissions',
            'submissions' => $query->latest()->paginate(10)->appends(request()->query()),
            'postApproved' => $postApproved,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(MouSubmissions $mou)
    {
        if ($mou->status === 'pending') {
            $mou->update(['status' => 'review']);
            $mou->update(['status_updated_at' => now()]);
        }

        return view('superadmin.mou.show', [
            'title' => 'MoU Submission Details',
            'submission' => $mou,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MouSubmissions $mou)
    {
        return view('superadmin.mou.edit', [
            'title' => 'Edit MoU Submission',
            'submission' => $mou,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMouSubmissionRequest $request, MouSubmissions $mou)
    {
        $data = $request->validated();

        $fileFields = [
            'final_agreement_file',
            'final_mou_file',
            'letter_file',
            'proposal_file',
            'profile_file',
            'draft_mou_file',
            'legal_doc_akta',
            'legal_doc_nib',
            'legal_doc_operasional',
        ];

        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $date = now()->format('Ymd');
                $uuid = Str::uuid()->toString();
                $uuid16 = str_replace('-', '', $uuid);
                $uuid16 = substr($uuid16, 0, 16);
                $ext = $file->getClientOriginalExtension();
                $filename = "{$date}-{$uuid16}.{$ext}";
                $data[$field] = $file->storeAs("mou_submissions/{$field}", $filename, 'public');
            }
        }
        
        $mou->update($data);

        return redirect()->route('superadmin.mou.index')->with('success', "MoU {$mou->institution_name} berhasil diperbarui.");
    }
    

    public function create()
    {
        return view('superadmin.mou.create', [
            'title' => 'Tambah MoU Submission',
        ]);
    }

    public function store(MouSubmissionRequest $request)
    {
        $data = $request->validated();

        $fileFields = [
            'letter_file',
            'proposal_file',
            'profile_file',
            'draft_mou_file',
            'legal_doc_akta',
            'legal_doc_nib',
            'legal_doc_operasional',
        ];

        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $date = now()->format('Ymd');
                $uuid = Str::uuid()->toString();
                $uuid16 = str_replace('-', '', $uuid);
                $uuid16 = substr($uuid16, 0, 16);
                $ext = $file->getClientOriginalExtension();
                $filename = "{$date}-{$uuid16}.{$ext}";
                $data[$field] = $file->storeAs("mou_submissions/{$field}", $filename, 'public');
            }
        }

        $data['status'] = 'approved';

        $data['reference_number'] = self::generateReferenceNumber($data['institution_name']);


        MouSubmissions::create($data);

        return redirect()->route('superadmin.mou.index')->with('success', 'Pengajuan MoU berhasil dibuat.');
    }

    public function judge(UpdateStatusMouSubmissionRequest $request, MouSubmissions $mou)
    {
        $mou->status = $request->status;
        $mou->status_message = $request->status_message;
        $mou->status_updated_at = now();
        $mou->save();

        // If the status is approved or rejected send an whatsapp notification and the message is there any
        if (in_array($mou->status, ['approved', 'rejected'])) {
            $statusText = $mou->status === 'approved' ? 'disetujui' : 'ditolak';
            $message = "Pengajuan MoU dari {$mou->institution_name} telah *{$statusText}* oleh Universitas Islam Negeri Sumatera Utara.";
            if ($mou->status_message) {
                $message .= "\n\nCatatan:\n{$mou->status_message}";
            }

            WhatsappGateway::send($mou->pic_phone, $message);
        }

        return redirect()
            ->route('superadmin.mou.index', $mou->id)
            ->with('success', 'Status pengajuan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MouSubmissions $mou)
    {
        // Check if the submission exists
        if (!$mou) {
            return redirect()->route('superadmin.mou.index')->with('error', 'Pengajuan MoU tidak ditemukan.');
        }

        // Delete the submission
        $mou->delete();

        return redirect()->route('superadmin.mou.index')->with('success', 'Pengajuan MoU berhasil dihapus.');
    }

        public static function generateReferenceNumber($institutionName)
    {
        $year = now()->year;
        // $timestamp = now()->timestamp;
        $timestamp = (int)(microtime(true) * 1000);
        
        // Create a hash from institution name and timestamp
        $combined = $institutionName . $timestamp;
        $hash = hash('md5', $combined);
        
        // Take last 6 characters and convert to uppercase
        $randomPart = strtoupper(substr($hash, -6));

        return "MOU-UINSU-{$year}-{$randomPart}";
    }
}
