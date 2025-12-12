<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Rolleri oluştur
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $editorRole = Role::firstOrCreate(['name' => 'editor']);
        $authorRole = Role::firstOrCreate(['name' => 'author']);

        // Admin kullanıcı oluştur
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => bcrypt('password'),
            ]
        );
        $admin->assignRole($adminRole);

        // Editor kullanıcı oluştur
        $editor = User::firstOrCreate(
            ['email' => 'editor@example.com'],
            [
                'name' => 'Editor',
                'password' => bcrypt('password'),
            ]
        );
        $editor->assignRole($editorRole);

        // Author kullanıcı oluştur
        $author = User::firstOrCreate(
            ['email' => 'author@example.com'],
            [
                'name' => 'Author',
                'password' => bcrypt('password'),
            ]
        );
        $author->assignRole($authorRole);
    }
}
