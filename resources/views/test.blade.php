<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>test</title>

  </head>
  <body>
    <p>ajaxの練習</p>
    <button id="button">もっと読む</button>
    <div id="message"></div>

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script>
      $(function() {
        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        $('#button').click(function() {
          $.ajax({
            type: 'GET',
            url: '/ajax',
            data: {
              'word':'test',
              'name':'萩原'
            },
            success: function(data) {
              $('#message').append(data).append(name);
            },
            error: function() {
              alert('問題がありました。');
            }
          });
        });
      });
    </script>
  </body>
</html>
