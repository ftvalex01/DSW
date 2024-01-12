<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Conference;
use App\Models\Venue;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\VenueController
 */
final class VenueControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $venues = Venue::factory()->count(3)->create();

        $response = $this->get(route('venue.index'));

        $response->assertOk();
        $response->assertViewIs('venue.index');
        $response->assertViewHas('venues');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('venue.create'));

        $response->assertOk();
        $response->assertViewIs('venue.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\VenueController::class,
            'store',
            \App\Http\Requests\VenueStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $name = $this->faker->name();
        $description = $this->faker->text();
        $start_date = $this->faker->dateTime();
        $end_date = $this->faker->dateTime();
        $status = $this->faker->randomElement(/** enum_attributes **/);
        $region = $this->faker->word();
        $conference = Conference::factory()->create();

        $response = $this->post(route('venue.store'), [
            'name' => $name,
            'description' => $description,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'status' => $status,
            'region' => $region,
            'conference_id' => $conference->id,
        ]);

        $venues = Venue::query()
            ->where('name', $name)
            ->where('description', $description)
            ->where('start_date', $start_date)
            ->where('end_date', $end_date)
            ->where('status', $status)
            ->where('region', $region)
            ->where('conference_id', $conference->id)
            ->get();
        $this->assertCount(1, $venues);
        $venue = $venues->first();

        $response->assertRedirect(route('venue.index'));
        $response->assertSessionHas('venue.id', $venue->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $venue = Venue::factory()->create();

        $response = $this->get(route('venue.show', $venue));

        $response->assertOk();
        $response->assertViewIs('venue.show');
        $response->assertViewHas('venue');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $venue = Venue::factory()->create();

        $response = $this->get(route('venue.edit', $venue));

        $response->assertOk();
        $response->assertViewIs('venue.edit');
        $response->assertViewHas('venue');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\VenueController::class,
            'update',
            \App\Http\Requests\VenueUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $venue = Venue::factory()->create();
        $name = $this->faker->name();
        $description = $this->faker->text();
        $start_date = $this->faker->dateTime();
        $end_date = $this->faker->dateTime();
        $status = $this->faker->randomElement(/** enum_attributes **/);
        $region = $this->faker->word();
        $conference = Conference::factory()->create();

        $response = $this->put(route('venue.update', $venue), [
            'name' => $name,
            'description' => $description,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'status' => $status,
            'region' => $region,
            'conference_id' => $conference->id,
        ]);

        $venue->refresh();

        $response->assertRedirect(route('venue.index'));
        $response->assertSessionHas('venue.id', $venue->id);

        $this->assertEquals($name, $venue->name);
        $this->assertEquals($description, $venue->description);
        $this->assertEquals($start_date, $venue->start_date);
        $this->assertEquals($end_date, $venue->end_date);
        $this->assertEquals($status, $venue->status);
        $this->assertEquals($region, $venue->region);
        $this->assertEquals($conference->id, $venue->conference_id);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $venue = Venue::factory()->create();

        $response = $this->delete(route('venue.destroy', $venue));

        $response->assertRedirect(route('venue.index'));

        $this->assertModelMissing($venue);
    }
}
