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
        // If user is admin, redirect to list of users

        if (isset($_SESSION["userId"]) && !$_SESSION["isAdmin"]) {
            $notes = $this->noteModel->selectAll()->where([["writer_id", "=", $_SESSION["userId"]]])->fetchAll();
            $this->view("notes/index", $notes);
        }
        else {
            $this->defaultRedirect();
        }
    }

    public function showNoteEditForm(int $noteId) {
        // GET /notes/<noteId>/edit
        // Shows editing form for the note with the specified id
        // If user is not authenticated, redirect to login page
        // If authenticated user is not the owner of the note, redirect to list of notes (/notes)

        if (isset($_SESSION["userId"]) && !$_SESSION["isAdmin"]) {
            $noteToEdit = $this->noteModel->selectAll()->where([["id", "=", $noteId]])->fetch();
            if (!$noteToEdit) {
                $this->redirectTo("/notes");
            }
            else if ($noteToEdit["writer_id"] != $_SESSION["userId"]) {
                $this->redirectTo("/notes");
            }
            else {
                $this->view("notes/edit", $noteToEdit);
            }
        }
        else {
            $this->defaultRedirect();
        }
    }

    public function createNote() {
        // POST /notes
        // Creates a new note and redirects to its editing page
        // If user is not authenticated, redirect to login page

        if (!isset($_SESSION["userId"])) {
            http_response_code(401);
            die();
        }
        else if ($_SESSION["isAdmin"]) {
            http_response_code(403);
            die();
        }
        else {
            $writerId = $_SESSION["userId"];

            $this->noteModel->create([
                "writer_id" => $writerId
            ])->fetch();

            if (!$this->noteModel->checkRowCount()) {
                http_response_code(500);
                die();
            }
            else {
                $this->redirectTo("/notes/" . $this->noteModel->lastInsertId() . "/edit");
            }
        }
    }

    public function updateNote(int $noteId) {
        // PUT /notes/<noteId>
        // Receives data of edited note (title, content) with the specified id and updates its contents in the database
        // Redirects to list of notes (/notes)
        // If user is not authenticated, redirect to login page
        // If authenticated user is not the owner of the note, redirect to list of notes (/notes)

        if (!isset($_SESSION["userId"])) {
            http_response_code(401);
            die();
        }
        else if ($_SESSION["isAdmin"]) {
            http_response_code(403);
            die();
        }
        else {
            $currentNoteData = $this->noteModel->select(["writer_id"])->where([["id", "=", $noteId]])->fetch();
            if (!$currentNoteData) {
                http_response_code(403);
                die();
            }
            else if ($currentNoteData["writer_id"] != $_SESSION["userId"]) {
                http_response_code(403);
                die();
            }
            else {
                $title = isset($_POST["title"]) ? $_POST["title"] : null;
                $content = isset($_POST["content"]) ? $_POST["content"] : null;
                $this->noteModel->update([
                    "title" => $title,
                    "content" => $content
                ])->where([["id", "=", $noteId]])->fetch();
                
                if (!$this->noteModel->checkRowCount()) {
                    http_response_code(500);
                    die();
                }
                else {
                    $this->redirectTo("/notes");
                }
            }
        }

    }

    public function deleteNote(int $noteId) {
        // DELETE /notes/<noteId>
        // Deletes note with the specified id from the database
        // Redirects to list of notes (/notes)
        // If user is not authenticated, redirect to login page
        // If authenticated user is not the owner of the note, redirect to list of notes (/notes)

        if (!isset($_SESSION["userId"])) {
            http_response_code(401);
            die();
        }
        else if ($_SESSION["isAdmin"]) {
            http_response_code(403);
            die();
        }
        else {
            $currentNoteData = $this->noteModel->select(["writer_id"])->where([["id", "=", $noteId]])->fetch();
            if (!$currentNoteData) {
                http_response_code(403);
                die();
            }
            else if ($currentNoteData["writer_id"] != $_SESSION["userId"]) {
                http_response_code(403);
                die();
            }
            else {
                $this->noteModel->delete()->where([["id", "=", $noteId]])->execute();
                
                if (!$this->noteModel->checkRowCount()) {
                    http_response_code(500);
                    die();
                }
                else {
                    $this->redirectTo("/notes");
                }
            }
        }
    }
}

?>