<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_check_if_user_is_admin()
    {
        $user = User::factory()->create(
            [
                'name' => 'Kings',
                'email' => 'milimokings@gmail.com'
            ]
        );

        $userB = User::factory()->create([
            'name' => 'John',
            'email' => 'johndoe@gmail.com'
        ]);

        $this->assertTrue($user->isAdmin());
        $this->assertFalse($userB->isAdmin());
    }
}
