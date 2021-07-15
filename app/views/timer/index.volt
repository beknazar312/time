<div class="text-left">
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
      {% include 'partials/table.volt' %}
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
