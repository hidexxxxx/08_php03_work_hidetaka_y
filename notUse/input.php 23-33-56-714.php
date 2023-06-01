<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="input.css">
  <title>item画面（入力画面）</title>
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
  <form action="create.php" method="POST" enctype="multipart/form-data">
    <fieldset>
    <legend>商品情報入力</legend>
    <br>
    <a href="read.php" class="to-sold-items">◀︎出品商品画面▶︎</a>
    <br>
    <div>
        <input type="text" name="item" class="item" placeholder="＊商品名を記入してください">
    </div>
    <div>
        Photo ①: <input type="file" name="photo_A" accept=".jpg,.jpeg,.png" required>
        Photo ②: <input type="file" name="photo_B" accept=".jpg,.jpeg,.png" required>
        Photo ③: <input type="file" name="photo_C" accept=".jpg,.jpeg,.png" required>
    </div>
    <div>
        <textarea type="textarea" rows=5 name="explanation" class="explanation" placeholder="＊商品の説明を記入してください"></textarea>
    </div>
    <div>
        <input type="input" name="price"  class="price" placeholder="＊金額を記入して下さい(例：10000円の場合「10000」と入力)">
    </div>
    <div class="submit">
        <button class="submit-form">submit</button>
    </div>
    </fieldset>
  </form>

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