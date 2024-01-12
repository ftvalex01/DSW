<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Speaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\SpeakerController
 */
final class SpeakerControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $speakers = Speaker::factory()->count(3)->create();

        $response = $this->get(route('speaker.index'));

        $response->assertOk();
        $response->assertViewIs('speaker.index');
        $response->assertViewHas('speakers');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('speaker.create'));

        $response->assertOk();
        $response->assertViewIs('speaker.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\SpeakerController::class,
            'store',
            \App\Http\Requests\SpeakerStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $name = $this->faker->name();
        $email = $this->faker->safeEmail();
        $biography = $this->faker->text();
        $twitter = $this->faker->word();

        $response = $this->post(route('speaker.store'), [
            'name' => $name,
            'email' => $email,
            'biography' => $biography,
            'twitter' => $twitter,
        ]);

        $speakers = Speaker::query()
            ->where('name', $name)
            ->where('email', $email)
            ->where('biography', $biography)
            ->where('twitter', $twitter)
            ->get();
        $this->assertCount(1, $speakers);
        $speaker = $speakers->first();

        $response->assertRedirect(route('speaker.index'));
        $response->assertSessionHas('speaker.id', $speaker->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $speaker = Speaker::factory()->create();

        $response = $this->get(route('speaker.show', $speaker));

        $response->assertOk();
        $response->assertViewIs('speaker.show');
        $response->assertViewHas('speaker');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $speaker = Speaker::factory()->create();

        $response = $this->get(route('speaker.edit', $speaker));

        $response->assertOk();
        $response->assertViewIs('speaker.edit');
        $response->assertViewHas('speaker');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\SpeakerController::class,
            'update',
            \App\Http\Requests\SpeakerUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $speaker = Speaker::factory()->create();
        $name = $this->faker->name();
        $email = $this->faker->safeEmail();
        $biography = $this->faker->text();
        $twitter = $this->faker->word();

        $response = $this->put(route('speaker.update', $speaker), [
            'name' => $name,
            'email' => $email,
            'biography' => $biography,
            'twitter' => $twitter,
        ]);

        $speaker->refresh();

        $response->assertRedirect(route('speaker.index'));
        $response->assertSessionHas('speaker.id', $speaker->id);

        $this->assertEquals($name, $speaker->name);
        $this->assertEquals($email, $speaker->email);
        $this->assertEquals($biography, $speaker->biography);
        $this->assertEquals($twitter, $speaker->twitter);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $speaker = Speaker::factory()->create();

        $response = $this->delete(route('speaker.destroy', $speaker));

        $response->assertRedirect(route('speaker.index'));

        $this->assertModelMissing($speaker);
    }
}
