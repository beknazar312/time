<?= $this->getContent() ?>

<div class="text-left">
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
      class="weekend"
    <?php } ?>
    >
      <tr 
      <?php if ($month == date('m')) { ?>
        class="hide-show hide" 
      <?php } ?>>

        <th scope="row"><?= $index ?><br><?= $value['day'] ?></th>
        <?php foreach ($users as $user3) { ?>
        <td 
        <?php if ($month == date('m') && $index == date('d')) { ?>
            id="today"
        <?php } else { ?>
            id="<?= $index ?>-<?= $user3->id ?>"
        <?php } ?>>
          <?php if (isset($totals[$index][$user3->id])) { ?>
            <?php foreach ($totals[$index][$user3->id]['timers'] as $timer) { ?>
                <div class="row"></div>
                <?php if ($timer->stop != null) { ?>
                    <li><?= date('H:i', strtotime($timer->start)) ?> - <?= date('H:i', strtotime($timer->stop)) ?></li>
                <?php } else { ?>
                    <li><?= date('H:i', strtotime($timer->start)) ?> - </li>
                <?php } ?>
                <?php if ($profile == 'Administartors') { ?>
                    <button data-id="<?= $timer->id ?>" data-start="<?= date('H:i', strtotime($timer->start)) ?>" data-stop="<?= date('H:i', strtotime($timer->stop)) ?>" class="change-timer">edit</button>
                <?php } elseif ($profile == 'Users') { ?>
                    <?php if ($timer->stop != null) { ?>
                        <button id="start">start</button>
                    <?php } elseif ($timer->stop == null || $this->length($totals[$index][$user3->id]['timers']) > 0) { ?>
                        <button data-id="<?= $timer->id ?>" id="stop">stop</button>
                    <?php } ?>
                <?php } ?>   
                </div>
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

