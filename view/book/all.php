<?php includeView('base.header', ['title' => 'Books']); ?>
<?php $books = $this->data; ?>
<table class="table table-dark">
  <tr>
    <td>Id</td>
    <td>Title</td>
    <td>Author</td>
  </tr>
  <?php foreach ($books as $book): ?>
    <tr>
      <td><?= $book['id'] ?></td>
      <td><a class="btn btn-info" href="/book/<?= $book['id'] ?>"><?= $book['title'] ?></a></td>
      <td><?= $book['author'] ?></td>
    </tr>
  <?php endforeach; ?>
</table>
<?php includeView('base.footer'); ?>