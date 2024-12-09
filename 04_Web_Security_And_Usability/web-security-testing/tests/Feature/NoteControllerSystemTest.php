<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Note;

class NoteControllerSystemTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function create_note()
    {
        $data = [
            'title' => 'Test Note Title',
            'content' => 'Test Note Content',
        ];

        $response = $this->post(route('notes.store'), $data);

        $response->assertRedirect(route('notes.create'));
        $this->assertDatabaseHas('notes', $data);
    }

    /** @test */
    public function create_note_with_invalid_data()
    {
        $data = [
            'title' => '', // Invalid title
            'content' => 'Test Note Content',
        ];

        $response = $this->post(route('notes.store'), $data);

        $response->assertSessionHasErrors('title');
        $this->assertDatabaseMissing('notes', $data);
    }

    /** @test */
    public function update_note()
    {
        $note = Note::create([
            'title' => 'Initial Note Title',
            'content' => 'Initial Note Content',
        ]);

        $updatedData = [
            'title' => 'Updated Note Title',
            'content' => 'Updated Note Content',
        ];

        $response = $this->put(route('notes.update', $note), $updatedData);

        $response->assertRedirect(route('notes.create'));
        $this->assertDatabaseHas('notes', [
            'id' => $note->id,
            'title' => $updatedData['title'],
            'content' => $updatedData['content'],
        ]);
    }

    /** @test */
    public function delete_note()
    {
        $note = Note::create([
            'title' => 'To Be Deleted Note',
            'content' => 'Note content to be deleted',
        ]);

        $response = $this->delete(route('notes.destroy', $note));

        $response->assertRedirect(route('notes.create'));
        $this->assertDatabaseMissing('notes', ['id' => $note->id]);
    }
}
