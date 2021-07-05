<div style="padding-left: 20px" class="text-left">
    <div>
      <form class="text-center" action='/time/timer/index' method="POST">
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

        <table id="table" class="table table-bordered">
            <thead>
              <tr>
                <th style="max-width: 10px" scope="col"><button type="button" id="toggle" class="btn btn-success">Hide/Show</button></th>
                <?php foreach ($users as $user2) { ?>
                <th scope="col"><?= $user2->name ?></th>
                <?php } ?>
              </tr>
            </thead>
            <?php foreach ($calendar['calendar'] as $index => $value) { ?>
            <tbody
            <?php if ($value['weekend'] == 1) { ?>
              style="background:rgb(219, 130, 130)"
            <?php } ?>
            >
              <tr 
              <?php if ($month == date('m') && $index != date('d')) { ?>
                style="display:none" class="hide-show"
              <?php } ?>
              >
                <th scope="row"><?= $index ?><br><?= $value['day'] ?></th>
                <?php foreach ($users as $user3) { ?>
                <td id="<?= $index ?>-<?= $user3->id ?>">
                  <?php if (isset($totals[$index][$user3->id])) { ?>
                    <?php foreach ($totals[$index][$user3->id]['timers'] as $timer) { ?>
                        <?php if ($timer->stop != null) { ?>
                          <div class="row">
                            <li><?= date('H:i', strtotime($timer->start)) ?> - <?= date('H:i', strtotime($timer->stop)) ?></li>
                            <button data-id="<?= $timer->id ?>" data-start="<?= date('H:i', strtotime($timer->start)) ?>" data-stop="<?= date('H:i', strtotime($timer->stop)) ?>" class="change-timer">edit</button>
                          </div>
                        <?php } else { ?>
                          <div class="row">
                            <li><?= date('H:i', strtotime($timer->start)) ?> - </li>
                            <button data-id="<?= $timer->id ?>" data-start="<?= date('H:i', strtotime($timer->start)) ?>" data-stop="<?= date('H:i', strtotime($timer->stop)) ?>" class="change-timer">edit</button>
                          </div>
                        <?php } ?>
                    <?php } ?>
                    <p>total: <?= $totals[$index][$user3->id]['total'] ?></p>
                  <?php } ?>
                </td>
                <?php } ?>
              </tr>
            </tbody>
            <?php } ?>
          </table>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Изменить время начала и конца сеанса</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <form > 
          <div class="form-group" >
            <label>Выбрать время начала сеанса</label>
            <input value="" name="start" id="start" type="time" class="form-control">
          </div>
          <div class="form-group" >
            <label>Выбрать время окончания сеанса</label>
            <input value="" name="stop" id="stop" type="time" class="form-control">
          </div>
          <input type="hidden" name="timerId" id="timerId" value="">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
        <button id="send-newtime" type="button" class="btn btn-primary">Сохранить</button>
      </div>
    </div>
  </div>
</div>
