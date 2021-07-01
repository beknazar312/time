<div style="padding-left: 20px" class="text-left">
    <div>
        <form class="text-center" action='/time/timer/index' method="POST">
            <select name="month" id="" >
                <option <?php if ($month == 1) { ?> selected="selected" <?php } ?>  value="1">January</option>
                <option <?php if ($month == 2) { ?> selected="selected" <?php } ?> value="2">February</option>
                <option <?php if ($month == 3) { ?> selected="selected" <?php } ?> value="3">March</option>
                <option <?php if ($month == 4) { ?> selected="selected" <?php } ?> value="4">April</option>
                <option <?php if ($month == 5) { ?> selected="selected" <?php } ?> value="5">May</option>
                <option <?php if ($month == 6) { ?> selected="selected" <?php } ?> value="6">june</option>
                <option <?php if ($month == 7) { ?> selected="selected" <?php } ?> value="7">July</option>
                <option <?php if ($month == 8) { ?> selected="selected" <?php } ?> value="8">August</option>
                <option <?php if ($month == 9) { ?> selected="selected" <?php } ?> value="9">September</option>
                <option <?php if ($month == 10) { ?> selected="selected" <?php } ?> value="10">October</option>
                <option <?php if ($month == 11) { ?> selected="selected" <?php } ?> value="11">November</option>
                <option <?php if ($month == 12) { ?> selected="selected" <?php } ?> value="12">December</option>
            </select>
            <select name="year" id="">
                <option <?php if ($year == 2009) { ?> selected="selected" <?php } ?> value="2009">2009</option>
                <option <?php if ($year == 2010) { ?> selected="selected" <?php } ?> value="2010">2010</option>
                <option <?php if ($year == 2011) { ?> selected="selected" <?php } ?> value="2011">2011</option>
                <option <?php if ($year == 2012) { ?> selected="selected" <?php } ?> value="2012">2012</option>
                <option <?php if ($year == 2013) { ?> selected="selected" <?php } ?> value="2013">2013</option>
                <option <?php if ($year == 2014) { ?> selected="selected" <?php } ?> value="2014">2014</option>
                <option <?php if ($year == 2015) { ?> selected="selected" <?php } ?> value="2015">2015</option>
                <option <?php if ($year == 2016) { ?> selected="selected" <?php } ?> value="2016">2016</option>
                <option <?php if ($year == 2017) { ?> selected="selected" <?php } ?> value="2017">2017</option>
                <option <?php if ($year == 2018) { ?> selected="selected" <?php } ?> value="2018">2018</option>
                <option <?php if ($year == 2019) { ?> selected="selected" <?php } ?> value="2019">2019</option>
                <option <?php if ($year == 2020) { ?> selected="selected" <?php } ?> value="2020">2020</option>
                <option <?php if ($year == 2021) { ?> selected="selected" <?php } ?> value="2021">2021</option>
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
              <?php if ($month != date('m') || $index != date('d')) { ?>
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
