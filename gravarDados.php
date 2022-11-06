<!doctype html> 
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Gravação de dados</title>
        <meta charset="UTF-8">
    </head>
    <body>
<?php
$nomeCompleto = $_POST["nomeCompleto"];
$email = $_POST["email"];
$telefone = $_POST["telefone"];
$dataNasc = $_POST["dataNasc"];
$estadoCivil = $_POST["estadoCivil"];
$sexo = $_POST["sexo"];
$dataAgendamento = $_POST["dataAgendamento"];
$horarioAgendamento = $_POST["horarioAgendamento"];
$doenca = 0; // valor padrão da variável
if (isset ($_POST["doenca"] ) )
{
$doenca = $_POST["doenca"] ; // atualiza a variável
}
$carteirinha = $_POST["carteirinha"];
$descricao = $_POST["descricao"];

// Arquivos de Foto
$fotoCarteirinha = $_FILES["fotoCarteirinha"] ["name"];
$tipoArquivoC = $_FILES["fotoCarteirinha"]["type"];
$tamanhoC = $_FILES["fotoCarteirinha"]["size"];
$nomeTmpC = $_FILES["fotoCarteirinha"]["tmp_name"];

$fotoRG = $_FILES["fotoRG"]["name"];
$tipoArquivoRG = $_FILES["fotoRG"]["type"];
$tamanhoRG = $_FILES["fotoRG"]["size"];
$nomeTmpRG = $_FILES["fotoRG"]["tmp_name"];

if ($nomeCompleto == "")
{
    die ("O nome do cliente deve ser informado!");
}

if ($email == "")
{
    die ("O e-mail do cliente  deve ser informado!");
}

if ($telefone == "")
{
    die ("O telefone do cliente deve ser informado!");
}

if ($carteirinha == "")
{
    die ("O número da carteirinha  deve ser informada!");
}

if ($descricao == "")
{
    die ("A descrição não pode estar vazia.");
}

echo "<h3> Gravando dados do cliente </h3>";
echo "Nome: $nomeCompleto <br>";
echo "E-mail: $email <br>";
echo "Telefone: $telefone <br>";
echo "Data do nascimento: $dataNasc <br>";
echo "Estado civil: $estadoCivil <br>";
echo "Sexo: $sexo <br> <hr>";
echo "<h3> Dados da consulta </h3>";
echo "Data do agendamento: $dataAgendamento <br>";
echo "Horário do agendamento: $horarioAgendamento <br>";
echo "Tem alguma doença crônica? $doenca <br>";
echo "Número da carteirinha: $carteirinha <br>";
echo "Descrição: $descricao <br>";
echo "<h3> Arquivos </h3>";
echo "fotoCarteirinha: $fotoCarteirinha <br>";
echo "FotoRG: $fotoRG<br>";

// Fazer conexão no MYSQL  
$con = mysqli_connect("localhost", "root","");
mysqli_set_charset($con, "utf8");
// Abrir o banco de dados ALUNO*****
mysqli_select_db($con, "ALUNO****") or
die("Erro na abertura do banco de dados:" .
mysqli_error($con) );

// Enviar o comando SQL Inclusão p/MYSQL
$sql = "INSERT INTO cadastro (
nomeCompleto,
email,
telefone,
dataNasc,
estadoCivil,
sexo,
dataAgendamento,
horarioAgendamento,
doenca,
fotoCarteirinha,
fotoRG,
carteirinha,
descricao
)
VALUES (
'$nomeCompleto',
'$email', 
'$telefone',
'$dataNasc',
'$estadoCivil',
'$sexo',
'$dataAgendamento',
'$horarioAgendamento',
'$doenca',
'$fotoCarteirinha',
'$fotoRG',
'$carteirinha',
'$descricao')";

// Visualizando o comando SQL criado
// die($sql);
// Enviar para o MYSQL
mysqli_query($con, $sql) or
die("Erro na inserção do cadastro: " .
mysqli_error($con) );

if ($fotoCarteirinha <> "")
{
    // transferir o arquivo temporário p/ imgs
    $destinoB = "arquivos\\$fotoCarteirinha";
    echo "Movendo arquivo de  $nomeTmpC para $destinoB";
    move_uploaded_file($nomeTmpC, $destinoB) or 
        die(
            "Falha na transferência do arquivo:" .
            $_FILES["fotoCarteirinha"]["error"]
        );
    // Consegui mover - vamos mostrar a imagem? Siiim
    echo "<br> <img src='$destinoB' width='150'> <br>"; 
}

if ($fotoRG <> "")
{
    // transferir o arquivo temporário p/ imgs
    $destinoA = "arquivos\\$fotoRG";
    echo "Movendo arquivo de  $nomeTmpRG para $destinoA";
    move_uploaded_file($nomeTmpRG, $destinoA) or 
        die(
            "Falha na transferência do arquivo:" .
            $_FILES["fotoRG"]["error"]
        );
    // Consegui mover - vamos mostrar a imagem? Siiim
    echo "<br> <img src='$destinoA' width='150'> <br>"; 
}

// Mostrar se deu certo (cadastrou) ou não
// Se chegou aqui é pq funcionou
echo "<hr>$nomeCompleto CADASTRADO COM SUCESSO! <hr>";
?>
CLIQUE<a href="cadastroDados.html">AQUI</a> PARA CADASTRAR UM NOVO PACIENTE!

</body>
</html>