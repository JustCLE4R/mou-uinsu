<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            ['key' => 'app_name', 'value' => 'My Application'],
            ['key' => 'app_alias', 'value' => 'MyApp'],
            ['key' => 'admin_phone', 'value' => '6281234567890'],
            ['key' => 'app_description', 'value' => 'Platform Terpusat untuk Pengelolaan dan Akses Dokumen Akademik Universitas Islam Negeri Sumatera Utara.'],
            ['key' => 'color_primary', 'value' => '#198754'],
            ['key' => 'color_secondary', 'value' => '#0d6efd'],
            ['key' => 'color_tertiary', 'value' => '#adb5bd'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(['key' => $setting['key']], ['value' => $setting['value']]);
        }
    }
}
