<?php

require_once '../vendor/autoload.php';
require_once '../helper/twig.php';
require_once '../entidades/Departamento.class.php';
require_once('../helper/funcoes.php');


//banco
$conecta = conectar();
$acao = isset($_GET['acao']) ? $_GET['acao'] : '';
session_start(); 	
$tipo = $_SESSION['tipo'];

$twig = twig('../view/');

$baseTemplate="departamento/";

if(!$tipo = $_SESSION['tipo'])
	header('location:../login.php'); 

if ($acao == 'new') {

$professores = array();	
$sql = selecao('Professor');

$result = mysql_query($sql, $conecta); 
 
if(!$result)
	    echo "<script>alert(\"Nenhum registro encontrado. Para criar um novo selecione `Novo Cadastro`\");</script>";       
else{

	while($consulta = mysql_fetch_array($result)) { 
	$professores[] = $consulta;
}


	echo $twig->render($baseTemplate. 'new.twig', array('professores' => $professores, 'tipo' => $tipo));
}
}else if ($acao == 'edit') {

$id = $_GET["idDepartamento"];	

$sql = selecao('Professor');	
$result = mysql_query($sql, $conecta); 
if($result){
	while($consulta = mysql_fetch_array($result)) { 
	$professores[] = $consulta;
}
}
$sql = selecaoByID('Departamento','id_Departamento',$id);	
$result = mysql_query($sql, $conecta); 
if(!$result)
	    echo "<script>alert(\"Nenhum registro encontrado. Para criar um novo selecione `Novo Cadastro`\");</script>";       
else{
	while($consulta = mysql_fetch_array($result)) { 
	$Departamentos[] = $consulta;
}

echo $twig->render($baseTemplate.'edit.twig',
	array(
            'entities' => $Departamentos, 'professores'=> $professores, 'tipo' => $tipo,
        ));
}
 
} else if ($acao == 'delete') {
		$idx=$_GET['idDepartamento'];
		
		$idS = "id_departamento =".$idx;	
		
$sqlDeletar = deletar('Departamento',$idS);

$result = mysql_query($sqlDeletar, $conecta); 

		if(!mysql_error())
		{
			echo "<script>alert(\"Removido!\");</script>";    

			unset($_GET['acao']);
			unset($_GET['idDepartamento']);
		}	
		else   	
			echo "<script>alert(\"Para deletar esse registro ele nao pode estar associado a nenhum professor`\");</script>";       
		
		echo ("<script>window.location.href = \"../controller/Departamento.php?acao=consult\";</script>");	
		
} else if ($acao == 'create') {
	
	$departamento = new Departamento($_POST);   

$nome = $departamento->getNome();
if(!$nome)
	$nome = "";

$chefe = $departamento->getChefe();
if(!$chefe)
	$chefe = "";


/*echo "INSERT INTO 
Departamento VALUES(null,'".
	$nome."','".
	$chefe."')";*/

$quer = mysql_query("INSERT INTO Departamento VALUES(null,'".
	$chefe."','".
	$nome."')");

if(!mysql_error())
{					
	echo "<script>alert(\"Inserido! $mensagem\");</script>";       
	echo ("<script>window.location.href = \"../index.php\";</script>");	
}
else
	echo $twig->render($baseTemplate.'erro.twig', array('Erros' => 'Erro! Nao foi possivel inserir!', 'tipo' => $tipo,));
	
} else if ($acao == 'update') {		
	/*if ($_POST) {
	  foreach ($_POST as $key => $value) {
	    echo $key . ' = ' . $value . '<br />';
	  }
	}*/
		$Departamentoalt = new Departamento($_POST);   	
		$sqlUpdate = "UPDATE Departamento SET ";

$sqlUpdate .= "nome ='".$Departamentoalt->getNome()."'" ;

$sqlUpdate .= ", chefe ='".$Departamentoalt->getChefe()."'" ;

$id = $_POST['id'];
echo $sqlUpdate .= "where id_departamento=".$id;
$quer = mysql_query($sqlUpdate);
if(!mysql_error())
{					
	echo "<script>alert(\"Editado! $mensagem\");</script>";       
	echo ("<script>window.location.href = \"../index.php\";</script>");	
}
else
	echo $twig->render($baseTemplate.'erro.twig', array('Erros' => 'Erro! Nao foi possivel inserir!', 'tipo' => $tipo));


} else if ($acao == 'consult') {
	$sql = selecao("Departamento"); 
	$result = mysql_query($sql, $conecta); 
 
if(!$result)
	    echo "<script>alert(\"Nenhum registro encontrado. Para criar um novo selecione `Novo Cadastro`\");</script>";       
else{

	while($consulta = mysql_fetch_array($result)) { 
		$Departamentos[] = $consulta;
	}
	
echo $twig->render($baseTemplate.'consult.twig',
	array(
            'entities' => $Departamentos,
            'tipo' => $tipo,
        ));
}
}else {
	echo $twig->render('404.twig');
}


