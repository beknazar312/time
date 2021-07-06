<div class="text-left">
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
              class="weekend"
            <?php } ?>
            >
              <tr 
              <?php if ($month == date('m')) { ?>
                class="hide-show hide" 
              <?php } ?>>

                <th scope="row"><?= $index ?><br><?= $value['day'] ?></th>
                <?php foreach ($users as $user3) { ?>
                <td id="<?= $index ?>-<?= $user3->id ?>">
                  <?php if (isset($totals[$index][$user3->id])) { ?>
                    <?php foreach ($totals[$index][$user3->id]['timers'] as $timer) { ?>
                        <?php if ($timer->stop != null) { ?>
                          <div class="row">
                            <li><?= date('H:i', strtotime($timer->start)) ?> - <?= date('H:i', strtotime($timer->stop)) ?></li>
                          </div>
                        <?php } else { ?>
                          <div class="row">
                            <li><?= date('H:i', strtotime($timer->start)) ?> - </li>
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