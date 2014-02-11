<?php 

require_once '../vendor/autoload.php';
require_once '../helper/twig.php';
require_once '../entidades/Selecao.class.php';
require_once('../helper/funcoes.php');

$conecta = conectar();

$acao = isset($_GET['acao']) ? $_GET['acao'] : '';

session_start(); 	
$tipo = $_SESSION['tipo'];
$twig = twig('../view/');

$baseTemplate="";

if(!$tipo = $_SESSION['tipo'])
	header('location:../login.php'); 

/****************************
*
*  New
*
****************************/

echo $twig->render($baseTemplate. 'index.twig', array('tipo' => $tipo));