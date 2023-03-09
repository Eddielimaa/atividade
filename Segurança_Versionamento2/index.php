<?php

$obj_mysqli = new mysqli('127.0.0.1', 'root', '','joogo');

if ($obj_mysqli->connect_errno)
{
        echo 'Ocorreu um erro na conexão com o banco de dados.';
        exit;
}

mysqli_set_charset($obj_mysqli, 'utf8');

if(isset($_POST["nome"]) && isset($_POST["date"]) && isset($_POST["email"]) && isset($_POST["sexo"]) && isset($_POST["pais_origem"]))
{
    if(empty($_POST["nome"]))
        $erro = "Campo nome obrigatório";
    else
    if(empty($_POST["date"]))
        $erro = "Campo data obrigatório";
    else
    if(empty($_POST["email"]))
        $erro = "Campo email obrigatório";
    else
    if(empty($_POST["sexo"]))
        $erro = "Campo sexo obrigatório";
    else
    if(empty($_POST["pais_origem"]))
        $erro = "Campo pais de origem obrigatório";
    else
    {
        $nome = $_POST["nome"];
        $data_nasc = $_POST["date"];
        $email = $_POST["email"];
        $sexo = $_POST["sexo"];
        $pais_origem = $_POST["pais_origem"];

        $n = 5;
        function getName($n,$nome){
        $characters = '0123456789';
        $randomString = '';

        for($i = 0; $i < $n; $i++){
        $index = rand(0,strlen($characters) - 1);
        $randomString .= $characters[$index];

    }

    return $nome.$randomString;
}

$nickname = getName($n,$nome);

$numero_de_bytes = 4; // Bytes/Caracteres.
$resultado_bytes = random_bytes($numero_de_bytes);
//Gera os valores com 4 bytes/caracteres.
$s = bin2hex($resultado_bytes);




        $stmt = $obj_mysqli->prepare("INSERT INTO `tibia` (`nome`, `data_nasc`, `email`, `sexo`, `pais_origem`, `nome_login`, `senha`) VALUES (?, ?, ?, ?, ?, ?, ?)");

        $stmt->bind_param('sssssss', $nome, $data_nasc, $email, $sexo, $pais_origem, $nickname, $s);

        if(!$stmt->execute())
        {
            $erro = $stmt->error;
        }
        else
        {
            $sucesso = "dados cadastrados com sucesso!";
        }
    }

}

    $senha = 
    isset($_GET["senha"]) ?
    $_GET["senha"] : null;

    $nome = isset($_GET["nome"])
    ? $_GET["nome"] : null;

    $hash = password_hash($senha, PASSWORD_DEFAULT);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estiloo.css">
    <title>Aula 2</title>
</head>

<body>

<?php
if(isset($erro))
    echo '<div style="color:#F00">'.$erro.'</div><br/><br/>';

else
if(isset($sucesso))
    echo '<div style="color#00f>'.$sucesso.'</div><br/><br/>';

?>

<form action="<?=$_SERVER["PHP_SELF"]?>" method="POST">
<div class="box">
    <fieldset>
    <legend><b class="logo2">Formulário de Cadastro</b></legend>

    <br/>
    Nome(Nickname):<br/>           
	<input type="text" name="nome" placeholder="Qual seu nome?" required>
    <br/><br/>

    Data_Nascimento:<br/>  
	<input type="date" name="date" placeholder="Qual sua data de nasc?" required>
    <br/><br/>

    Email:<br/>
	<input type="text" name="email" placeholder="Qual seu email?" required>
    <br/><br/>

    Gênero:<br/>  
	<input type="text" name="sexo" placeholder="Qual seu gênero?" required>
    <br/><br/>

    País de Origem:<br/>  
	<input type="text" name="pais_origem" placeholder="Qual seu país de origem?" required>
    <br/><br/>

    <input type="hidden" value="-1" name="id" >
    <center><button type="submit">cadastrar</button><center>
</div>
</fieldset>

<!-- 
<div class="boxlogin">
<fieldset><legend><b class="logo2">Login</b></legend>
<br>
 -->

<!-- 

/* $n = 5;
function getName($n,$nome){
    $characters = '1';
    $randomString = '';

    for($i = 0; $i < $n; $i++){
        $index = rand(0,strlen($characters) - 1);
        $randomString .= $characters[$index];

    }

    return $nome.$randomString;
}

$numero_de_bytes = 4; // Bytes/Caracteres.
$resultado_bytes = random_bytes($numero_de_bytes);
//Gera os valores com 4 bytes/caracteres.
$s = bin2hex($resultado_bytes);

/* echo "Nome: ".getName($n,$nome)."<br>Senha: ".$s; */ 

-->

</div> -->
</form>
</body>
</html>