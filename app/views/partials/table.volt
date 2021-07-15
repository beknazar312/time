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
      class="weekend"
    {% endif %}
    >
      <tr 
      {% if month == date('m') %}
        class="hide-show hide" 
      {% endif %}>

        <th scope="row">{{index}}<br>{{value['day']}}</th>
        {% for user3 in users %}
        <td 
        {% if month == date('m') and index == date('d') %}
            id="today"
        {% else %}
            id="{{index}}-{{user3.id}}"
        {% endif %}>
          {% if totals[index][user3.id] is defined %}
          <div class="row"></div>
            {% for timer in totals[index][user3.id]['timers'] %}
                {% if timer.stop != null %}
                    <li>{{date('H:i',strtotime(timer.start))}} - {{date('H:i',strtotime(timer.stop))}}</li>
                {% else %}
                    <li>{{date('H:i',strtotime(timer.start))}} - </li>
                {% endif %}
                {% if profile == 'Administrators' %}
                    <button data-id="{{timer.id}}" data-start="{{date('H:i',strtotime(timer.start))}}" data-stop="{{date('H:i',strtotime(timer.stop))}}" class="change-timer">edit</button>
                {% elseif profile == 'Users' and loop.last %}
                    {% if timer.stop != null %}
                        <button id="start">start</button>
                    {% elseif timer.stop == null%}
                        <button data-id="{{timer.id}}" id="stop">stop</button>
                    {% endif %}
                {% endif %}   
            {% endfor %}
          </div>
            <p>total: {{totals[index][user3.id]['total']}}</p>
          {% endif %}
        </td>
        {% endfor %}
      </tr>
    </tbody>
    {% endfor %}
</table>