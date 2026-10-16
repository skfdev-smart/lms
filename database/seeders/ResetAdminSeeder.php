<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ResetAdminSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::where('email', 'admin@spindo.com')->first();
        
        if (!$user) {
            $user = new User();
            $user->email = 'admin@spindo.com';
            $user->name = 'Admin';
        }

        $user->password = Hash::make('password');
        $user->email_verified_at = now();
        $user->save();
        
        $this->command->info('Admin password reset to: password');
    }
}
