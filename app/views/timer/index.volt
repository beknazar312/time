<div style="padding-left: 20px" class="text-left">
    <div>
      <form class="text-center" action='/time/timer/index' method="POST">
        <select name="month" id="" >
          {% for index,value in monthes %}
            <option {% if month == index %} selected="selected" {% endif %}  value="{{index}}">{{value}}</option>
          {% endfor %}
        </select>
        <select name="year" id="">
          {% for value in years %}
            <option {% if year == value %} selected="selected" {% endif %} value="{{value}}">{{value}}</option>
          {% endfor %}
        </select>
        <button type="submit">Submit</button>
    </form>

        <table id="table" class="table table-bordered">
            <thead>
              <tr>
                <th style="max-width: 10px" scope="col"><button type="button" id="toggle" class="btn btn-success">Hide/Show</button></th>
                {% for user2 in users %}
                <th scope="col">{{user2.name}}</th>
                {% endfor %}
              </tr>
            </thead>
            {% for index,value in calendar['calendar'] %}
            <tbody
            {%  if value['weekend'] == 1 %}
              style="background:rgb(219, 130, 130)"
            {% endif %}
            >
              <tr 
              {%  if month == date('m') and index != date('d') %}
                style="display:none" class="hide-show"
              {% endif %}
              >
                <th scope="row">{{index}}<br>{{value['day']}}</th>
                {% for user3 in users %}
                <td id="{{index}}-{{user3.id}}">
                  {% if totals[index][user3.id] is defined %}
                    {% for timer in totals[index][user3.id]['timers'] %}
                        {% if timer.stop != null %}
                          <div class="row">
                            <li>{{date('H:i',strtotime(timer.start))}} - {{date('H:i',strtotime(timer.stop))}}</li>
                            <button data-id="{{timer.id}}" data-start="{{date('H:i',strtotime(timer.start))}}" data-stop="{{date('H:i',strtotime(timer.stop))}}" class="change-timer">edit</button>
                          </div>
                        {% else %}
                          <div class="row">
                            <li>{{date('H:i',strtotime(timer.start))}} - </li>
                            <button data-id="{{timer.id}}" data-start="{{date('H:i',strtotime(timer.start))}}" data-stop="{{date('H:i',strtotime(timer.stop))}}" class="change-timer">edit</button>
                          </div>
                        {% endif %}
                    {% endfor %}
                    <p>total: {{totals[index][user3.id]['total']}}</p>
                  {% endif %}
                </td>
                {% endfor %}
              </tr>
            </tbody>
            {% endfor %}
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
