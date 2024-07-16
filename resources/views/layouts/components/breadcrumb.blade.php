<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
      @if(request()->path() == '/')
          @include('.layouts/users/breadcrumb/list')
      @elseif (request()->path() == 'add')
          @include('.layouts/users/breadcrumb/add')
      @else (request()->path() == 'edit')
          @include('.layouts/users/breadcrumb/edit')
      @endif
  </ol>
</nav>
