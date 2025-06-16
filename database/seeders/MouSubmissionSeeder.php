<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MouSubmissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = ['pending', 'review', 'approved', 'rejected'];
        $institutionTypes = ['SMK', 'SMA', 'Perguruan Tinggi', 'Vendor', 'Brand', 'Pemerintah', 'Lainnya'];
        $cooperationScopes = [
            ['pendidikan', 'magang'],
            ['penelitian', 'pengabdian'],
            ['pengembangan produk'],
            ['pelatihan', 'sertifikasi'],
        ];

        $data = [];
        for ($i = 0; $i < 16; $i++) {
            $status = $statuses[intval($i / 4)];
            $data[] = [
                'institution_name' => fake()->company(),
                'institution_type' => $institutionTypes[$i % count($institutionTypes)],
                'institution_address' => fake()->address(),
                'institution_website' => fake()->url(),
                'pic_name' => fake()->name(),
                'pic_position' => fake()->jobTitle(),
                'pic_phone' => fake()->phoneNumber(),
                'pic_email' => fake()->email(),
                'letter_file' => 'uploads/letters/letter' . ($i + 1) . '.pdf',
                'proposal_file' => 'uploads/proposals/proposal' . ($i + 1) . '.pdf',
                'profile_file' => 'uploads/profiles/profile' . ($i + 1) . '.pdf',
                'draft_mou_file' => 'uploads/drafts/draft' . ($i + 1) . '.pdf',
                'legal_doc_akta' => 'uploads/legal/akta' . ($i + 1) . '.pdf',
                'legal_doc_nib' => 'uploads/legal/nib' . ($i + 1) . '.pdf',
                'legal_doc_operasional' => 'uploads/legal/operasional' . ($i + 1) . '.pdf',
                'cooperation_title' => fake()->sentence(3),
                'cooperation_description' => fake()->paragraph(),
                'cooperation_scope' => json_encode($cooperationScopes[$i % count($cooperationScopes)]),
                'planned_activities' => fake()->paragraph(),
                'target_unit' => 'Unit ' . chr(65 + ($i % 4)),
                'start_date' => fake()->dateTimeBetween('now', '+30 days')->format('Y-m-d'),
                'end_date' => fake()->dateTimeBetween('+31 days', '+365 days')->format('Y-m-d'),
                'signing_location' => fake()->city(),
                'special_request' => fake()->sentence(),
                'additional_notes' => fake()->text(),
                'status' => $status,
                'status_message' => $status === 'approved' ? 'Disetujui' : ($status === 'rejected' ? 'Ditolak' : null),
                'status_updated_at' => now(),
                'reference_number' => 'REF-' . strtoupper(Str::random(8)),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('mou_submissions')->insert($data);
    }
}
