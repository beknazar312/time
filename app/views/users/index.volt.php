<div class="container">
  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter">Добавить</button>

  <ul id="list" class="list-group">
    <?php foreach ($users as $user) { ?>
      <li class="list-group-item">
        <div class="row"><b class="col-7"><?= $user->name ?></b>
          <b class="col-1"><?= $user->active ?></b>
          <button id="<?= $user->id ?>" data-name="<?= $user->name ?>" data-login="<?= $user->login ?>" data-email="<?= $user->email ?>" data-active="<?= $user->active ?>" class="edit col-2">Изменить</button>
          <button id="<?= $user->id ?>" class="delete col-2">Удалить</button>
        </div>
      </li>
    <?php } ?> 
  </ul>
</div>


  <!-- Modal -->
  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Добавить нового пользователя</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
              <div class="form-group">
                <label for="name">Имя</label>
                <input type="text" class="form-control" id="name" >
              </div>
              <div class="form-group">
                <label for="login">Логин</label>
                <input type="text" class="form-control" id="login" >
              </div>
              <div class="form-group">
                <label for="email">Почта</label>
                <input type="text" class="form-control" id="email" >
              </div>
              <div class="form-group">
                <label for="password">Пароль</label>
                <input type="text" class="form-control" id="password" >
              </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
          <button id="send" type="button" class="btn btn-primary">Сохранить</button>
        </div>
      </div>
    </div>
  </div>

    <!-- Modal2 -->
    <div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">Добавить нового пользователя</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="POST" action="/time/users/update">
                <div class="form-group">
                  <label for="nameEdit">Имя</label>
                  <input name="name" type="text" class="form-control" id="nameEdit">
                </div>
                <div class="form-group">
                  <label for="loginEdit">Логин</label>
                  <input name="login" type="text" class="form-control" id="loginEdit">
                </div>
                <div class="form-group">
                  <label for="emailEdit">Почта</label>
                  <input  name="email" type="text" class="form-control" id="emailEdit">
                </div>
                <div class="form-group">
                  <label for="activeEdit">Активный</label>
                  <input  name="active" type="text" class="form-control" id="activeEdit">
                </div>
                <input type="hidden" id="idEdit" name="id">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </form>
          </div>
        </div>
      </div>
    </div>

