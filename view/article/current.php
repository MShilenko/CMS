<?php includeView('base.header', ['title' => $article->title]); ?>
<div class="col-lg-8 col-md-10 mx-auto">
  <?= $article->text ?>
</div>
<?php includeView('base.footer'); ?>