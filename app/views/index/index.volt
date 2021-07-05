{{content()}}

<div style="padding-left: 20px" class="text-left">
    <div class="row">
        <div class="col-4">
            <p>You have: {{totalHoursOfMonth}}</p>
            <p>Assigned: {{calendar['workhours']}}</p>
            <p>Ты опоздал: {{lates}} раз</p>
            <p>На работе необходимо быть до 9:00. Если опоздали больше 3х раз в месяц, то дисциплина будет считаться не удовлетворительной и негативно скажется на запрос по повышению оклада.</p>
        </div>
    </div>
    <div>
        <form class="text-center" action='/time/index/index' method="POST">
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
              {% if month == date('m') and index == date('d') %}
              <tr>
                <th scope="row" >{{index}}<br>{{value['day']}} </th>
                <td id="today">
                  {% if totals[index][user.id] is defined %}
                    {% for timer in totals[index][user.id]['timers'] %}
                      {% if timer.stop != null %}
                        <li>{{date('H:i',strtotime(timer.start))}} - {{date('H:i',strtotime(timer.stop))}}</li>
                      {% else %}
                        <li>{{date('H:i',strtotime(timer.start))}} - </li>
                      {% endif %}
                      {% if loop.last %}
                        {% if timer.stop != null %}
                        <button id="start">start</button>
                        {% else %}
                        <button data-id="{{timer.id}}" id="stop">stop</button>
                        {% endif %}
                      {% endif %}
                    {% endfor %}
                    <p>total: {{totals[index][user.id]['total']}}</p>
                  {% else %}
                    <button id="start">start</button>
                  {% endif %}
                </td>
              </tr>
              {% else %}
              <tr  class="hide-show" 
              {% if month == date('m') %}
              style="display:none"
              {% endif %}>
                <th scope="row">{{index}}<br>{{value['day']}}</th>
                {% for user3 in users %}
                <td>
                  {% if totals[index][user3.id] is defined %}
                    {% for timer in totals[index][user3.id]['timers'] %}
                      {% if timer.stop != null %}
                        <li>{{date('H:i',strtotime(timer.start))}} - {{date('H:i',strtotime(timer.stop))}}</li>
                      {% else %}
                        <li>{{date('H:i',strtotime(timer.start))}} - </li>
                      {% endif %}
                    {% endfor %}
                    <p>total: {{totals[index][user3.id]['total']}}</p>
                  {% endif %}
                </td>
                {% endfor %}
              </tr>
              {% endif %}
            </tbody>
            {% endfor %}
      </table>
    </div>
</div>

