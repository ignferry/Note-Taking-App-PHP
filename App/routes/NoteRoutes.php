<?php

namespace App\routes;

require_once "core/Routes.php";

use App\core\Routes;

class NoteRoutes extends Routes {
    protected function defineRoutes(): void {
        $this->get("notes", "NoteController", "showAllNotes");
        $this->get("notes/(?P<noteId>\d+)/edit", "NoteController", "showNoteEditForm");
        $this->post("notes", "NoteController", "createNote");
        $this->put("notes/(?P<noteId>\d+)", "NoteController", "updateNote");
        $this->delete("notes/(?P<noteId>\d+)", "NoteController", "deleteNote");
    }
}

?>