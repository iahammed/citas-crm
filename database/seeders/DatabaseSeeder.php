<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Agent;
use App\Models\Course;
use App\Models\Account;
use App\Models\Contact;
use App\Models\Student; 
use App\Models\Organization;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $account = Account::create(['name' => 'Citas College']);

        User::factory()->create([
            'account_id' => $account->id,
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'johndoe@example.com',
            'password' => 'secret',
            'owner' => true,
        ]);

        $users = User::factory(5)->create(['account_id' => $account->id]);

        $organizations = Organization::factory(10)
            ->create(['account_id' => $account->id]);

        // Student::factory(300)
        //     ->create(['account_id' => $account->id, 'user_id' => $users->random()->id]);

        Contact::factory(10)
            ->create(['account_id' => $account->id])
            ->each(function ($contact) use ($organizations) {
                $contact->update(['organization_id' => $organizations->random()->id]);
            });
        Agent::factory(10)
            ->create(['account_id' => $account->id])
            ->each(function ($agent) use ($organizations) {
                $agent->update(['organization_id' => $organizations->random()->id]);
            });

        Course::factory(5)
            ->create(['account_id' => $account->id, 'user_id' => $users->random()->id]);
    }
}
