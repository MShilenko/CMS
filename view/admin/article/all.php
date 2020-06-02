<?php includeView('admin.header', ['title' => 'Статьи']); ?>
<div class="card shadow mb-4">
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
            <tr>
              <td><?= $article->id ?></td>
              <td><?= $article->title ?></td>
              <td><?= $article->slug ?></td>
              <td><?= $article->user->name ?></td>
              <td><?= $article->created_at ?></td>
              <td><?= $article->updated_at ?></td>
              <td><a href="#" class="btn btn-primary"><i class="far fa-edit"></i> Редактировать</a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<?php includeView('admin.footer'); ?>