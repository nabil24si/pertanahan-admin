<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>BinaDesa Pertanahan - Admin</title>
    {{--Start CSS--}}
    @include('layouts.admin.css')
    {{--Start CSS--}}

  </head>
  <body>
    <div class="container-scroller">

      <!-- partial:partials/_navbar.html -->
      @include('layouts.admin.header')
      <!-- partial -->
      <div class="container-fluid page-body-wrapper" >

        @include('layouts.admin.sidebar')

        {{--Start Main Content--}}
        <div class="main-panel">
            @yield('content')
          {{--End Main Content--}}

          {{--Start Footer--}}
          @include('layouts.admin.footer')
          {{--End Footer--}}

        </div>

      </div>

    </div>
    {{--Start JS--}}
    @include('layouts.admin.js')
    {{--End JS--}}
  </body>
</html>
