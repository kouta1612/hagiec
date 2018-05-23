
<!DOCTYPE HTML>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>商品一覧</title>
 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

<style>
.sidebar aside {
  background: #f0f0f0;
  padding: 20px;
  margin-top: 100px;
  padding-bottom: 32768px;
  margin-bottom: -32768px;
}

body {
  overflow:hidden;
}

.card {
  margin-top: 100px;
}





</style>

</head>
 
<body>

  <nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">hagiEC</a>
    </div>
    <div class="nav-content navbar-right" style="float:left">
      <button type="button" class=" navbar-toggle" data-toggle="collapse" data-target="#nav-content">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <div id="nav-content" class="collapse navbar-collapse" style="margin-right: 100px;">
        <!--検索フォーム-->
        <form class="navbar-form" role="search" style="float:left">
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Search">
          </div>
          <button type="submit" class="btn btn-default">Submit</button>
        </form>
        <ul class="nav navbar-nav">
          <li><a href="">ログアウト</a></li>
          <li><a href="">カートへ</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container main-content">
    <div class="row">
      <div class="col-md-3 sidebar">
        <aside>
          <h4>カテゴリ</h4>
          <form>
            <div class="checkbox">
              <label><input type="checkbox" value="">check 1</label>
            </div>
            <div class="checkbox">
              <label><input type="checkbox" value="">check 2</label>
            </div>
            <div class="checkbox disabled">
              <label><input type="checkbox" value="">check 3</label>
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
          </form>
        </aside>
      </div>


      <div class="col-md-9 content-area">
        <div class="row">
          <div class="col-md-3">
            <div class="card mb-3 box-shadow">
              <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&bg=55595c&fg=eceeef&text=Thumbnail" alt="Card image cap">
              <div class="card-body">
                <p class="card-text">説明文</p>
                <div class="d-flex justify-content-between align-items-center">
                  <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-outline-secondary">詳細</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary">カートに入れる</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card mb-3 box-shadow">
              <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&bg=55595c&fg=eceeef&text=Thumbnail" alt="Card image cap">
              <div class="card-body">
                <p class="card-text">説明文</p>
                <div class="d-flex justify-content-between align-items-center">
                  <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-outline-secondary">詳細</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary">カートに入れる</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card mb-3 box-shadow">
              <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&bg=55595c&fg=eceeef&text=Thumbnail" alt="Card image cap">
              <div class="card-body">
                <p class="card-text">説明文</p>
                <div class="d-flex justify-content-between align-items-center">
                  <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-outline-secondary">詳細</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary">カートに入れる</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card mb-3 box-shadow">
              <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&bg=55595c&fg=eceeef&text=Thumbnail" alt="Card image cap">
              <div class="card-body">
                <p class="card-text">説明文</p>
                <div class="d-flex justify-content-between align-items-center">
                  <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-outline-secondary">詳細</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary">カートに入れる</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card mb-3 box-shadow">
              <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&bg=55595c&fg=eceeef&text=Thumbnail" alt="Card image cap">
              <div class="card-body">
                <p class="card-text">説明文</p>
                <div class="d-flex justify-content-between align-items-center">
                  <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-outline-secondary">詳細</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary">カートに入れる</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card mb-3 box-shadow">
              <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&bg=55595c&fg=eceeef&text=Thumbnail" alt="Card image cap">
              <div class="card-body">
                <p class="card-text">説明文</p>
                <div class="d-flex justify-content-between align-items-center">
                  <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-outline-secondary">詳細</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary">カートに入れる</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card mb-3 box-shadow">
              <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&bg=55595c&fg=eceeef&text=Thumbnail" alt="Card image cap">
              <div class="card-body">
                <p class="card-text">説明文</p>
                <div class="d-flex justify-content-between align-items-center">
                  <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-outline-secondary">詳細</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary">カートに入れる</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card mb-3 box-shadow">
              <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&bg=55595c&fg=eceeef&text=Thumbnail" alt="Card image cap">
              <div class="card-body">
                <p class="card-text">説明文</p>
                <div class="d-flex justify-content-between align-items-center">
                  <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-outline-secondary">詳細</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary">カートに入れる</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card mb-3 box-shadow">
              <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&bg=55595c&fg=eceeef&text=Thumbnail" alt="Card image cap">
              <div class="card-body">
                <p class="card-text">説明文</p>
                <div class="d-flex justify-content-between align-items-center">
                  <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-outline-secondary">詳細</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary">カートに入れる</button>
                  </div>
                </div>
              </div>
            </div>
          </div>





        </div>



      </div>
    </div>
  </div>




  </div>
     
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>



</body>
</html>
