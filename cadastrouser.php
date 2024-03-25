<?php
//conectar com o servidor e banco
$conectar = mysql_connect('localhost','root','');
$banco    = mysql_select_db("revenda");

if (isset($_POST['cadastrar']))
{
    $codigo = $_POST['codigo'];
    $nome   = $_POST['nome'];
    $login  = $_POST['login'];
    $senha  = $_POST['senha'];

//PARA CONHECIMENTO, CRIPTOGRAFIA DE SENHA
// $senha = md5 ($_POST['senha']);

$sql = mysql_query("INSERT INTO usuario (codigo,nome,login,senha)
                values ('$codigo','$nome','$login','$senha')");

$resultado = mysql_query($sql);

if ($resultado)
        {echo " Falha ao gravar os dados informados";}
else
        {echo " Dados informados cadastrados com sucesso";}
}

if (isset($_POST['excluir']))
{
    $codigo = $_POST['codigo'];
    $nome   = $_POST['nome'];
    $login  = $_POST['login'];
    $senha  = $_POST['senha'];

  $sql = "DELETE FROM usuario WHERE codigo = '$codigo'";

  $resultado = mysql_query($sql);

  if ($resultado === TRUE)
  {
     echo 'Exclusão realizada com Sucesso';
  }
  else
  {
     echo 'Erro ao excluir dados.';
  }
}

if (isset($_POST['alterar']))
{
    $codigo = $_POST['codigo'];
    $nome   = $_POST['nome'];
    $login  = $_POST['login'];
    $senha  = $_POST['senha'];

  $sql = "UPDATE usuario SET nome='$nome',senha='$senha'
          WHERE codigo = '$codigo'";
  $resultado = mysql_query($sql);

  if ($resultado === TRUE)
  {
     echo 'Dados alterados com Sucesso';
  }
  else
  {
     echo 'Erro ao alterar dados.';
  }
}

if (isset($_POST['pesquisar']))
{
   $sql = mysql_query("SELECT codigo,nome,login FROM usuario");
   
   if (mysql_num_rows($sql) == 0)
         {echo "Desculpe, mas sua pesquisa não retornou resultados.";}
   else
        {
        echo "<b>Usuarios Cadastrados:</b><br><br>";
        while ($resultado = mysql_fetch_array($sql))
 	        {
            echo "Codigo     : ".utf8_decode($resultado['codigo'])."<br>".
                 "Nome       : ".utf8_decode($resultado['nome'])."<br>".
                 "Login      : ".utf8_decode($resultado['login'])."<br><br>";
            }  
        }
}
?>