<?php
if (isset($article)) {
    ?>

    <section>
        <form method="post">
            <div><label for="title"> title </label>
                <input type="hidden"  name="id"  value="<?=$article['id'] ?>">
                <input type="text" placeholder="title" name="title" maxlength="20" value="<?=$article['title'] ?>"><br>
            </div>

            <div><label for="content"> content </label>
                <textarea name="content" maxlength="3000" ><?=$article['content'] ?></textarea>
            </div>
            <div><label for="tags"> tags </label>
                <input type="text" id="tags" placeholder="tags" name="tags" maxlength="20" value="<?=$article['tags'] ?>"><br>
            </div>
            <div>select status</div>
            <select name="status">
                <option selected value="NEW">NEW</option>
                <option selected value="OPEN">OPEN</option>
                <option selected value="CLOSE">CLOSE</option>
            </select>

            <div class="form_submit">
                <input class="submit" type="submit" value="Edit article">
            </div>
        </form>
    </section>
<?php } ?>