<?php includeView('base.header', ['title' => 'Book ' . $this->data['title']]); ?>
<?php $book = $this->data; ?>
<table class="table table-dark">
  <tr>
    <td>Id</td>
    <td>Title</td>
    <td>Author</td>
  </tr>
  <tr>
    <td><?= $book['id'] ?></td>
    <td><?= $book['title'] ?></td>
    <td><?= $book['author'] ?></td>
  </tr>
</table>
<?php includeView('base.footer'); ?>