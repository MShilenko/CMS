<?php includeView('admin.header', ['title' => 'Страницы']); ?>
<div class="admin-add-button mb-3">
  <a href="/admin/pages/add/" class="btn btn-primary mr-1"><i class="far fa-folder"></i> Добавить новую</a>
</div>
<div class="card shadow mb-4 admin-pages">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Список страниц сайта</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Id</th>
            <th>Название</th>
            <th>Символьный код</th>
            <th>Дата создания</th>
            <th>Дата редактирования</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($pages as $page): ?>
            <tr class="page-edit<?= $page->trashed() ? ' trashed' : '' ?>">
              <td><?= $page->id ?></td>
              <td><?= $page->title ?></td>
              <td><?= $page->slug ?></td>
              <td><?= $page->created_at ?></td>
              <td><?= $page->updated_at ?></td>
              <td class="d-flex align-items-start">
                <a href="/admin/pages/edit/<?= $page->id ?>" class="btn btn-primary mr-1"><i class="far fa-edit"></i> Редактировать</a>
                <?php $form->setParams(['pageId' => $page->id]); ?>
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