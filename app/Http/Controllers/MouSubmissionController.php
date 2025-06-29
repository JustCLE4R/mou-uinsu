<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\MouSubmissions;
use App\Helpers\WhatsappGateway;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\MouSubmissionRequest;

class MouSubmissionController extends Controller
{
    public function create()
    {
        return view('mou-submission.create');
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

        $data['reference_number'] = self::generateReferenceNumber($data['institution_name']);

        MouSubmissions::create($data);

        // Notify the partner via WhatsApp
        $message = "╔═*.·:·.✧ *UINSU MEDAN* ✧.·:·.*═╗\n\n" . 
                        "MOU submission received\n\n" .
                        "Reference Number: *{$data['reference_number']}*\n\n" .
                        "Informasi Institusi:\n" .
                        "Nama: {$data['institution_name']}\n" .
                        "Jenis: {$data['institution_type']}\n" .
                        "Alamat: {$data['institution_address']}\n".
                        "Website: {$data['institution_website']}\n\n" .
                        "Cek status MOU di: " . url("/status?reference_number={$data['reference_number']}") . "\n\n" .
                        "╚═══*.·:·.✧ ✦ ✧ ✦ ✧.·:·.*═══╝\n";

        WhatsappGateway::send($data['pic_phone'], $message);

        // Notify admin via WhatsApp

        $settings = Cache::get('app_settings');
        $adminPhone = $settings->admin_phone ?? null;

        // cek pic_phone if start with 08 change it to 628
        if (Str::startsWith($data['pic_phone'], '08')) {
            $data['pic_phone'] = '62' . substr($data['pic_phone'], 1);
        }

        $adminMessage = "╔═*.·:·.✧ *UINSU MEDAN* ✧.·:·.*═╗\n\n" . 
                        "New MOU submission received\n\n" .
                        "Reference Number: *{$data['reference_number']}*\n\n" .
                        "Informasi Institusi:\n" .
                        "Nama: {$data['institution_name']}\n" .
                        "Jenis: {$data['institution_type']}\n" .
                        "Alamat: {$data['institution_address']}\n".
                        "Website: {$data['institution_website']}\n".
                        "Whatsapp: wa.me/{$data['pic_phone']}\n\n" .
                        "╚═══*.·:·.✧ ✦ ✧ ✦ ✧.·:·.*═══╝\n";

        WhatsappGateway::send($adminPhone, $adminMessage);
        

        return redirect(route('mou-submission.submitted'))->with('data', $data)->with('success', 'MOU submission created successfully.');

    }

    public function success()
    {
        if (!session()->has('data')) {
            return redirect(route('mou-submission'))->with('error', 'No submission data found.');
        }

        return view('mou-submission.success');
    }

    public function status()
    {
        $query = request('reference_number');
        
        $submission = null;
        if ($query) {
            $submission = MouSubmissions::where('reference_number', $query)->first();
            if (!$submission) {
                return redirect(route('mou-submission.status'))->with('error', 'Submission not found.');
            }
        }

        return view('mou-submission.status', ['submission' => $submission]);
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
