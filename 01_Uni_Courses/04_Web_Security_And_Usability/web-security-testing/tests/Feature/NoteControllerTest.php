<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Note;
use App\Http\Controllers\NoteController;
use Illuminate\Http\Request;

class NoteControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_stores_note_data()
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
    public function it_validates_note_data()
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
    public function it_updates_note_data()
    {
        $note = Note::create([
            'title' => 'Initial Note Title',
            'content' => 'Initial Note Content',
        ]);

        $data = [
            'title' => 'Updated Note Title',
            'content' => 'Updated Note Content',
        ];

        $response = $this->put(route('notes.update', $note), $data);

        $response->assertRedirect(route('notes.create'));
        $this->assertDatabaseHas('notes', [
            'id' => $note->id,
            'title' => 'Updated Note Title',
            'content' => 'Updated Note Content',
        ]);
    }

    /** @test */
    public function it_deletes_note_data()
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
