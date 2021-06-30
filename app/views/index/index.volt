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
                <option {% if month == 1 %} selected="selected" {% endif %}  value="1">January</option>
                <option {% if month == 2 %} selected="selected" {% endif %} value="2">February</option>
                <option {% if month == 3 %} selected="selected" {% endif %} value="3">March</option>
                <option {% if month == 4 %} selected="selected" {% endif %} value="4">April</option>
                <option {% if month == 5 %} selected="selected" {% endif %} value="5">May</option>
                <option {% if month == 6 %} selected="selected" {% endif %} value="6">june</option>
                <option {% if month == 7 %} selected="selected" {% endif %} value="7">July</option>
                <option {% if month == 8 %} selected="selected" {% endif %} value="8">August</option>
                <option {% if month == 9 %} selected="selected" {% endif %} value="9">September</option>
                <option {% if month == 10 %} selected="selected" {% endif %} value="10">October</option>
                <option {% if month == 11 %} selected="selected" {% endif %} value="11">November</option>
                <option {% if month == 12 %} selected="selected" {% endif %} value="12">December</option>
            </select>
            <select name="year" id="">
                <option {% if year == 2009 %} selected="selected" {% endif %} value="2009">2009</option>
                <option {% if year == 2010 %} selected="selected" {% endif %} value="2010">2010</option>
                <option {% if year == 2011 %} selected="selected" {% endif %} value="2011">2011</option>
                <option {% if year == 2012 %} selected="selected" {% endif %} value="2012">2012</option>
                <option {% if year == 2013 %} selected="selected" {% endif %} value="2013">2013</option>
                <option {% if year == 2014 %} selected="selected" {% endif %} value="2014">2014</option>
                <option {% if year == 2015 %} selected="selected" {% endif %} value="2015">2015</option>
                <option {% if year == 2016 %} selected="selected" {% endif %} value="2016">2016</option>
                <option {% if year == 2017 %} selected="selected" {% endif %} value="2017">2017</option>
                <option {% if year == 2018 %} selected="selected" {% endif %} value="2018">2018</option>
                <option {% if year == 2019 %} selected="selected" {% endif %} value="2019">2019</option>
                <option {% if year == 2020 %} selected="selected" {% endif %} value="2020">2020</option>
                <option {% if year == 2021 %} selected="selected" {% endif %} value="2021">2021</option>
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
            <tbody>
            {% for index,monthDay in monthDays %}
              {% if month == date('m') and index == date('d') %}
              <tr>
                <th scope="row" >{{index}}<br>{{monthDay}}</th>
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
              <tr style="display:none" class="hide-show">
                <th scope="row">{{index}}<br>{{monthDay}}</th>
                {% for user3 in users %}
                <td>
                  {% if totals[index][user3.id] is defined %}
                    {% for timer in totals[index][user3.id]['timers'] %}
                      <li>{{date('H:i',strtotime(timer.start))}} - {{date('H:i',strtotime(timer.stop))}}</li>
                    {% endfor %}
                    <p>total: {{totals[index][user3.id]['total']}}</p>
                  {% endif %}
                </td>
                {% endfor %}
              </tr>
              {% endif %}
            {% endfor %}
            </tbody>
          </table>
    </div>
</div>

