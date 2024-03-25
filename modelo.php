<?php
session_start();
$conectar = mysql_connect('localhost','root','');
$banco    = mysql_select_db('revenda');

if (isset($_POST['gravar']))
{
  $codigo   = $_POST['codigo'];
  $nome     = $_POST['nome'];
  $codmarca = $_POST['codmarca'];

  $sql = "INSERT INTO modelo(codigo,nome,codmarca)
          VALUES ('$codigo','$nome','$codmarca')";
          
  $resultado = mysql_query($sql);
  
  if ($resultado === TRUE)
  {
     echo 'Cadastro realizado com Sucesso';
  }
  else
  {
     echo 'Erro ao gravar dados.';
  }
}

if (isset($_POST['excluir']))
{
  $codigo = $_POST['codigo'];
  $nome   = $_POST['nome'];
  $codmarca = $_POST['codmarca'];

  $sql = "DELETE FROM modelo WHERE codigo = '$codigo'";
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
  $codmarca = $_POST['codmarca'];

  $sql = "UPDATE modelo SET nome='$nome'
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
   $sql = mysql_query("SELECT codigo,nome,codmarca FROM modelo");
   echo "<b>Modelos Cadastrados:</b><br><br>";
   while ($dados = mysql_fetch_object($sql))
	{
         echo "Codigo     : ".$dados->codigo."  ";
         echo "Nome       : ".$dados->nome." ";
         echo "Cod Marca  : ".$dados->codmarca."<br>";
	}
}
?>