{{content()}}

<div class="text-left">
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

        {% include 'partials/table.volt' %}
    </div>
</div>

