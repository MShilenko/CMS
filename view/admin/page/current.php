<?php includeView('admin.header', ['title' => $page->title]); ?>
<div class="admin-form-block">
  <?= $form->render(); ?>
</div>
<?php includeView('admin.footer'); ?>