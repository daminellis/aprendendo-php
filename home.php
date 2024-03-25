<?php
//conectar com banco de dados
$connect = mysqli_connect('localhost', 'root', '');
$db = mysqli_select_db($connect, 'revenda');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pesquisa Veiculos</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style type="text/css">
        body {
            text-align: center;
        }
        #container {
            display: inline-block;
            text-align: left;
        }
        input[type="submit"] {
            background-color: #428bca;
            color: #fff;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #5bc0de;
        }
        .form-control {
            display: block;
            width: 80%;
            height: 60px;
            padding: 6px 12px;
            font-size: 14px;
            line-height: 1.42857143;
            color: #555;
            background-color: #fff;
            background-image: none;
            border: 1px solid #ccc;
            border-radius: 4px;
            -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
            -webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
            -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
            transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
            margin-left: 35px;
        }
        label {
            display: inline-block;
            max-width: 100%;
            margin-bottom: 5px;
            font-weight: 700;
            margin-left: 35px;
        }
        .h1, h1 {
            font-size: 36px;
            margin-left: 35px;
        }
        #login-btn {
            position: absolute;
            top: 20px;
            right: 20px;
            width: 10%;
            height: 10%;
            border: 2px solid #ccc; /* Adiciona uma borda sólida de 2px com cor cinza */
            border-radius: 4px; /* Adiciona um arredondamento de borda de 4px */
            text-align: center;
            line-height: 60px;
        }
        #resultado-pesquisa {
            position: absolute;
            bottom: 20px;
            left: 20px;
            text-align: left;
        }
    </style>
</head>
<body>
    <a href="login.php" id="login-btn" class="btn btn-primary">Login</a>
    <div id="container">
        <form name="formulario" method="post" action="home.php">
            <img src="logo.jpg" width=200 height=200 align="center">
            <h1>REVENDA DE CARROS</h1><br>

            <h1>Pesquisa de Veiculos por:</h1>
            <label for="">Marcas: </label>
            <select name="marca" class="form-control">
                <option value="" selected="selected">Selecione...</option>
                <?php
                $query = mysqli_query($connect, "SELECT codigo, nome FROM marca");
                while ($marcas = mysqli_fetch_array($query)) {
                    ?>
                    <option value="<?php echo $marcas['codigo'] ?>">
                        <?php echo $marcas['nome'] ?></option>
                <?php }
                ?>
            </select>

            <br><br>

            <label for="">Modelos: </label>
            <select name="modelo" class="form-control">
                <option value="" selected="selected">Selecione...</option>
                <?php
                $query = mysqli_query($connect, "SELECT codigo, nome FROM modelo");
                while ($modelos = mysqli_fetch_array($query)) {
                    ?>
                    <option value="<?php echo $modelos['codigo'] ?>">
                        <?php echo $modelos['nome'] ?></option>
                <?php }
                ?>
          </select>
            <br><br>

            <input type="submit" name="pesquisar" value="Pesquisar" class="form-control">
        </form>
        <br><br>

        


    </div>
<?php


if (isset($_POST['pesquisar']))
{

//------- pesquisa marcas
$sql_marcas  = "SELECT * FROM marca ";
$pega_marcas = mysqli_query($connect,$sql_marcas);

//------- pesquisa modelos
$sql_modelos  = "SELECT * FROM modelo ";
$pega_modelos = mysqli_query($connect,$sql_modelos);


//-------- verificar as op  es selecionadas ou n o
$marca   = (empty($_POST['marca']))? 'null' : $_POST['marca'];
$modelo  = (empty($_POST['modelo']))? 'null' : $_POST['modelo'];


if (($marca <> 'null') and ($modelo == 'null'))
{
     $sql_veiculos       = "SELECT descricao, ano, cor, valor, foto1, foto2
                            FROM veiculo,marca,modelo
                            WHERE veiculo.codmodelo = modelo.codigo
                            and modelo.codmarca = marca.codigo
                            and marca.codigo = $marca ";
     $seleciona_veiculos = mysqli_query($connect,$sql_veiculos);
}

if (($modelo <> 'null') and ($marca == 'null'))
{
    $sql_veiculos = "SELECT descricao, ano, cor, valor, foto1, foto2
                    FROM veiculo, modelo
                    WHERE veiculo.codmodelo = modelo.codigo
                    and modelo.codigo = $modelo";
    $seleciona_veiculos = mysqli_query($connect,$sql_veiculos);
}

if (($modelo <> 'null') and ($marca <> 'null'))
{
    $sql_veiculos = "SELECT descricao, ano, cor, valor, foto1, foto2
                    FROM veiculo, modelo, marca
                    WHERE veiculo.codmodelo = modelo.codigo
                    and modelo.codmarca = marca.codigo
                    and marca.codigo = $marca
                    and modelo.codigo = $modelo";
    $seleciona_veiculos = mysqli_query($connect,$sql_veiculos);
}

if (($modelo == 'null') and ($marca == 'null'))
{
    $sql_veiculos = "SELECT descricao, ano, cor, valor, foto1, foto2
                    FROM veiculo";
    $seleciona_veiculos = mysqli_query($connect,$sql_veiculos);
}

if($seleciona_veiculos != TRUE)
{
   echo '<h1>Desculpe, mas sua busca nao retornou resultados ... </h1>';
}
else
{
   echo "Resultado da pesquisa de Veiculos: <br><br>";
   echo "<ul>";
   while ($dados = mysqli_fetch_object($seleciona_veiculos))
	{
         echo "Descricao    : ".$dados->descricao."<br>";
         echo "Ano          : ".$dados->ano." ";
         echo "Cor          : ".$dados->cor."<br>";
         echo "Valor        : ".$dados->valor."<br>";
         echo '<img src="fotos/'.$dados->foto1.'"height="200" width="200" />'."  ";
         echo '<img src="fotos/'.$dados->foto2.'"height="200" width="200" />'."<br><br>  ";
        }
}
}
?>

</body>

</HTML>