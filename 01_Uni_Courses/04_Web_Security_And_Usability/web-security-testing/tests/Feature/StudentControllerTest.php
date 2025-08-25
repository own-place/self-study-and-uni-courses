<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Student;
use App\Http\Controllers\StudentController;
use Illuminate\Http\Request;

class StudentControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_stores_student_data()
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'phone' => '123456789',
            'gender' => 'Male',
        ];

        $request = new Request($data);
        $controller = new StudentController();
        $response = $controller->store($request);

        $this->assertInstanceOf(\Illuminate\Http\RedirectResponse::class, $response);
        $this->assertDatabaseHas('students', $data);
    }

    /** @test */
    public function it_validates_student_data()
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'invalid_email', // Invalid email format
            'phone' => '123456789', // Example phone number
            'gender' => 'Male',
            'message' => 'This is a test message',
        ];

        $response = $this->post(route('student.store'), $data);

        $response->assertSessionHasErrors('email'); // Assert that 'email' field has validation error
        $this->assertDatabaseMissing('students', $data); // Ensure data is not stored in database
    }
}
