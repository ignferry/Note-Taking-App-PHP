<?php

namespace App\controllers;

require_once "core/Controller.php";
require_once "models/Note.php";

use App\core\Controller;
use App\models\Note;

class NoteController extends Controller {
    private Note $noteModel;

    public function __construct() {
        $this->noteModel = new Note();
    }

    public function showAllNotes() {
        // GET /notes
        // Shows a list of notes owned by the authenticated user ordered by most recent update time first
        // If user is not authenticated, redirect to login page

    }

    public function showNoteEditForm(int $noteId) {
        // GET /notes/<noteId>/edit
        // Shows editing form for the note with the specified id
        // If user is not authenticated, redirect to login page
        // If authenticated user is not the owner of the note, redirect to list of notes (/notes)
    }

    public function createNote() {
        // POST /notes
        // Creates a new note and redirects to its editing page
        // If user is not authenticated, redirect to login page

    }

    public function updateNote(int $noteId) {
        // PUT /notes/<noteId>
        // Receives data of edited note (title, content) with the specified id and updates its contents in the database
        // Redirects to list of notes (/notes)
        // If user is not authenticated, redirect to login page
        // If authenticated user is not the owner of the note, redirect to list of notes (/notes)

    }

    public function deleteNote(int $noteId) {
        // DELETE /notes/<noteId>
        // Deletes note with the specified id from the database
        // Redirects to list of notes (/notes)
        // If user is not authenticated, redirect to login page
        // If authenticated user is not the owner of the note, redirect to list of notes (/notes)

    }
}

?>