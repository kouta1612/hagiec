<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <!-- Styles -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top mb-5">
    <div class="container">
      <a id="logo" class="navbar-brand" href="/top">hagiEC</a>
      <form class="form-inline my-2 my-lg-0 py-2" action="/top" method="post">
        {{csrf_field()}}
        <div class="form-group">
          @if(isset($search_item_name))
          <input class="form-control mr-sm-2" name="search_item_name" value="{{$search_item_name}}" type="text" placeholder="Search" aria-label="Search">
          @else
          <input class="form-control mr-sm-2" name="search_item_name" type="text" placeholder="Search" aria-label="Search">
          @endif
        </div>
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      </form>
      <ul class="navbar-nav">
        @if(Auth::check())
          <li class="nav-item"><a class="nav-link" href="/logout">ログアウト</a></li>
        @else
          <li class="nav-item"><a class="nav-link" href="/login">ログイン</a></li>
        @endif
          <li class="nav-item"><a class="nav-link" href="/cart">カート</a></li>
      </ul>
    </div>
  </nav>
  @yield('content')
  <!-- Scripts -->
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
  @yield('jQuery')
</body>
</html>
