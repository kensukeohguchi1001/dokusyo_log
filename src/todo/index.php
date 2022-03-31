<?php
// 初期化
$todo = '';
$mysqliMessage = '';
$connectMessage = '';
$closeMessage = '';

// 登録
if (!empty($_POST['todo'])) {
  $todo = $_POST['todo'];

  $sql = <<< EOT
  INSERT INTO test (
    todo
    ) VALUES (
      '$todo'
    )
  EOT;
  $link = mysqli_connect('db', 'book_log', 'pass', 'book_log');

  if (!$link) {
    $connectMessage = 'データベースの接続に失敗しました<br />';
    exit;
  } else {
    $connectMessage = 'データベースの接続に成功しました<br />';
    $result = mysqli_query($link, $sql);
    if (!$result) {
      $mysqliMessage = 'データの登録に失敗しました<br />';
    } else {
      $mysqliMessage = 'データの登録に成功しました<br />';
    }
  }

  mysqli_close($link);
  // echo 'データベースの接続を切断しました<br />';
}

// 表示処理
$link = mysqli_connect('db', 'book_log', 'pass', 'book_log');
$sql = 'SELECT todo, created_at FROM test;';
$results = mysqli_query($link, $sql);

while ($todoList = mysqli_fetch_assoc($results)) {
  echo $todoList['todo'] . "<br />";
}

mysqli_close($link);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>todoリスト</title>
  <style>
    ul {
      list-style: none;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="title">
      <h1>TODOリスト</h1>
    </div>
    <div class="todoRegister">
      <form action="#" method="POST">
        <input type="text" name="todo">
        <button type="submit" name="" value="">送信</button>
        <?php if (isset($connectMessage)) : ?>
          <p><?php echo $connectMessage ?></p>
        <?php endif; ?>

        <?php if (isset($mysqliMessage)) : ?>
          <p><?php echo $mysqliMessage ?></p>
        <?php endif; ?>
      </form>
    </div>
    <div class="todoList">
      <ul>
        <?php while ($todoList = mysqli_fetch_assoc($results)) : ?>
          <li><?php var_dump($todoList) ?></li>
        <?php endwhile; ?>
      </ul>
    </div>
  </div>
</body>

</html>
