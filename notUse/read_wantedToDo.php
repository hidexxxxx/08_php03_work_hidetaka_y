<?php

//DB接続
$dbn ='mysql:dbname=07_php02_work_items;charset=utf8mb4;port=3306;host=localhost';
$user = 'root';
$pwd = '';

try {
  $pdo = new PDO($dbn, $user, $pwd);
} catch (PDOException $e) {
  echo json_encode(["db error" => "{$e->getMessage()}"]);
  exit();
};

// ソートの方法（安い順 or 高い順）とフィールド（価格 or アップロード日時）を取得
$sort = $_GET['sort'] ?? 'asc';
$field = $_GET['field'] ?? 'price';

// SQL作成&実行
$sql = 'SELECT * FROM items_table ORDER BY ';

// ソート対象のフィールドによってSQL文を変更
if ($field == 'price') {
    $sql .= 'price ';
} elseif ($field == 'uploaded_at') {
    $sql .= 'uploaded_at ';
}

// ソートの方法によってSQL文を変更
if ($sort == 'asc') {
    $sql .= 'ASC';
} elseif ($sort == 'desc') {
    $sql .= 'DESC';
}

$stmt = $pdo->prepare($sql);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

// 結果表示実行
$output = "";
foreach ($result as $record) {
  $output .= 
    "
    <section class='grid'>
      <div class='each-grid'>
          <p>{$record["item"]}</p>

          <div class='box'>
              <div>
                  <img src='{$record["photo_A"]}' class='photo_A'>
              </div>
              <div class='half-box'>
                  <img src='{$record["photo_B"]}' class='photo_B'>
                  <img src='{$record["photo_C"]}' class='photo_C'>
              </div>
          </div>

          <p>{$record["explanation"]}</p>
          <p>price : ¥ {$record["price"]}</p>
      </div>  
    </section>
    ";   
}


?>


<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="read.css">
  <title>item画面</title>
</head>

<body>
  <header id="header">
        <div class="logo-box">
            <a href="archive.html"><img class="brand-logo" src="img/logo/brand-logo.png" alt="logo"></a>
        </div>
        <!-- <p class="hamburger-menu-p">Menu</p> -->
        <div class="hamburger-menu">
            <span class="line"></span>
            <span class="line"></span>
            <span class="line"></span>
        </div>
        <nav class="wrapper">
            <ul class="menu">
                <li class="menu-top"><a href="#">TOP</a></li>
                <li class="menu-collection"><a href="collection.html">COLLECTION</a></li>
                <li class="menu-archive"><a href="archive.html">ARCHIVE</a></li>
                <li class="menu-category"><a href="#">CATEGORY</a></li>
                <li class="login-login"><a href="index.html">LOGIN</a></li>
                <li class="login-contact"><a href="contact_input.php">CONTACT</a></li>
            </ul>

            <ul class="login">
                <div class="profiles">
                    <!-- プロフィール画像表示 -->
                    <div id="output-profile-photo">
                        <img id="profile-photo" src="" alt="User Photo" onclick="location.href='resister.html';">
                    </div>
                    <!-- プロフィール名表示 -->
                    <h5 id="output"></h5>
                </div>
            </ul>
        </nav>

        <script src="https://www.gstatic.com/firebasejs/9.22.0/firebase-app.js"></script>
        <script src="https://www.gstatic.com/firebasejs/9.22.0/firebase-storage.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

        <!-- プロフィールテキストの読み込みコード -->
        <script src="profile_textData_read.js" type="module"></script>

        <!-- プロフィール画像の読み込みコード -->
        <script src="profile_photoData_read.js" type="module"></script>

    </header>


    <main>

    <div class="modal-001__wrap">
  <input type="radio" id="modal-001__open" class="modal-001__open-input" name="modal-001__trigger"/>
  <label for="modal-001__open"  class="modal-001__open-label">-  ◀︎ 商品登録画面 ▶︎  -</label>
  <input type="radio" id="modal-001__close" name="modal-001__trigger"/>
  <div class="modal-001">
    <div class="modal-001__content-wrap">
      <label for="modal-001__close" class="modal-001__close-label">×</label>

      <!-- 以下input.phpファイルの内容をそのまま挿入 -->
      <!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="read.css">
</head>
 <body>
      <div class="modal-001__content">
      <form action="create.php" method="POST" enctype="multipart/form-data">
          <fieldset>
          <legend>アイテム情報入力</legend>
          <a href="read.php">一覧画面</a>
          <div>
              Item: <input type="text" name="item">
          </div>
          <div>
              Photo ①: <input type="file" name="photo_A" accept=".jpg,.jpeg,.png" required>
              Photo ②: <input type="file" name="photo_B" accept=".jpg,.jpeg,.png" required>
              Photo ③: <input type="file" name="photo_C" accept=".jpg,.jpeg,.png" required>
          </div>
          <div>
            Explanation: <textarea rows=5 name="explanation"></textarea>
          </div>
          <div>
            Price: <input type="input" name="price">
          </div>
            <div>
              <button type="submit">submit</button>
            </div>
          </fieldset>
        </form>
      </div>
</body>
      </html>
    <!-- ▲ここまで -->
    </div>
    <label for="modal-001__close">
      <div class="modal-001__background"></div>
    </label>
  </div>
</div>



    <div class='sort-container'>
      <a href="input.php" class='resister-item'></a>
      <div class='sort-conditions'>
        <!-- 高い順へのソートリンク -->
        <a href="read.php?sort=desc&field=price" class='sort-expensive'>▲価格の高い順</a>
        <!-- 安い順へのソートリンク -->
        <a href="read.php?sort=asc&field=price" class='sort-cheaper'>▽価格の安い順</a>
        <!-- 新しい順へのソートリンク -->
        <a href="read.php?sort=desc&field=uploaded_at" class='sort-new'>▲新しい順</a>
        <!-- 古い順へのソートリンク -->
        <a href="read.php?sort=asc&field=uploaded_at" class='sort-old'>▽古い順</a>
      </div>
    </div>

    <!-- 以下の空行は必要。sort-containerが入るため -->
    <br>
    <br>
    <br>

    <fieldset>
      <legend>Garage Sale !!</legend>
      <div class='item-contents-grid'>
        <section class='grid'>
            <!-- phpでタグ作って結果を表示させる書き方↓ -->
            <?= $output ?>
            
        </section>
      </div>
    </fieldset>


    <a href="chat.html"><button type="button" id="to-chat-space-button" class="to-chat-space-button">▶︎ To Chat Space</button></a>

</main>
</body>

<footer>
        <nav class="wrapper-footer">
            <ul class="menu-footer">
                <li><a href="#">初めての方へ</a></li>
                <li><a href="#">よくある質問</a></li>
                <li><a href="#">利用規約</a></li>
                <li><a href="#">特定商品取引法</a></li>
                <li><a href="#">プライバシーポリシー</a></li>
                <li><a href="#">お問い合わせ</a></li>
                <li><a href="#">会社概要</a></li>
            </ul>
        </nav>
        <h5 class="copy-rights">©️2023 xxx Co,.Ltd. All Rights Reserved</h5>
</footer>

</html>

