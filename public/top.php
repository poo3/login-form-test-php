<?php 
require_once '../classes/UserLogic.php';

// セッションを利用するための記述
session_start();

// エラーメッセージ
$err = [];

// バリデーション
if(!$email = filter_input(INPUT_POST, 'email')){
  $err['email'] = 'メールアドレスを記入してください';
};
if(!$password = filter_input(INPUT_POST, 'password')){
  $err['password'] = 'パスワードを記入してください';
};

if (count($err) > 0){
  // エラーがあったらログインフォームへ戻す

  // $_SESSIONは連想配列で定義
  $_SESSION = $err;
  header('Location: login.php');
  return;
}

// ログイン成功時の処理
$result = UserLogic::login($email, $password);
// ログイン失敗した時の処理
if(!$result){
  header('Location: login.php');
  return;
}
echo 'ログイン成功です';


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ユーザー登録完了画面</title>
</head>
<body>
<?php if (count($err) > 0):?>
  <?php foreach($err as $e):?>
    <p><?php echo $e ?></p>
  <?php endforeach ?>
<?php else : ?>
  <p>ユーザ登録が完了しました</p>
<?php endif ?>
  <a href="./login.php">戻る</a>
</body>
</html>