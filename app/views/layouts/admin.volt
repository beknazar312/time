<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
    <h5 class="my-0 mr-md-auto font-weight-normal">Company name</h5>
    <nav class="my-2 my-md-0 mr-md-3">
      {{ link_to('users/index', 'Пользователи', 'class': 'p-2 text-dark')}}
      {{ link_to('holidays/index', 'Праздники', 'class': 'p-2 text-dark')}}
      {{ link_to('lates/index', 'Опоздавшие', 'class': 'p-2 text-dark')}}
      <a class="p-2 text-dark" href="#">Pricing</a>
    </nav>
  </div>


    {{content()}}


    {% include 'partials/footer.volt' %}
