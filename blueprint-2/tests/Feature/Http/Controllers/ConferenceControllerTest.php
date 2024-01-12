<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Conference;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ConferenceController
 */
final class ConferenceControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $conferences = Conference::factory()->count(3)->create();

        $response = $this->get(route('conference.index'));

        $response->assertOk();
        $response->assertViewIs('conference.index');
        $response->assertViewHas('conferences');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('conference.create'));

        $response->assertOk();
        $response->assertViewIs('conference.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ConferenceController::class,
            'store',
            \App\Http\Requests\ConferenceStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $name = $this->faker->name();
        $city = $this->faker->city();
        $country = $this->faker->country();
        $postal_code = $this->faker->postcode();

        $response = $this->post(route('conference.store'), [
            'name' => $name,
            'city' => $city,
            'country' => $country,
            'postal_code' => $postal_code,
        ]);

        $conferences = Conference::query()
            ->where('name', $name)
            ->where('city', $city)
            ->where('country', $country)
            ->where('postal_code', $postal_code)
            ->get();
        $this->assertCount(1, $conferences);
        $conference = $conferences->first();

        $response->assertRedirect(route('conference.index'));
        $response->assertSessionHas('conference.id', $conference->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $conference = Conference::factory()->create();

        $response = $this->get(route('conference.show', $conference));

        $response->assertOk();
        $response->assertViewIs('conference.show');
        $response->assertViewHas('conference');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $conference = Conference::factory()->create();

        $response = $this->get(route('conference.edit', $conference));

        $response->assertOk();
        $response->assertViewIs('conference.edit');
        $response->assertViewHas('conference');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ConferenceController::class,
            'update',
            \App\Http\Requests\ConferenceUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $conference = Conference::factory()->create();
        $name = $this->faker->name();
        $city = $this->faker->city();
        $country = $this->faker->country();
        $postal_code = $this->faker->postcode();

        $response = $this->put(route('conference.update', $conference), [
            'name' => $name,
            'city' => $city,
            'country' => $country,
            'postal_code' => $postal_code,
        ]);

        $conference->refresh();

        $response->assertRedirect(route('conference.index'));
        $response->assertSessionHas('conference.id', $conference->id);

        $this->assertEquals($name, $conference->name);
        $this->assertEquals($city, $conference->city);
        $this->assertEquals($country, $conference->country);
        $this->assertEquals($postal_code, $conference->postal_code);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $conference = Conference::factory()->create();

        $response = $this->delete(route('conference.destroy', $conference));

        $response->assertRedirect(route('conference.index'));

        $this->assertModelMissing($conference);
    }
}
