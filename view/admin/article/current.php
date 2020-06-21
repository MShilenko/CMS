<?php includeView('admin.header', ['title' => $article->title]); ?>
<div class="admin-form-block">
  <?= $form->render(); ?>
</div>
<?php includeView('admin.footer'); ?>