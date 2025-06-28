<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mou_submissions', function (Blueprint $table) {
            $table->id();
            
            // Informasi Mitra
            $table->string('institution_name');
            $table->enum('institution_type', ['SMK', 'SMA', 'Perguruan Tinggi', 'Vendor', 'Brand', 'Pemerintah', 'Lainnya']);
            $table->text('institution_address');
            $table->string('institution_website')->nullable();

            // Kontak Penanggung Jawab
            $table->string('pic_name');
            $table->string('pic_position');
            $table->string('pic_phone');
            $table->string('pic_email');

            // Dokumen Upload (disimpan path-nya)
            $table->string('letter_file')->nullable();         // Surat Permohonan
            $table->string('proposal_file')->nullable();
            $table->string('profile_file')->nullable();         // Profil Lembaga
            $table->string('draft_mou_file')->nullable();
            $table->string('legal_doc_akta')->nullable();
            $table->string('legal_doc_nib')->nullable();
            $table->string('legal_doc_operasional')->nullable();

            // Informasi Kerja Sama
            $table->string('cooperation_title');
            $table->text('cooperation_description');
            $table->json('cooperation_scope'); // multiple: pendidikan, magang, dll
            $table->text('planned_activities');
            $table->string('target_unit');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();

            // Metadata
            $table->string('signing_location')->nullable();
            $table->text('special_request')->nullable();
            $table->text('additional_notes')->nullable();

            // Status Tracking
            $table->enum('status', ['pending', 'review', 'approved', 'rejected'])->default('pending');
            $table->string('status_message')->nullable();
            $table->timestamp('status_updated_at')->nullable();
            $table->string('reference_number')->nullable();

            $table->string('final_agreement_file')->nullable(); // misal: scan/foto dokumen MOU resmi
            $table->string('final_mou_file')->nullable();        // PDF versi final (jika ada)

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mou_submissions');
    }
};
