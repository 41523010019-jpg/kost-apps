<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Booking;
use App\Models\User;
use App\Models\Room;
use Carbon\Carbon;

class BookingSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first() ?? User::factory()->create([
            'name' => 'Test User',
            'email' => 'user@test.com',
            'password' => bcrypt('password'),
        ]);

        $room = Room::first() ?? Room::create([
            'name' => 'Kamar Contoh',
            'price' => 750000,
            'description' => 'Kamar testing seeder'
        ]);

        Booking::create([
            'user_id' => $user->id,
            'room_id' => $room->id,
            'start_date' => Carbon::now(),
            'next_billing_date' => Carbon::now()->addMonth(),
            'status' => 'active',
        ]);
    }
}
