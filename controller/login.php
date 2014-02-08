<?php 
require_once '../vendor/autoload.php';
require_once '../helper/twig.php';
require_once('../helper/funcoes.php');

session_start(); 

$login = $_POST['login']; 
$senha = $_POST['senha']; 
$tipo = $_POST['tipo'];

$con = mysql_connect("127.0.0.1", "root", "") or die ("Sem conexão com o servidor");
$select = mysql_select_db("monitoria") or die("Sem acesso ao DB, Entre em contato com os Administradores Arlindo, Anna ou João vitor"); // A vriavel $result pega as varias $login e $senha, faz uma pesquisa na tabela de usuarios 

$result = mysql_query("SELECT * FROM $tipo WHERE email = '$login' AND SENHA = '$senha'"); 
//echo ("SELECT * FROM $tipo WHERE email = '$login' AND SENHA = '$senha'");
if(mysql_num_rows($result) > 0 ) { ; 

	$_SESSION['login'] = $login; 
	$_SESSION['senha'] = $senha; 
	$_SESSION['tipo'] = $tipo; 

	while($consulta = mysql_fetch_array($result)) { 
		if($consulta['admin']){
			$_SESSION['tipo'] = 'administrador';
			$tipo = 'administrador';
		}
	}
	$twig = twig('../view/');
	echo $twig->render('index.twig', array('tipo' => $tipo));
}
else{ 
	
	unset ($_SESSION['login']); 
	unset ($_SESSION['senha']); 
	unset ($_SESSION['tipo']); 
	header('location:../login.php'); 
} 

if(isset($_GET['acao']))
{
	unset ($_SESSION['login']); 
	unset ($_SESSION['senha']); 
	unset ($_SESSION['tipo']);
	header('location:../login.php'); 
}
?>
