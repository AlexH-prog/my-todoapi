<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         $shiftFactory = 2;
         $shiftSequence = 12;
         $shiftTestUser = $shiftFactory * $shiftSequence;

        $user = User::factory($shiftFactory)
            ->has(
                Task::factory()
                    ->count($shiftSequence)
                    ->sequence(['parent_id' => 0],
                       fn (Sequence $sequence) => ['parent_id' => ($sequence->index)],
                       fn (Sequence $sequence) => ['parent_id' => ($sequence->index)],
                       fn (Sequence $sequence) => ['parent_id' => (($sequence->index)-1)],
                       fn (Sequence $sequence) => ['parent_id' => (($sequence->index)-1)],
                       fn (Sequence $sequence) => ['parent_id' => (($sequence->index)-1)],
                       ['parent_id' => 0],
                       fn (Sequence $sequence) => ['parent_id' => ($sequence->index)],
                       fn (Sequence $sequence) => ['parent_id' => (($sequence->index)-1)],
                       fn (Sequence $sequence) => ['parent_id' => ($sequence->index)],
                       fn (Sequence $sequence) => ['parent_id' => (($sequence->index)-2)],
                       fn (Sequence $sequence) => ['parent_id' => (($sequence->index)-1)]
                   )
            )
            ->create();

         \App\Models\User::factory()->has(
             Task::factory()
                 ->count($shiftSequence)
                 ->sequence(['parent_id' => 0],
                     fn (Sequence $sequence) => ['parent_id' => ($sequence->index)+$shiftTestUser],
                     fn (Sequence $sequence) => ['parent_id' => ($sequence->index)+$shiftTestUser],
                     fn (Sequence $sequence) => ['parent_id' => (($sequence->index)+$shiftTestUser-1)],
                     fn (Sequence $sequence) => ['parent_id' => (($sequence->index)+$shiftTestUser-1)],
                     fn (Sequence $sequence) => ['parent_id' => (($sequence->index)+$shiftTestUser-1)],
                     ['parent_id' => 0],
                     fn (Sequence $sequence) => ['parent_id' => ($sequence->index)+$shiftTestUser],
                     fn (Sequence $sequence) => ['parent_id' => (($sequence->index)+$shiftTestUser-1)],
                     fn (Sequence $sequence) => ['parent_id' => ($sequence->index)+$shiftTestUser],
                     fn (Sequence $sequence) => ['parent_id' => (($sequence->index)+$shiftTestUser-2)],
                     fn (Sequence $sequence) => ['parent_id' => (($sequence->index)+$shiftTestUser-1)]
                 )
         )
             ->create([
             'name' => 'Test User',
             'email' => 'test@example.com',
             'password' => '1234567'
                 ]);
    }
}
