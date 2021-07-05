<div class="row">
    <div class="col-4">
        <form action="/time/worktime/update" method="POST" style="margin: 50px"> 
            <div class="form-group" >
              <label>Выбрать время начала рабочего дня</label>
              <input value="<?= $worktime->time ?>" name="time" type="time" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </form>
    </div>
    <div class="col-8">
        <div class="text-center">
            <form class="text-center" action='/time/lates/index' method="POST">
                <select name="day" id="" >
                    <?php foreach ($days as $index => $value) { ?>
                      <option <?php if ($day == $index) { ?> selected="selected" <?php } ?>  value="<?= $index ?>"><?= $value ?></option>
                    <?php } ?>
                </select>
                <select name="month" id="" >
                  <?php foreach ($monthes as $index => $value) { ?>
                    <option <?php if ($month == $index) { ?> selected="selected" <?php } ?>  value="<?= $index ?>"><?= $value ?></option>
                  <?php } ?>
                </select>
                <select name="year" id="">
                  <?php foreach ($years as $value) { ?>
                    <option <?php if ($year == $value) { ?> selected="selected" <?php } ?> value="<?= $value ?>"><?= $value ?></option>
                  <?php } ?>
                </select>
                <button type="submit">Submit</button>
            </form>
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
