<?php

namespace Tests\Feature;

use App\Activity;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateThreadsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_may_not_create_threads()
    {

        $this->get('/threads/create')
            ->assertRedirect('/login');

        $this->post(route('threads'), [])
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function new_users_must_first_confirm_their_email_address_before_creating_threads()
    {

        $user = factory('App\User')->states('unconfirmed')->create();
        
        $this->signIn($user);

        $thread = make('App\Thread');

        $this->post(route('threads'), $thread->toArray())
            ->assertRedirect(route('threads'))
            ->assertSessionHas('flash', 'You must first confirm your email address.');
    }

    /** @test */
    public function a_user_can_create_new_forum_threads()
    {
        $this->signIn();

        $thread = make('App\Thread');

        $response = $this->post(route('threads'), $thread->toArray());

        $this->get($response->headers->get('Location'))
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }

    /** @test */
    public function a_thread_requires_a_title()
    {
        $this->publishThread(['title' => null])
            ->assertSessionHasErrors('title');
    }

    /** @test */
    public function a_thread_requires_a_body()
    {
        $this->publishThread(['body' => null])
            ->assertSessionHasErrors('body');
    }

    /** @test */
    public function a_thread_requires_a_valid_channel()
    {
        factory('App\Channel', 2)->create();

        $this->publishThread(['channel_id' => 999])
            ->assertSessionHasErrors('channel_id');
    }

    /** @test */
    public function unathorized_users_may_not_delete_threads()
    {
        $thread = create('App\Thread');

        $this->delete($thread->path())->assertStatus(403);

        $this->signIn();

        $this->delete($thread->path())->assertStatus(403);
    }

    /** @test */
    public function authorized_users_can_delete_threads()
    {
        $this->withoutExceptionHandling();

        $this->signIn();

        $thread = create('App\Thread', ['user_id' => auth()->id()]);
        $reply = create('App\Reply', ['thread_id' => $thread->id]);

        $response = $this->json('DELETE', $thread->path());

        $response->assertStatus(204);
        
        $this->assertDatabaseMissing('threads', ['id' => $thread->id]);
        
        $this->assertDatabaseMissing('replies', ['id' => $reply->id]);

        $this->assertEquals(0, Activity::count());
    }

    protected function publishThread($overrides = [])
    {
        $this->signIn();

        $thread = make('App\Thread', $overrides);

        return $this->post(route('threads'), $thread->toArray());
    }

}
