<nav>
  <ul class="pagination text-center">
    <li class="page-item"><a class="page-link" href="<?= parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?>">1</a></li>
    <?php for ($p = 2; $p <= $pagination; $p++): ?>
      <li class="page-item<?= paginationCurrentPage($p) ? ' active': '' ?>"><a class="page-link" href="?<?= prepareQueryString('page', $p) ?>"><?= $p ?></a></li>
    <?php endfor; ?>
  </ul>
</nav>