<h2> <?= esc($title) ?> </h2>

<!-- if statement to identify if the is items in news_list -->
<?php if ($news_list !== []): ?>
    <!-- foreach of every item found in news_list -->
    <?php foreach ($news_list as $news_item): ?>

        <h3> <?= esc($news_item['title']) ?> </h3>
        <div class="main">
            <?= esc($news_item['body']) ?>
        </div>
        <p><a href="/news/<?= esc($news_item['slug'], 'url') ?>"> View article </p></a>

    <?php endforeach ?>
<!-- if there is no item show this code -->
<?php else: ?>

    <h3>No News</h3>
    <p> Unable to find any news for you. </p>

<?php endif ?>