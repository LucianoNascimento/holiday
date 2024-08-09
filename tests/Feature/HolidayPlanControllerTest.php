<?php

namespace Tests\Feature;

use App\Models\HolidayPlan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HolidayPlanControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate');
    }

    public function test_user_can_create_holiday_plan()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        $response = $this->postJson('/api/holiday-plans', [
            'title' => 'Férias na Praia',
            'description' => 'Viagem para a praia com a família.',
            'date' => '2024-12-01',
            'location' => 'Praia de Copacabana',
            'participants' => 'Família'
        ]);

        $response->assertStatus(201)
            ->assertJson([
                'message' => 'Holiday plan created successfully.',
                'data' => [
                    'title' => 'Férias na Praia',
                    'description' => 'Viagem para a praia com a família.',
                    'date' => '2024-12-01',
                    'location' => 'Praia de Copacabana',
                    'participants' => 'Família'
                ]
            ]);
    }

    public function test_user_can_update_holiday_plan()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        $holidayPlan = HolidayPlan::factory()->create();

        $response = $this->putJson("/api/holiday-plans/{$holidayPlan->id}", [
            'title' => 'Férias na Montanha',
            'description' => 'Viagem para a montanha com amigos.',
            'date' => '2024-12-01',
            'location' => 'Serra Gaúcha',
            'participants' => 'Amigos'
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Holiday plan updated successfully.',
                'data' => [
                    'title' => 'Férias na Montanha',
                    'description' => 'Viagem para a montanha com amigos.',
                    'date' => '2024-12-01',
                    'location' => 'Serra Gaúcha',
                    'participants' => 'Amigos'
                ]
            ]);
    }

    public function test_user_can_delete_holiday_plan()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        $holidayPlan = HolidayPlan::factory()->create();

        $response = $this->deleteJson("/api/holiday-plans/{$holidayPlan->id}");

        $response->assertStatus(204);
    }

    public function test_user_can_generate_pdf_for_holiday_plan()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        $holidayPlan = HolidayPlan::factory()->create();

        $response = $this->getJson("/api/holiday-plans/{$holidayPlan->id}/pdf");

        $response->assertStatus(200)
            ->assertHeader('Content-Type', 'application/pdf');
    }
}
