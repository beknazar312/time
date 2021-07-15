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