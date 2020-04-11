<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class AdministratorTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

    }
    
    /** @test */
    public function an_administrator_can_access_the_administration_section()
    {
         $this->signInAdmin()
            ->get(route('admin.dashboard.index'))
            ->assertStatus(Response::HTTP_OK);
    }

    /** @test */
    public function a_non_administrator_cannot_access_the_administration_section()
    {
        $regularUser = create('App\User');

        $this->actingAs($regularUser)
            ->get(route('admin.dashboard.index'))
             ->assertStatus(Response::HTTP_FORBIDDEN);
    }
}
