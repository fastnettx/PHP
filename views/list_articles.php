<?php

if (isset($articles)) {
    foreach ($articles as $item) {
        ?>
        <section>
            <ul>
                <li><a href="show?id=<?php echo $item['id']; ?>">  <?php echo $item['title']; ?>  </a>
                    <div class="content">
                        <a href="edit?id=<?php echo $item['id']; ?>">edit </a>
                        <a href="delete?id=<?php echo $item['id']; ?>"> delete </a>
                    </div>
                </li>
            </ul>
        </section>
        <?php
    }
}
?>

