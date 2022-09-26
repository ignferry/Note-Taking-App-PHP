<?php require_once "views/components/header.php"?>

<div class="toolbar">
    <form action="/notes" method="post">
        <button type="submit">Create new note</button>
    </form>
</div>

<hr>

<div id="notes-list">
    <?php if(!$data["notes"]) : ?>
        <span class="empty-content-text">Let's create a new note!</span>

    <?php else: 
        foreach($data["notes"] as $note) : ?>
        <div class="short-note">
            <div class="short-note-title-div">
                <?php if($note["title"]) : ?>
                    <span class="note-title"> <?php echo $note["title"]?> </span>
                <?php else : ?>
                    <span class="note-title empty-text">No Title</span>
                <?php endif; ?>
            </div>
            
            <div class="short-note-content-div">
                <?php if($note["content"]) : ?>
                    <span class="note-content"> <?php echo $note["content"]?> </span>
                <?php else : ?>
                    <span class="note-content empty-text">No Content</span>
                <?php endif; ?>
            </div>

            <div class="short-note-buttons">
                <form action="/notes/<?php echo $note["id"] ?>" method="post">
                    <input hidden name="_method" value="DELETE">
                    <button type="submit">Delete</button>
                </form>
                <button class="edit-button" action="/notes/<?php echo $note["id"] ?>/edit">Edit</button>
            </div>
        </div>
    <?php endforeach;
        endif; ?>
</div>

<?php require_once "views/components/footer.php"?>