<?php
session_start();
$conectar = mysql_connect('localhost','root','');
$banco    = mysql_select_db('revenda');

if (isset($_POST['gravar']))
{
    $codigo      = $_POST['codigo'];
    $descricao   = $_POST['descricao'];
    $codmodelo   = $_POST['codmodelo'];
    $ano         = $_POST['ano'];
    $cor         = $_POST['cor'];
    $placa       = $_POST['placa'];
    $opcionais   = $_POST['opcionais'];
    $valor       = $_POST['valor'];
    $foto1       = $_FILES['foto1'];
    $foto2       = $_FILES['foto2'];

    //criar pasta e mover arquivos img
    $diretorio = "fotos/";
    //converter os caracteres em string
    $extensao1 = strtolower(substr($_FILES['foto1']['name'], -4));
    //faz md5 para nao ter nomes repetidos nas fotos
    $novo_nome1 = md5(time().$extensao1);
    //mover o arquivo foto para a pasta FOTOS no computador
    move_uploaded_file($_FILES['foto1']['tmp_name'], $diretorio.$novo_nome1);

    //mesmo movimento de dados para foto2
    $extensao2 = strtolower(substr($_FILES['foto2']['name'], -6));
    $novo_nome2 = md5(time().$extensao2);
    move_uploaded_file($_FILES['foto2']['tmp_name'], $diretorio.$novo_nome2);

    $sql = "INSERT INTO veiculo (codigo,descricao,codmodelo,ano,cor,placa,opcionais,valor,foto1,foto2)
            VALUES  ('$codigo','$descricao','$codmodelo','$ano','$cor','$placa','$opcionais',
            '$valor','$novo_nome1','$novo_nome2')";

    $resultado = mysql_query($sql);
    
    if ($resultado === true)
    {
        echo 'Cadastro realizado com sucesso';
    } 
    else
    {
        echo 'Erro ao gravar os dados.';
    }
}

if (isset($_POST['excluir']))
{
    $codigo      = $_POST['codigo'];
    $descricao   = $_POST['descricao'];
    $codmodelo   = $_POST['codmodelo'];
    $ano         = $_POST['ano'];
    $cor         = $_POST['cor'];
    $placa       = $_POST['placa'];
    $opcionais   = $_POST['opcionais'];
    $valor       = $_POST['valor'];
    $foto1       = $_FILES['foto1'];
    $foto2       = $_FILES['foto2'];
    
    $sql = "DELETE FROM veiculo where codigo = '$codigo'";

    $resultado = mysql_query($sql);
    
    if ($resultado === true)
    {
        echo 'Exclusao realizada com sucesso';
    } 
    else
    {
        echo 'Erro ao excluir os dados.';
    }
}

if (isset($_POST['alterar']))
{
    $codigo      = $_POST['codigo'];
    $descricao   = $_POST['descricao'];
    $codmodelo   = $_POST['codmodelo'];
    $ano         = $_POST['ano'];
    $cor         = $_POST['cor'];
    $placa       = $_POST['placa'];
    $opcionais   = $_POST['opcionais'];
    $valor       = $_POST['valor'];

    $sql = "UPDATE veiculo SET
            descricao = '$descricao',
            codmodelo = '$codmodelo',
            ano       = '$ano',
            cor       = '$cor',
            placa     = '$placa',
            opcionais = '$opcionais',
            valor     = '$valor'
            WHERE codigo = '$codigo'";


    $resultado = mysql_query($sql);
    
    if ($resultado === true)
    {
        echo 'Alteracao realizada com sucesso';
    } 
    else
    {
        echo 'Erro ao atualizar os dados.';
    }
}

if (isset($_POST['pesquisar']))
{
   $sql = mysql_query("SELECT codigo,descricao,codmodelo,ano,cor,placa,opcionais,valor,foto1,foto2 FROM veiculo");
   
   echo "<b>Veiculos Cadastrados:</b><br><br>";
   while ($dados = mysql_fetch_object($sql))
	{
         echo "Codigo       : ".$dados->codigo." ";
         echo "Descricao    : ".$dados->descricao."<br>";
         echo "Cod Modelo   : ".$dados->codmodelo." ";
         echo "Ano          : ".$dados->ano." ";
         echo "Cor          : ".$dados->cor."<br>";
         echo "Opcionais    : ".$dados->opcionais." ";
         echo "Valor        : ".$dados->valor."<br>";
         echo '<img src="fotos/'.$dados->foto1.'"height="200" width="200" />'."  ";
         echo '<img src="fotos/'.$dados->foto2.'"height="200" width="200" />'."<br><br>  ";
        }
}
?>