<?php

namespace Tests\Feature;

use App\Models\Authorization;
use App\Models\Registration;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationAuthorizationTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_relationships_work(): void
    {
        $user = User::factory()->create();

        $registration = Registration::factory()->for($user)->create();
        $auth1 = Authorization::factory()->for($user)->create();
        $auth2 = Authorization::factory()->for($user)->create();

        $this->assertTrue($registration->user->is($user));
        $this->assertCount(2, $user->authorizations);
        $this->assertTrue($user->registration->is($registration));

        $this->assertEquals($user->id, $auth1->user_id);
        $this->assertEquals($user->id, $auth2->user_id);
    }
}
