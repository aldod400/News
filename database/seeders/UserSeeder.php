<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // إنشاء المستخدم الإداري
        $admin = User::create([
            'name' => 'المدير العام',
            'email' => 'admin@news.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        // إنشاء محرر الأخبار
        $editor = User::create([
            'name' => 'محرر الأخبار',
            'email' => 'editor@news.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        // إنشاء كاتب
        $writer = User::create([
            'name' => 'كاتب الأخبار',
            'email' => 'writer@news.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        // إنشاء مستخدم عادي
        $user = User::create([
            'name' => 'مستخدم عادي',
            'email' => 'user@news.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        // تعيين الأدوار إذا كانت موجودة
        if (Role::where('name', 'admin')->exists()) {
            $admin->assignRole('admin');
        }

        if (Role::where('name', 'editor')->exists()) {
            $editor->assignRole('editor');
        }

        if (Role::where('name', 'writer')->exists()) {
            $writer->assignRole('writer');
        }

        if (Role::where('name', 'user')->exists()) {
            $user->assignRole('user');
        }
    }
}
