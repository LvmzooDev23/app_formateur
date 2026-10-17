<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\SchoolClass;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClassControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_delete_a_class(): void
    {
        $user = User::factory()->create();
        $class = SchoolClass::create(['name' => 'Classe à supprimer']);

        $response = $this
            ->actingAs($user)
            ->delete(route('classes.destroy', $class));

        $response->assertRedirect(route('classes.index'));
        $this->assertDatabaseMissing('school_classes', ['id' => $class->id]);
    }
}
