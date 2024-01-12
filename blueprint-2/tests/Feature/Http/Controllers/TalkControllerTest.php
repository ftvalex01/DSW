<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Talk;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\TalkController
 */
final class TalkControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $talks = Talk::factory()->count(3)->create();

        $response = $this->get(route('talk.index'));

        $response->assertOk();
        $response->assertViewIs('talk.index');
        $response->assertViewHas('talks');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('talk.create'));

        $response->assertOk();
        $response->assertViewIs('talk.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\TalkController::class,
            'store',
            \App\Http\Requests\TalkStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $title = $this->faker->sentence(4);
        $description = $this->faker->text();

        $response = $this->post(route('talk.store'), [
            'title' => $title,
            'description' => $description,
        ]);

        $talks = Talk::query()
            ->where('title', $title)
            ->where('description', $description)
            ->get();
        $this->assertCount(1, $talks);
        $talk = $talks->first();

        $response->assertRedirect(route('talk.index'));
        $response->assertSessionHas('talk.id', $talk->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $talk = Talk::factory()->create();

        $response = $this->get(route('talk.show', $talk));

        $response->assertOk();
        $response->assertViewIs('talk.show');
        $response->assertViewHas('talk');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $talk = Talk::factory()->create();

        $response = $this->get(route('talk.edit', $talk));

        $response->assertOk();
        $response->assertViewIs('talk.edit');
        $response->assertViewHas('talk');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\TalkController::class,
            'update',
            \App\Http\Requests\TalkUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $talk = Talk::factory()->create();
        $title = $this->faker->sentence(4);
        $description = $this->faker->text();

        $response = $this->put(route('talk.update', $talk), [
            'title' => $title,
            'description' => $description,
        ]);

        $talk->refresh();

        $response->assertRedirect(route('talk.index'));
        $response->assertSessionHas('talk.id', $talk->id);

        $this->assertEquals($title, $talk->title);
        $this->assertEquals($description, $talk->description);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $talk = Talk::factory()->create();

        $response = $this->delete(route('talk.destroy', $talk));

        $response->assertRedirect(route('talk.index'));

        $this->assertModelMissing($talk);
    }
}
