<?php
$connect = mysql_connect('localhost','root','');
$db      = mysql_select_db('revenda');

if (isset($_POST['conectar']))
{
    $login = $_POST['login'];
    $senha = $_POST['senha'];

    $sql = mysql_query("select * from usuario where login='$login' and senha='$senha'");

    $resultado = mysql_num_rows($sql);

    if ($resultado == 0)
    {
        echo "login ou senha invalidos";
    }

    else
    {
        session_start();
        $_SESSION['login'] = $login;
        header("Location: menu.html");
    }
}
?>

<html>
<head>
    <title>Login Usuarios</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        form {
            width: 300px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        label {
            font-size: 16px;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border: none;
            border-radius: 3px;
            background-color: #007bff;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <form name='formulario' method='post' action='login.php'>
            <h2>Login de usuario</h2>
            <label>Login:</label>
            <input type='text' name='login' id='login' size=20 required>
            <br><br>
            <label>Senha:</label>
            <input type='password' name='senha' id='senha' size=20 required>
            <br><br>
            <input type='submit' value='Conectar' id='conectar' name='conectar'>
        </form>
    </div>
</body>
</html>
