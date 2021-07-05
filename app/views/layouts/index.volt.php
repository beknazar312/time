<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
    <h5 class="my-0 mr-md-auto font-weight-normal">Growave</h5>
    <nav class="my-2 my-md-0 mr-md-3"><?php if (isset($administrator) && !($administrator == false)) { ?><?= $this->tag->linkTo(['users', 'Админ панель', 'class' => 'p-2 text-dark']) ?>
      <?php } ?>
      <?= $this->tag->linkTo(['users/changePassword', 'Сменить пароль', 'class' => 'p-2 text-dark']) ?>
      <?= $this->tag->linkTo(['session/logout', 'Выйти', 'class' => 'p-2 text-dark']) ?>
    </nav>
</div>

<?= $this->getContent() ?>

<footer class="pt-4 my-md-5 pt-md-5 border-top">
    <div class="text-center">
      <b>Growave</b>
    </div>
</footer>
