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

$baseTemplate="administrador/";

/****************************
*
*  New
*
****************************/
if($tipo!='administrador')
	header('location:../index.php'); 

if ($acao == 'log') {

	$sql = selecao("log"); 
	$result = mysql_query($sql, $conecta); 
 
	if(!mysql_num_rows($result) > 0 ) { ; 
			echo "<script>alert(\"Não existe alteração)\");</script>";       
		echo ("<script>window.location.href = \"../index.php\";</script>");	
	}
	else{

		while($consulta = mysql_fetch_array($result)) { 
		$logs[] = $consulta;
		}
}
	echo $twig->render($baseTemplate.'log.twig',
	array(
            'entities' => $logs,
            'tipo' => $tipo,
        ));
/****************************
*
*  Consult
*
****************************/

} else if ($acao == 'permissoes') {
	$sql = selecao("Professor"); 
	$result = mysql_query($sql, $conecta); 
 
	if(!mysql_num_rows($result) > 0 ) { ; 
		if($tipo=='aluno')
			echo "<script>alert(\"Nenhum registro encontrado. Increva-se! :)\");</script>";       
		else
		    echo "<script>alert(\"Nenhum registro encontrado. Cadastre um novo projeto.\");</script>";       
		echo ("<script>window.location.href = \"../index.php\";</script>");	
	}
	else{

	while($consulta = mysql_fetch_array($result)) { 
	$professores[] = $consulta;
}
echo $twig->render($baseTemplate.'permissoes.twig',
	array(
            'entities' => $professores,
            'tipo' => $tipo,
        ));
}


} else if ($acao == 'permissao') {

	if($_GET['admin'])
		$sql = "Update professor set admin = 1 where id_professor=".$_GET['idProfessor']; 
	else
		$sql = "Update professor set admin = 0 where id_professor=".$_GET['idProfessor']; 
	
	$result = mysql_query($sql, $conecta); 
 
	if(!mysql_error()) { ; 
		echo "<script>alert(\"Pronto! registro encontrado. Cadastre um novo projeto.\");</script>";       
		echo ("<script>window.location.href = \"../index.php\";</script>");	
	}
	else{
	echo "<script>alert(\"Ops! Algo está errado.\");</script>";       
	
	}
}else if ($acao == 'relatorio') {
	$sql = selecao("vrelatorio"); 
	$result = mysql_query($sql, $conecta); 
 
	if(!mysql_num_rows($result) > 0 ) { ; 
		echo "<script>alert(\"Nenhum registro encontrado. \");</script>";       
		echo ("<script>window.location.href = \"../index.php\";</script>");	
	}
	else{

		while($consulta = mysql_fetch_array($result)) { 
			$relatorio[] = $consulta;
		}
		//var_dump($relatorio);
		echo $twig->render($baseTemplate.'relatorio.twig',
		array(
	            'entities' => $relatorio,
	            'tipo' => $tipo,
	        ));
	}
}


