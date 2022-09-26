<?php require_once "views/components/header.php"?>

<form class="edit-form" action="/notes/<?php echo $data["note"]["id"]?>" method="post">
    <div id="notes-toolbar">
        <a href="/notes" class="icon-button">
            <img src="/public/images/back.svg">
        </a>
        <button type="submit" name="_method" class="medium-button" value="PUT">Update note</button>
        <button type="submit" name="_method" class="medium-button" value="DELETE">Delete note</button>

    </div>

    <hr>
    
    <div id="note-title-div">
        <input type="text" class= "title-field" name="title" value="<?php echo $data["note"]["title"] ?>" placeholder="Title">
    </div>

    <hr>

    <div class="note-content-div">
        <textarea class="content-field" name="content" oninput='this.style.height = "";this.style.height = (this.scrollHeight) + "px"'><?php echo $data["note"]["content"] ?></textarea>
    </div>
</form>





<?php require_once "views/components/footer.php"?>