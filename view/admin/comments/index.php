<?php includeView('admin.header', ['title' => 'Комментарии']); ?>
<div class="card shadow mb-4 admin-comments">
  <div class="card-header py-3 d-flex">
    <div class="col-lg-6">
      <h6 class="m-0 font-weight-bold text-primary">Список комментариев</h6>
    </div>
    <div class="col-lg-6 admin-form-block">
      <?= $filterForm->render() ?>
    </div>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Id</th>
            <th>Автор</th>
            <th>Комментарий</th>
            <th>Дата создания</th>
            <th>Статья</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($comments as $comment): ?>
            <tr class="comment-edit<?= !$comment->active ? ' not-active' : '' ?>">
              <td><?= $comment->id ?></td>
              <td><?= $comment->user->name ?></td>
              <td class="comment-td"><?= $comment->comment ?></td>
              <td><?= $comment->created_at ?></td>
              <td><a href="/articles/<?= $comment->article->slug ?>"><?= $comment->article->title ?></a></td>
              <td class="c-buttons d-flex align-items-start">
                <?php if ($user->id === $comment->user->id): ?>
                  <a href="/admin/comments/edit/<?= $comment->id ?>" class="btn btn-primary mr-1"><i class="far fa-edit"></i> Редактировать</a>
                <?php endif; ?>
                <?php $form->setParams(['commentId' => $comment->id]); ?>
                <?= $form->render(); ?>
              </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    <!-- Pager -->
    <div class="clearfix">
      <?php if ($pagination): ?>
        <?php includeView('base.pagination', ['pagination' => $pagination]);?>
      <?php endif; ?>
    </div>
  </div>
</div>
<?php includeView('admin.footer'); ?>