<?php
// 入力項目のチェック
// var_dump($_POST);
// exit();

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

// DB接続
$pdo = connect_to_db();


//エラー時の処理
if (
    !isset($_POST['item']) || $_POST['item'] === '' ||
    !isset($_POST['explanation']) || $_POST['explanation'] === '' ||
    !isset($_POST['price']) || $_POST['price'] === '' 
) {
    exit('未記入/未選択の箇所があります。');
};

//変数の定義
$item = $_POST["item"];
$explanation = $_POST["explanation"];
$price = $_POST["price"];


// SQL実行  ******WHERE以下(WHERE id=:id')を書かないと全てに適応されてしまう******
$sql = 'UPDATE items_table SET item=:item, explanation=:explanation, price=:price, created_at=now(), uploaded_at=now(), WHERE id=:id';


$stmt = $pdo->prepare($sql);
$stmt->bindValue(':item', $item, PDO::PARAM_STR);
$stmt->bindValue(':explanation', $explanation, PDO::PARAM_STR);
$stmt->bindValue(':price', $price, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_STR);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

header('Location:item-read.php');
exit();




