<?php
if (isset($_POST['user'])) {
    $nome = $_POST['user'];
}

if (isset($_POST['pin'])) {
    $mensagem = $_POST['pin'];
}

if (isset($_POST['g-recaptcha-response'])) {
    $captcha_data = $_POST['g-recaptcha-response'];
}

// Se nenhum valor foi recebido, o usuário não realizou o captcha
if (!$captcha_data) {
    $msg = "Por favor, confirme o captcha.";
    exit($msg);
}
$chaveSecreta = '';
$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$chaveSecreta&response=".$captcha_data."&remoteip=".$_SERVER['REMOTE_ADDR']);
$responseData = json_decode($response, true);

if ($responseData["success"] == true) {
    $msg = "Formulário enviado com sucesso!";
} else {
    $msg = "Usuário mal intencionado detectado. Formulário não foi enviada.";
    exit($msg);
}
?>
<!DOCTYPE html><html lang="pt-br"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Response forms</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
<main>

<h1>Formulário + CAPTCHA</h1>
<h2>Response</h2>

<div>
   <?= $msg;?>

   <a class="botao" href="index.html">Voltar</a>
</div>

</main>
</body>
</html>
