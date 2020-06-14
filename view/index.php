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
        <?= $article->updated_at ?? $article->created_at ?></p>
    </div>
    <hr>
  <?php endforeach; ?>  
  <!-- Pager -->
  <div class="clearfix">
    <a class="btn btn-primary float-right" href="#">Older Posts &rarr;</a>
  </div>
  <?php if (isset($user) && !empty($success)): ?>
    <div class="col-lg-12 alert mt-2 alert-success"><?= $success ?></div>
  <?php endif; ?>  
  <?php if (!isset($user) || !$user ->subscribed()): ?>
    <h2 class="text-center">Подписка</h2>
    <?= $form->render() ?>
  <?php endif; ?>  
</div>
<?php includeView('base.footer');?>