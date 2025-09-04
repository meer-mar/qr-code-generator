<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SMTPSetting;

class SMTPSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run() {
        SMTPSetting::create([
            'mail_sender_name' => 'WebSolutionUs',
            'mail_host' => 'smtp.mailtrap.io',
            'mail_username' => 'sonoftanveer@gmail.com',
            'mail_password' => '9a502d90071980',
            'mail_port' => '2525',
            'mail_encryption' => 'tls',
        ]);
    }
}
