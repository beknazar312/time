<div style="padding-left: 20px" class="text-left">
    <div class="row">
        <div class="col-4">
            <p>You have: 37.57</p>
            <p>You have/Assigned: 21.34%</p>
            <p>Assigned: 176</p>
            <p>Ты опоздал: 1 раз</p>
            <p>На работе необходимо быть до 9:00. Если опоздали больше 3х раз в месяц, то дисциплина будет считаться не удовлетворительной и негативно скажется на запрос по повышению оклада.</p>
        
            <h2>Список Night Shift</h2>
            <a href="!#">Праздничный календарь</a> 
        </div>
    </div>

    <div>
        <form class="text-center" action='/time/index/index' method="POST">
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
                <?php foreach ($users as $user) { ?>
                <th scope="col"><?= $user->name ?></th>
                <?php } ?>
              </tr>
            </thead>
            <tbody>
            <?php foreach ($monthDays as $index => $monthDay) { ?>
              <?php if ($index == $today) { ?>
              <tr>
                <th scope="row" ><?= $index ?><br><?= $monthDay ?></th>
                <td id="today">
                  <?php $v26562400262iterator = $timers; $v26562400262incr = 0; $v26562400262loop = new stdClass(); $v26562400262loop->self = &$v26562400262loop; $v26562400262loop->length = count($v26562400262iterator); $v26562400262loop->index = 1; $v26562400262loop->index0 = 1; $v26562400262loop->revindex = $v26562400262loop->length; $v26562400262loop->revindex0 = $v26562400262loop->length - 1; ?><?php foreach ($v26562400262iterator as $timer) { ?><?php $v26562400262loop->first = ($v26562400262incr == 0); $v26562400262loop->index = $v26562400262incr + 1; $v26562400262loop->index0 = $v26562400262incr; $v26562400262loop->revindex = $v26562400262loop->length - $v26562400262incr; $v26562400262loop->revindex0 = $v26562400262loop->length - ($v26562400262incr + 1); $v26562400262loop->last = ($v26562400262incr == ($v26562400262loop->length - 1)); ?>

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
                  
                  <?php if ($this->length($timers) < 1) { ?>
                    <button id="start">start</button>
                  <?php } ?>
                </td>
              </tr>
              <?php } else { ?>
              <tr style="display:none" class="hide-show">
                <th scope="row"><?= $index ?><br><?= $monthDay ?></th>
                <td>Mark</td>
                <td>Mark2</td>
                <td>Mark3</td>
              </tr>
              <?php } ?>
            <?php } ?>
            </tbody>
          </table>
    </div>
</div>

<script>
      $('#toggle').click( function () {
        $('.hide-show').toggle();
      })
    
      $('#table').on('click', '#start', function () {
        $.ajax({
              type: "POST",
              url: "/time/timer/start",
              success:function(data){
                //$('#table').html(data);
                data = $.parseJSON(data);
                getTimers (data);
              }
          });
      })

      $('#table').on('click', '#stop', function () {
        var id = $('#stop').attr('data-id');

        $.ajax({
              type: "POST",
              url: "/time/timer/stop",
              data: {id:id},
              success:function(data){
                data = $.parseJSON(data);
                getTimers (data);
              }
          });
      })

      function getTimers (data) {
        var body = '';
        for (var i = 0; i < data.length; i++) {
          body +="<li>"+getDate(data[i].start)+"-"+getDate(data[i].stop)+"</li>";
          if (i === data.length -1) {
            if (data[i].stop != null) {
              body +="<button id='start'>start</button>";
            } else {
              body +="<button data-id='"+data[i].id+"'' id='stop'>stop</button>";
            }
          }
        }

        $('#today').html(body);
      }

      function getDate(date) {
        if (date == null) {
          return '';
        }

        var date = new Date(date);
        var hours = ('0'+date.getHours()).substr(-2);
        var minutes = ('0'+date.getMinutes()).substr(-2);
        return hours+':'+minutes;
      }
</script>

