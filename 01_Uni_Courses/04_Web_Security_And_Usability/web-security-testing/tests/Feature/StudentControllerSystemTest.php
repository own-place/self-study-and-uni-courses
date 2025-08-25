<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Student;

class StudentControllerSystemTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function submit_student_form()
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'phone' => '123456789',
            'gender' => 'Male',
        ];

        $response = $this->post('/submit', $data);

        $response->assertRedirect('/');
        $this->assertDatabaseHas('students', [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'phone' => '123456789',
            'gender' => 'Male',
        ]);
    }

    /** @test */
    public function submit_student_form_with_invalid_data()
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'invalid-email', // Invalid email
            'phone' => '123456789',
            'gender' => 'Male',
        ];

        $response = $this->post('/submit', $data);

        $response->assertSessionHasErrors(['email']);
        $this->assertDatabaseMissing('students', [
            'name' => 'John Doe',
            'email' => 'invalid-email',
            'phone' => '123456789',
            'gender' => 'Male',
        ]);
    }
}
