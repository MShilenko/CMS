<?php

includeView('base.header', [
  'title' => 'Блог',
  'description' => 'Общий обзор статей',
  'image' => 'home-bg.jpg',
]);
?>
<div class="col-lg-8 col-md-10 mx-auto">
  <?php foreach ($articles as $article): ?>
    <div class="post-preview">
      <a href="/articles/<?= $article->slug ?>">
        <h2 class="post-title">
          <?= $article->title ?>
        </h2>
        <h3 class="post-subtitle">
          <?= shortLine($article->text) ?>
        </h3>
      </a>
      <p class="post-meta">Опубликовано
        <a href="#"><?= shortLine($article->user->name) ?></a>
        <?= $article->updated_at ?? $article->created_at ?></p>
    </div>
    <hr>
  <?php endforeach; ?>  
  <!-- Pager -->
  <div class="clearfix">
    <a class="btn btn-primary float-right" href="#">Older Posts &rarr;</a>
  </div>
</div>
<?php includeView('base.footer');?>