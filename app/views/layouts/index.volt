<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
    <h5 class="my-0 mr-md-auto font-weight-normal">Growave</h5>
    <nav class="my-2 my-md-0 mr-md-3">
      {%- if administrator is defined and not(administrator is false) -%}
        {{ link_to('users', 'Админ панель', 'class':'p-2 text-dark') }}
      {% endif %}
      {{ link_to('users/change-password', 'Сменить пароль', 'class': 'p-2 text-dark')}}
      {{ link_to('logout', 'Выйти', 'class': 'p-2 text-dark')}}
    </nav>
</div>

{{content()}}

{% include 'partials/footer.volt' %}
