<?php
$todo = $_POST['todo'];

if (!empty($todo)) {
  $sql = <<< EOT
  INSERT INTO test (
    todo
    ) VALUES (
      '$todo'
    )
  EOT;
  $link = mysqli_connect('db', 'book_log', 'pass', 'book_log');
  if (!$link) {
    echo 'データベースの接続に失敗しました';
    exit;
  } else {
    echo 'データベースの接続に成功しました';
    $result = mysqli_query($link, $sql);
  }

  mysqli_close($link);
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>todoリスト</title>
</head>

<body>
  <div class="container">
    <div class="title">
      <h1>TODOリスト</h1>
    </div>
    <form action="#" method="POST">
      <input type="text" name="todo">
      <button type="submit">送信</button>
    </form>
  </div>
</body>

</html>
