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
        <?= $article->user->name ?>
        <?= $article->created_at ?></p>
    </div>
    <hr>
  <?php endforeach; ?>  
  <!-- Pager -->
  <div class="clearfix">
    <?php if ($pagination): ?>
      <?php includeView('base.pagination', ['pagination' => $pagination]);?>
    <?php endif; ?>
  </div>
  <?php if (!isset($user) || !$user ->subscribed()): ?>
    <h2 class="text-center">Подписка</h2>
    <?= $form->render() ?>
  <?php endif; ?>  
</div>
<?php includeView('base.footer');?>