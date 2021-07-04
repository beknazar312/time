<div class="row">
    <div class="col-3">
        <form action="/time/holidays/create" method="POST" style="margin: 50px"> 
            <div class="form-group">
              <label for="inputAddress2">Выбрать выходной день</label>
              <input autocomplete="off" name="date" type="text" class="form-control" id="datepicker" placeholder="Выберите дату">
            </div>
            <div class="form-group">
              <div class="form-check">
                <input name="repeate" class="form-check-input" type="checkbox" id="gridCheck">
                <label class="form-check-label" for="gridCheck">
                  Повторять
                </label>
              </div>
            </div>
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </form>
    </div>
    <div class="col-5">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Дата</th>
                    <th scope="col">Повтор</th>
                    <th scope="col">#</th>
                </tr>
            </thead>
            <tbody id="holidays">
                <?php foreach ($holidays as $holiday) { ?>
                <tr data-date="<?= date('d', strtotime($holiday->date)) ?>" data-month="<?= date('m', strtotime($holiday->date)) ?>">
                    <td><?= date('j F', strtotime($holiday->date)) ?></td>
                    <td><?= $holiday->repeate ?></td>
                    <td><?= $this->tag->linkTo(['holidays/delete/' . $holiday->id, 'удалить', 'class' => 'btn btn-secondary btn-lg active']) ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="col-4">
        <div id="datepicker2"></div>
        <input type="hidden" id="datepicker_value" value="01.08.2019">
    </div>
</div>
