<?= $this->getContent() ?>

<div style="padding-left: 20px" class="text-left">
    <div class="row">
        <div class="col-4">
            <p>You have: <?= $totalHoursOfMonth ?></p>
            <p>Assigned: <?= $calendar['workhours'] ?></p>
            <p>Ты опоздал: <?= $lates ?> раз</p>
            <p>На работе необходимо быть до 9:00. Если опоздали больше 3х раз в месяц, то дисциплина будет считаться не удовлетворительной и негативно скажется на запрос по повышению оклада.</p>
        </div>
    </div>
    <div>
        <form class="text-center" action='/time/index/index' method="POST">
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
              <?php if ($month == date('m') && $index == date('d')) { ?>
              <tr>
                <th scope="row" ><?= $index ?><br><?= $value['day'] ?> </th>
                <td id="today">
                  <?php if (isset($totals[$index][$user->id])) { ?>
                    <?php $v26562400262iterator = $totals[$index][$user->id]['timers']; $v26562400262incr = 0; $v26562400262loop = new stdClass(); $v26562400262loop->self = &$v26562400262loop; $v26562400262loop->length = count($v26562400262iterator); $v26562400262loop->index = 1; $v26562400262loop->index0 = 1; $v26562400262loop->revindex = $v26562400262loop->length; $v26562400262loop->revindex0 = $v26562400262loop->length - 1; ?><?php foreach ($v26562400262iterator as $timer) { ?><?php $v26562400262loop->first = ($v26562400262incr == 0); $v26562400262loop->index = $v26562400262incr + 1; $v26562400262loop->index0 = $v26562400262incr; $v26562400262loop->revindex = $v26562400262loop->length - $v26562400262incr; $v26562400262loop->revindex0 = $v26562400262loop->length - ($v26562400262incr + 1); $v26562400262loop->last = ($v26562400262incr == ($v26562400262loop->length - 1)); ?>
                      <?php if ($timer->stop != null) { ?>
                        <li><?= date('H:i', strtotime($timer->start)) ?> - <?= date('H:i', strtotime($timer->stop)) ?></li>
                      <?php } else { ?>
                        <li><?= date('H:i', strtotime($timer->start)) ?> - </li>
                      <?php } ?>
                      <?php if ($v26562400262loop->last) { ?>
                        <?php if ($timer->stop != null) { ?>
                        <button id="start">start</button>
                        <?php } else { ?>
                        <button data-id="<?= $timer->id ?>" id="stop">stop</button>
                        <?php } ?>
                      <?php } ?>
                    <?php $v26562400262incr++; } ?>
                    <p>total: <?= $totals[$index][$user->id]['total'] ?></p>
                  <?php } else { ?>
                    <button id="start">start</button>
                  <?php } ?>
                </td>
              </tr>
              <?php } else { ?>
              <tr  class="hide-show" 
              <?php if ($month == date('m')) { ?>
              style="display:none"
              <?php } ?>>
                <th scope="row"><?= $index ?><br><?= $value['day'] ?></th>
                <?php $v26562400262iterator = $users; $v26562400262incr = 0; $v26562400262loop = new stdClass(); $v26562400262loop->self = &$v26562400262loop; $v26562400262loop->length = count($v26562400262iterator); $v26562400262loop->index = 1; $v26562400262loop->index0 = 1; $v26562400262loop->revindex = $v26562400262loop->length; $v26562400262loop->revindex0 = $v26562400262loop->length - 1; ?><?php foreach ($v26562400262iterator as $user3) { ?><?php $v26562400262loop->first = ($v26562400262incr == 0); $v26562400262loop->index = $v26562400262incr + 1; $v26562400262loop->index0 = $v26562400262incr; $v26562400262loop->revindex = $v26562400262loop->length - $v26562400262incr; $v26562400262loop->revindex0 = $v26562400262loop->length - ($v26562400262incr + 1); $v26562400262loop->last = ($v26562400262incr == ($v26562400262loop->length - 1)); ?>
                <td>
                  <?php if (isset($totals[$index][$user3->id])) { ?>
                    <?php foreach ($totals[$index][$user3->id]['timers'] as $timer) { ?>
                      <?php if ($timer->stop != null) { ?>
                        <li><?= date('H:i', strtotime($timer->start)) ?> - <?= date('H:i', strtotime($timer->stop)) ?></li>
                      <?php } else { ?>
                        <li><?= date('H:i', strtotime($timer->start)) ?> - </li>
                      <?php } ?>
                    <?php } ?>
                    <p>total: <?= $totals[$index][$user3->id]['total'] ?></p>
                  <?php } ?>
                </td>
                <?php $v26562400262incr++; } ?>
              </tr>
              <?php } ?>
            </tbody>
            <?php } ?>
      </table>
    </div>
</div>

