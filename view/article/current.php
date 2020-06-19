<?php includeView('base.header', ['title' => $article->title, 'image' => $article->image->name ?? 'home-bg.jpg']); ?>
<div class="col-lg-8 col-md-10 mx-auto post">
  <p class="post-meta">Опубликовано
        <?= $article->user->name ?>
        <?= $article->updated_at ?? $article->created_at ?></p>
  <?= $article->text ?>
  <hr>
  <?php includeView('base.comments', ['form' => $form, 'article' => $article]); ?>
</div>  
<?php includeView('base.footer'); ?>