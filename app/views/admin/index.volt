
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter">Добавить</button>

<ul id="list" class="list-group">
  {% for user in users %}
    <li class="list-group-item"><div class="row"><b class="col-10">{{user.name}}</b> <button id="{{user.id}}" class="delete col-2">Удалить</button></div></li>
  {% endfor %} 
</ul>

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

<!-- script -->
<script>

    $(document).ready(function () {

        // add manual
        $('#send').click(function () {
            var name = $('#name').val();
            var login = $('#login').val();
            var email = $('#email').val();
            var password = $('#password').val();

            $.ajax({
                type: "POST",
                url: "session/create",
                data: {
                    name:name,
                    login:login,
                    email:email,
                    password:password,
                },
                success:function(data){
                    $('#name').val('')
                    $('#login').val('');
                    $('#email').val('')
                    $('#password').val('');
                    $('#exampleModalCenter').modal('hide');
                    data = $.parseJSON(data);
                    setList(data);
                }
            });
        });

        // delete manual
        $('#list').on('click','.delete',function () {
            var id = $(this).attr('id');

            $.ajax({
                type: "POST",
                url: "session/delete",
                data: {id:id},
                success:function(data){
                    data = $.parseJSON(data);
                    setList(data);
                }
            });
        });

        // update manual list
        function setList(data) {
            var list = '';

            for(var i = 0; i < data.users.length; i++) {
                list += "<li class='list-group-item'><div class='row'><b class='col-10'>"+data.users[i].name+"</b> <button id='"+data.users[i].id+"' class='delete col-2'>Удалить</button></div></li>";
            }
            $('#list').html(list);
            
        }
    
    })

</script>