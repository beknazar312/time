$(document).ready(function () {

      // add user
      $('#send').click(function () {
        var name = $('#name').val();
        var login = $('#login').val();
        var email = $('#email').val();
        var password = $('#password').val();

        $.ajax({
            type: "POST",
            url: "/time/users/create",
            data: {
                name:name,
                login:login,
                email:email,
                password:password,
            },
            success:function(data){
                $('#name').val('')
                $('#login').val('');
                $('#email').val('')
                $('#password').val('');
                $('#exampleModalCenter').modal('hide');
                data = $.parseJSON(data);
                setList(data);
            }
        });
    });

    // delete user
    $('#list').on('click','.delete',function () {
        var id = $(this).attr('id');

        $.ajax({
            type: "POST",
            url: "/time/users/delete",
            data: {id:id},
            success:function(data){
                data = $.parseJSON(data);
                setList(data);
            }
        });
    });

    // update user list
    function setList(data) {
        var list = '';

        for(var i = 0; i < data.users.length; i++) {
            list += "<li class='list-group-item'><div class='row'><b class='col-10'>"+data.users[i].name+"</b> <button id='"+data.users[i].id+"' class='delete col-2'>Удалить</button></div></li>";
        }
        $('#list').html(list);
        
    }


    //datepicker for holidays
    function getHolidays() {
        var holidays = [];

        $('#holidays > tr').each(function (key) {
            holidays[key] = [];
            holidays[key][0]  = $(this).attr('data-date');
            holidays[key][1]  = $(this).attr('data-month');
        })

        return holidays;
    }

    $(function(){
        var holidays = getHolidays();
        $("#datepicker").datepicker({
            beforeShowDay: function(date){
                var dayOfWeek = date.getDay();
                for (var i = 0; i < holidays.length; i++) {
                    if (holidays[i][0] == date.getDate() && holidays[i][1] - 1 == date.getMonth() || dayOfWeek == 0 || dayOfWeek == 6) {
                        return [false];
                    }
                }
                return [true];
            }
        });
    });

    $(function(){
        var holidays = getHolidays();
        $("#datepicker2").datepicker({
            beforeShowDay: function(date){
                var dayOfWeek = date.getDay();
                for (var i = 0; i < holidays.length; i++) {
                    if (holidays[i][0] == date.getDate() && holidays[i][1] - 1 == date.getMonth() || dayOfWeek == 0 || dayOfWeek == 6) {
                        return [false];
                    }
                }
                return [true];
            },
            onSelect: function(date){
                $('#datepicker_value').val(date)
            }
        });

    });

    $.datepicker.regional['ru'] = {
        closeText: 'Закрыть',
        prevText: 'Предыдущий',
        nextText: 'Следующий',
        currentText: 'Сегодня',
        monthNames: ['Январь','Февраль','Март','Апрель','Май','Июнь','Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],
        monthNamesShort: ['Янв','Фев','Мар','Апр','Май','Июн','Июл','Авг','Сен','Окт','Ноя','Дек'],
        dayNames: ['воскресенье','понедельник','вторник','среда','четверг','пятница','суббота'],
        dayNamesShort: ['вск','пнд','втр','срд','чтв','птн','сбт'],
        dayNamesMin: ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'],
        weekHeader: 'Не',
        dateFormat: 'yy-mm-dd',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
    };
    $.datepicker.setDefaults($.datepicker.regional['ru']);


    //start-stop
    $('#toggle').click( function () {
        $('.hide-show').toggle();
      })
    
      $('#table').on('click', '#start', function () {
        $.ajax({
              type: "POST",
              url: "/time/timer/start",
              success:function(data){
                data = $.parseJSON(data);
                getTimers(data);
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
        for (var i = 0; i < data.timers.length; i++) {
          body +="<li>"+getDate(data.timers[i].start)+"-"+getDate(data.timers[i].stop)+"</li>";
          if (i === data.timers.length -1) {
            if (data.timers[i].stop != null) {
              body +="<button id='start'>start</button>";
            } else {
              body +="<button data-id='"+data.timers[i].id+"'' id='stop'>stop</button>";
            }
          }
        }

        body += '<p>total: '+data.total+'</p>';

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

    
      //edit timer
      $('#table').on('click','.change-timer',function () {
          var start = $(this).attr('data-start');
          var stop = $(this).attr('data-stop');
          var id = $(this).attr('data-id');

          $('#start').val(start);
          $('#stop').val(stop);
          $('#timerId').val(id);

          $('#exampleModalCenter').modal('show');
      });

      $('#send-newtime').click(function () {
        var start = $('#start').val();
        var stop = $('#stop').val();
        var id = $('#timerId').val();

        $.ajax({
            type: "POST",
            url: "/time/timer/update",
            data: {
                start: start,
                stop: stop,
                timerId: id
            },
            success:function(data){
              data = $.parseJSON(data);
              getTimersOnEdit(data);
              $('#exampleModalCenter').modal('hide');
            }
        });
      });

      function getTimersOnEdit(data) {
        var body = '';
        for (var i = 0; i < data.timers.length; i++) {
          body += '<div class="row">'+
                    '<li>'+getDate(data.timers[i].start)+' - '+getDate(data.timers[i].stop)+'</li>'+
                    '<button data-id="'+data.timers[i].id+'" data-start="'+getDate(data.timers[i].start)+'" data-stop="'+getDate(data.timers[i].stop)+'" class="change-timer">edit</button>'+
                  '</div>';
        }
        body += '<p>total: '+data.total+'</p>';
        $(data.id).html(body);
      }




})