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