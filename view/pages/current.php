<?php includeView('base.header', ['title' => $page->title]); ?>
<div class="col-lg-8 col-md-10 mx-auto post">
  <?= $page->text ?>
</div>
<?php includeView('base.footer'); ?>