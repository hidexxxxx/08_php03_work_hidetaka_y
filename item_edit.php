<?php


//DB接続
$dbn ='mysql:dbname=07_php02_work_items;charset=utf8mb4;port=3306;host=localhost';
$user = 'root';
$pwd = '';

try {
  return new PDO($dbn, $user, $pwd);
} catch (PDOException $e) {
  exit('dbError:'.$e->getMessage());
}

// var_dump($_GET);
// exit();

// id受け取り
$id = $_GET['id'];

// DB接続
$pdo = connect_to_db();

// SQL実行
$sql = 'SELECT * FROM items_table WHERE id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

$record = $stmt->fetch(PDO::FETCH_ASSOC);

// var_dump($record);
// exit();


?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DB連携型todoリスト（編集画面）</title>
</head>

<body>
  <form action="item_update.php" method="POST">
  <fieldset>
    <legend>DB連携型todoリスト（編集画面）</legend>
    <a href="item-read.php">一覧画面</a>
    <div>
      <input type="text" name="item" class="item" placeholder="*商品名を修正してください" value="<?= $record['item'] ?>">
    </div>
    <div>
      <textarea rows=5 name="explanation" class="explanation" placeholder="＊商品の説明を記入してください" value="<?= $record['explanation']?>"></textarea>
    </div>
    <div>
      <input type="input" name="price" class="price" placeholder="＊金額を記入して下さい(例：10000円の場合「10000」と記入)" value="<?= $record['price']?>">
    </div>
    <div>
      <input type="hidden" name="id" value="<?= $record['id'] ?>">
    </div>
    <div>
      <button>submit</button>
    </div>
  </fieldset>
</form>

</body>

</html>