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
                <td id="{{index}}-{{user3.id}}">
                  {% if totals[index][user3.id] is defined %}
                    {% for timer in totals[index][user3.id]['timers'] %}
                        {% if timer.stop != null %}
                          <div class="row">
                            <li>{{date('H:i',strtotime(timer.start))}} - {{date('H:i',strtotime(timer.stop))}}</li>
                          </div>
                        {% else %}
                          <div class="row">
                            <li>{{date('H:i',strtotime(timer.start))}} - </li>
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