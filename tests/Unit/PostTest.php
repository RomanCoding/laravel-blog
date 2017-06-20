<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PostTest extends TestCase
{
    use DatabaseMigrations;

    protected $post;

    public function setUp()
    {
        parent::setUp();
        $this->post = factory('App\Post')->create();
        factory('App\Comment', 5)->create(['post_id' => $this->post->id]);
    }

    /** @test */
    public function a_post_is_written_by_a_user()
    {
        $this->assertInstanceOf('App\User', $this->post->user);
    }

    /** @test */
    public function a_post_has_comments()
    {
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->post->comments);
    }

    /** @test */
    public function a_comment_is_written_by_a_user()
    {
        $this->assertInstanceOf('App\User', $this->post->comments->first()->user);
    }
}