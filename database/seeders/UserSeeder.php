<?php
namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
 /**
 * Run the database seeds.
 */
 public function run(): void
 {
 User::updateOrCreate([
 'name' => 'Admin',
 'email' => 'admin1@gmail.com',
 'password' => Hash::make('12345678'),
 'role' => 'admin'
 ]);
User::updateOrCreate([
 'name' => 'Guru',
 'email' => 'guru1@gmail.com',
 'password' => Hash::make('12345678'),
 'role' => 'guru'
 ]);
User::updateOrCreate([
 'name' => 'Siswa',
 'email' => 'siswa1@gmail.com',
 'password' => Hash::make('12345678'),
 'role' => 'siswa'
 ]);
 }
}