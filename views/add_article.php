<?php
?>

<section>
    <form method="post">
        <div><label for="title"> title </label>
            <input type="text" placeholder="title" name="title" maxlength="20"><br>
            <div class="error"><?= isset($error['title']) ? $error['title'] : "" ?></div>
        </div>

        <div><label for="content"> content </label>
            <textarea name="content" maxlength="3000"></textarea>
        </div>
        <div class="error"><?= isset($error['content']) ? $error['content'] : "" ?></div>

        <div><label for="tags"> tags </label>
            <input type="text" id="tags" placeholder="tags" name="tags" maxlength="20"><br>
        </div>
        <div class="error"><?= isset($error['tags']) ? $error['tags'] : "" ?></div>

        <div>select status</div>
        <select name="status">
            <option selected value="NEW">NEW</option>
            <option selected value="OPEN">OPEN</option>
            <option selected value="CLOSE">CLOSE</option>
        </select>
        <div class="error"><?= isset($error['status']) ? $error['status'] : "" ?></div>

        <div class="form_submit">
            <input class="submit" type="submit" value="Add article">
        </div>
    </form>
</section>
