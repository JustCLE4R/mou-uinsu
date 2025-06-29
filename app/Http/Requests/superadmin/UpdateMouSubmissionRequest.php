<?php

namespace App\Http\Requests\superadmin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMouSubmissionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // Final Documents (new fields for update)
            'final_agreement_file'  => 'nullable|file|mimes:pdf,doc,docx|max:20480',
            'final_mou_file'        => 'nullable|file|mimes:pdf,doc,docx|max:20480',

            // Informasi Mitra
            'institution_name'      => 'required|string|max:255',
            'institution_type'      => 'required|in:SMK,SMA,Perguruan Tinggi,Vendor,Brand,Pemerintah,Lainnya',
            'institution_address'   => 'required|string',
            'institution_website'   => 'nullable|url|max:255',

            // Kontak Penanggung Jawab
            'pic_name'              => 'required|string|max:255',
            'pic_position'          => 'required|string|max:255',
            'pic_phone'             => 'required|string|max:30',
            'pic_email'             => 'required|email|max:255',

            // Dokumen Upload (optional on update)
            'letter_file'           => 'nullable|file|mimes:pdf,doc,docx|max:20480',
            'proposal_file'         => 'nullable|file|mimes:pdf,doc,docx|max:20480',
            'profile_file'          => 'nullable|file|mimes:pdf,doc,docx|max:20480',
            'draft_mou_file'        => 'nullable|file|mimes:pdf,doc,docx|max:20480',
            'legal_doc_akta'        => 'nullable|file|mimes:pdf,doc,docx|max:20480',
            'legal_doc_nib'         => 'nullable|file|mimes:pdf,doc,docx|max:20480',
            'legal_doc_operasional' => 'nullable|file|mimes:pdf,doc,docx|max:20480',

            // Informasi Kerja Sama
            'cooperation_title'     => 'required|string|max:255',
            'cooperation_description' => 'required|string',
            'cooperation_scope'     => 'nullable|array',
            'cooperation_scope.*'   => 'string|max:100',
            'planned_activities'    => 'required|string',
            'target_unit'           => 'required|string|max:255',
            'start_date'            => 'nullable|date',
            'end_date'              => 'nullable|date|after_or_equal:start_date',

            // Metadata
            'signing_location'      => 'nullable|string|max:255',
            'special_request'       => 'nullable|string',
            'additional_notes'      => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            // Final Documents
            'final_agreement_file.file'    => 'Final agreement harus berupa file.',
            'final_agreement_file.mimes'   => 'Final agreement harus berformat PDF/DOC/DOCX.',
            'final_agreement_file.max'     => 'Final agreement maksimal 20MB.',
            'final_mou_file.file'          => 'Final MOU harus berupa file.',
            'final_mou_file.mimes'         => 'Final MOU harus berformat PDF/DOC/DOCX.',
            'final_mou_file.max'           => 'Final MOU maksimal 20MB.',

            // Informasi Mitra
            'institution_name.required'    => 'Nama institusi wajib diisi.',
            'institution_type.required'    => 'Jenis institusi wajib dipilih.',
            'institution_type.in'          => 'Jenis institusi tidak valid.',
            'institution_address.required' => 'Alamat institusi wajib diisi.',
            'institution_website.url'      => 'Format website institusi tidak valid.',

            // Kontak Penanggung Jawab
            'pic_name.required'            => 'Nama PIC wajib diisi.',
            'pic_position.required'        => 'Jabatan PIC wajib diisi.',
            'pic_phone.required'           => 'Nomor telepon PIC wajib diisi.',
            'pic_email.required'           => 'Email PIC wajib diisi.',
            'pic_email.email'              => 'Format email PIC tidak valid.',

            // Dokumen Upload
            'letter_file.file'             => 'Surat permohonan harus berupa file.',
            'letter_file.mimes'            => 'Surat permohonan harus berformat PDF/DOC/DOCX.',
            'letter_file.max'              => 'Surat permohonan maksimal 20MB.',
            'proposal_file.file'           => 'Proposal harus berupa file.',
            'proposal_file.mimes'          => 'Proposal harus berformat PDF/DOC/DOCX.',
            'proposal_file.max'            => 'Proposal maksimal 20MB.',
            'profile_file.file'            => 'Profil lembaga harus berupa file.',
            'profile_file.mimes'           => 'Profil lembaga harus berformat PDF/DOC/DOCX.',
            'profile_file.max'             => 'Profil lembaga maksimal 20MB.',
            'draft_mou_file.file'          => 'Draft MoU harus berupa file.',
            'draft_mou_file.mimes'         => 'Draft MoU harus berformat PDF/DOC/DOCX.',
            'draft_mou_file.max'           => 'Draft MoU maksimal 20MB.',
            'legal_doc_akta.file'          => 'Akta harus berupa file.',
            'legal_doc_akta.mimes'         => 'Akta harus berformat PDF/DOC/DOCX.',
            'legal_doc_akta.max'           => 'Akta maksimal 20MB.',
            'legal_doc_nib.file'           => 'NIB harus berupa file.',
            'legal_doc_nib.mimes'          => 'NIB harus berformat PDF/DOC/DOCX.',
            'legal_doc_nib.max'            => 'NIB maksimal 20MB.',
            'legal_doc_operasional.file'   => 'Dokumen operasional harus berupa file.',
            'legal_doc_operasional.mimes'  => 'Dokumen operasional harus berformat PDF/DOC/DOCX.',
            'legal_doc_operasional.max'    => 'Dokumen operasional maksimal 20MB.',

            // Informasi Kerja Sama
            'cooperation_title.required'   => 'Judul kerja sama wajib diisi.',
            'cooperation_description.required' => 'Deskripsi kerja sama wajib diisi.',
            'cooperation_scope.array'      => 'Ruang lingkup kerja sama harus berupa array.',
            'planned_activities.required'  => 'Rencana kegiatan wajib diisi.',
            'target_unit.required'         => 'Unit sasaran wajib diisi.',
            'start_date.date'              => 'Tanggal mulai tidak valid.',
            'end_date.date'                => 'Tanggal selesai tidak valid.',
            'end_date.after_or_equal'      => 'Tanggal selesai harus setelah atau sama dengan tanggal mulai.',

            // Metadata
            'signing_location.string'      => 'Lokasi penandatanganan tidak valid.',
            'special_request.string'       => 'Permintaan khusus tidak valid.',
            'additional_notes.string'      => 'Catatan tambahan tidak valid.',
        ];
    }
}
