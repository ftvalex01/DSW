<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\User;
use App\Models\Video;
use App\Models\Watch;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\WatchController
 */
final class WatchControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\WatchController::class,
            'store',
            \App\Http\Requests\Api\WatchStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_responds_with(): void
    {
        $user = User::factory()->create();
        $video = Video::factory()->create();

        $response = $this->post(route('watch.store'), [
            'user_id' => $user->id,
            'video_id' => $video->id,
        ]);

        $watches = Watch::query()
            ->where('user_id', $user->id)
            ->where('video_id', $video->id)
            ->get();
        $this->assertCount(1, $watches);
        $watch = $watches->first();

        $response->assertNoContent();
    }
}
