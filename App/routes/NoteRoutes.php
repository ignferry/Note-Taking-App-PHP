<?php

namespace App\routes;

require_once "core/Routes.php";

use App\core\Routes;

class NoteRoutes extends Routes {
    protected function defineRoutes(): void {
        $this->get("notes", "NotesController", "showAllNotes");
        $this->get("notes/(?P<noteId>\d+)/edit", "NotesController", "showNoteEditForm");
        $this->post("notes", "NotesController", "createNote");
        $this->put("notes/(?P<noteId>\d+)", "NotesController", "updateNote");
        $this->delete("notes/(?P<noteId>\d+)", "NotesController", "deleteNote");
    }
}

?>