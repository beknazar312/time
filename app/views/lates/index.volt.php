<div class="row">
    <div class="col-4">
        <form action="/time/Workday/update" method="POST" style="margin: 50px"> 
            <div class="form-group" >
              <label>Выбрать время начала рабочего дня</label>
              <input value="<?= $workday->time ?>" name="time" type="time" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </form>
    </div>
    <div class="col-8">
        <div class="text-center">
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Имя</th>
                    <th scope="col">Почта</th>
                    <th scope="col">Время</th>
                    <th scope="col">#</th>
                </tr>
            </thead>
            <tbody >
                <?php foreach ($lates as $late) { ?>
                <tr>
                    <td><?= $late->user->name ?></td>
                    <td><?= $late->user->email ?></td>
                    <td><?= $late->createdAt ?></td>
                    <td><?= $this->tag->linkTo(['lates/delete/' . $late->id, 'удалить', 'class' => 'btn btn-secondary btn-lg active']) ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
