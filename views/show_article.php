<?php
?>
Article:
<section>
    <div class="content">
        <div class="content"><a href="show?id=<?= isset($article) ? $article['id'] : ""; ?>"> Refresh page</a></div>
        <h4>Name: <?= isset($article) ? $article['title'] : ""; ?>
        </h4>
        <h5>
            Content: <?= isset($article) ? $article['content'] : ""; ?><br>
            Status: <?= isset($article) ? $article['status'] : ""; ?><br>
            Tags: <?= isset($article) ? $article['tags'] : ""; ?><br>
        </h5>
    </div>
</section>
Comments:
<section>
    <?php if (isset($comments)) {
        foreach ($comments as $comment) { ?>
            <section>
                Email -
                <?php echo $comment['email']; ?>
                <br>
                Comment -
                <?php echo $comment['content']; ?>
            </section>
        <?php }
    } ?>
</section>
Images:
<section>
    <?php if (isset($images)) {
        foreach ($images as $image) { ?>
            <div class="section_image">
                <img src="/MVCblog/public/<?php echo $image['codedname']; ?>" width="150"/>
                <?php echo $image['name']; ?>
            </div>
        <?php }
    } ?>
</section>
Add a comment:
<section>
    <form method="post">
        <input type="hidden" name="id" value="<?= isset($article) ? $article['id'] : ""; ?>">
        <div><label for="comment"> comment </label>
            <input type="text" name="comment">
            <div class="error"><?= isset($error['comment']) ? $error['comment'] : "" ?></div>
        </div>
        <div><label for="email"> email </label>
            <input type="text" name="email">
            <div class="error"><?= isset($error['email']) ? $error['email'] : "" ?></div>
        </div>
        <div class="form_submit">
            <input class="submit" type="submit" value="Add a comment">
        </div>
    </form>
</section>
Add image:
<section>
    Upload image for article
    <form method="post" enctype="multipart/form-data">
        <input type="file" name="image" required>
        <input type="hidden" name="id" value="<?= isset($article) ? $article['id'] : ""; ?>">
        <button type="submit">Download</button>
    </form>
    <div class="error"><?= isset($error_image['common']) ? $error_image['common'] : "" ?></div>
    <div class="error"><?= isset($error_image['type']) ? $error_image['type'] : "" ?></div>
    <div class="error"><?= isset($error_image['size']) ? $error_image['size'] : "" ?></div>
</section>


