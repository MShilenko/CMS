<?php includeView('admin.header', ['title' => 'Статьи']); ?>
<div class="admin-add-button mb-3">
  <a href="/admin/articles/add/" class="btn btn-primary mr-1"><i class="fas fa-fw fa-book"></i> Добавить новую</a>
</div>
<div class="card shadow mb-4 admin-articles">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Список статей сайта</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Id</th>
            <th>Название</th>
            <th>Символьный код</th>
            <th>Автор</th>
            <th>Дата создания</th>
            <th>Дата редактирования</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($articles as $article): ?>
            <tr class="article-edit<?= $article->trashed() ? ' trashed' : '' ?>">
              <td><?= $article->id ?></td>
              <td><?= $article->title ?></td>
              <td><?= $article->slug ?></td>
              <td><?= $article->user->name ?></td>
              <td><?= $article->created_at ?></td>
              <td><?= $article->updated_at ?></td>
              <td class="d-flex align-items-start">
                <a href="/admin/articles/edit/<?= $article->id ?>" class="btn btn-primary mr-1"><i class="far fa-edit"></i> Редактировать</a>
                <?php $form->setParams(['articleId' => $article->id]); ?>
                <?= $form->render(); ?>
              </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<?php includeView('admin.footer'); ?>