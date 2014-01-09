<?php

require_once '../vendor/autoload.php';
require_once '../helper/twig.php';
require_once '../entidades/Professor.class.php';
//r//equire_once('../model/query.php');
require_once('../helper/funcoes.php');
/*
require_once '../config/config.php';
require_once '../helper/database.php';
require_once '../model/pessoa.php';
require_once '../helper/Pessoa.class.php';*/
//require_once('../model/BD.class.php');
//require('../model/Query.php');	
//require('../model/conexao.php');	
//require('../model/execute.php');	
//	BD::conn();
//	$usuario = new Query();
//require_once '../helper/Validacao.class.php';
// incluir twig
// incluir model pessoa
// incluir classe de validacao

//banco
$conecta = mysql_connect("localhost", "root", "") or print (mysql_error()); 
mysql_select_db("Monitoria", $conecta) or print(mysql_error()); 			

$acao = isset($_GET['acao']) ? $_GET['acao'] : '';

$twig = twig('../view/');

$baseTemplate="edital/";

if ($acao == 'new') {  
	 
	echo $twig->render($baseTemplate.'new.twig');

	//echo $twig->render($baseTemplate. 'new.twig', array('name' => 'Professor'));


}else if ($acao == 'edit') {

$id = $_GET["idEdital"];
	
$sql = selecaoByID('edital','id_edital',$id);	

$result = mysql_query($sql, $conecta); 
 
if(!$result)
	    echo "<script>alert(\"Nenhum registro encontrado. Para criar um novo selecione `Novo Cadastro`\");</script>";       
else{

	while($consulta = mysql_fetch_array($result)) { 
		$editais[] = $consulta;
	}

echo $twig->render($baseTemplate.'edit.twig',
	array(
            'entities' => $editais,            
        ));
}
 
} else if ($acao == 'delete') {
		$idx=$_GET['idEdital'];
		
		$idS = "id_edital =".$idx;	
		
$sqlDeletar = deletar('edital',$idS);

echo $sqlDeletar;

$result = mysql_query($sqlDeletar, $conecta); 

		if(!mysql_error())
		{
			echo "<script>alert(\"Removido!\");</script>";    

			unset($_GET['acao']);
			unset($_GET['idProfessor']);
		}	
		else   	
			echo "<script>alert(\"Nenhum registro encontrado. Para criar um novo selecione `Novo Cadastro`\");</script>";       
		
		//echo $twig->render('index.php');
		echo ("<script>window.location.href = \"../controller/professor.php?acao=consult\";</script>");	
		
	//	}
	//	else
	//		echo "<script>alert(\"Não foi possível remover!\");</script>";       
	//
} else if ($acao == 'create') {
		//$senha2=$_POST['senha2'];
		$arquivo = $_FILES["arquivo"]["tmp_name"]; 
		$tipo    = $_FILES["arquivo"]["type"];
		$nome  = $_FILES["arquivo"]["name"];

		chdir('temp');

		echo $tipo;
		echo $nome;
		echo getcwd()."\\ultimo.pdf";

		move_uploaded_file($arquivo, getcwd()."\\ultimo.pdf");

		$pont = fopen(getcwd()."\\ultimo.pdf", "rb");

		$dados = addslashes(fread($pont, filesize(getcwd()."\\ultimo.pdf")));

		$sq = "INSERT INTO edital (arquivo,
		tipo,nome) VALUES('".$dados."', '".$tipo."','".$nome."')";
		
		echo $sq;
		
		$sql = mysql_query($sq,$conecta);

		

		//$relatorio = new relatorio($_POST);  


		if(!mysql_error())
		{					
			echo "<script>alert(\"Inserido! $mensagem\");</script>";       
			echo ("<script>window.location.href = \"../index.php\";</script>");	
		}
		else
			echo $twig->render($baseTemplate.'erro.twig', array('Erros' => 'Erro! Nao foi possivel inserir!'));
	
} else if ($acao == 'update') {		
		//$senha2=$_POST['senha2'];

	if ($_POST) {
	  foreach ($_POST as $key => $value) {
	    echo $key . ' = ' . $value . '<br />';
	  }
	}
		
	$id = $_POST['id'];
		
	$sqlUpdate = "UPDATE edital SET ";

	$arquivo = $_FILES["arquivo"]["tmp_name"]; 
	$tipo    = $_FILES["arquivo"]["type"];
	$nome  = $_FILES["arquivo"]["name"];

	chdir('temp');

	echo $tipo;
	echo $nome;
	echo getcwd()."\\ultimo.pdf";

	move_uploaded_file($arquivo, getcwd()."\\ultimo.pdf");

	$pont = fopen(getcwd()."\\ultimo.pdf", "rb");

	$dados = addslashes(fread($pont, filesize(getcwd()."\\ultimo.pdf")));

	$sq = "UPDATE edital SET arquivo ='".$dados."',
	tipo ='".$tipo."',nome ='".$nome."' where id_edital='".$id."'";
	
	echo $sq;
	
	$sql = mysql_query($sq,$conecta);	

	if(!mysql_error())
	{					
		echo "<script>alert(\"Editado! $mensagem\");</script>";       
		echo ("<script>window.location.href = \"../index.php\";</script>");	
	}
	else
		echo $twig->render($baseTemplate.'erro.twig', array('Erros' => 'Erro! Nao foi possivel inserir!'));

} else if ($acao == 'consult') {
	$sql = selecao("edital"); 
	$result = mysql_query($sql, $conecta); 
 
if(!$result)
	    echo "<script>alert(\"Nenhum registro encontrado. Para criar um novo selecione `Novo Cadastro`\");</script>";       
else{
	

	while($consulta = mysql_fetch_array($result)) { 
		$editais[] = $consulta;
		
	}

	echo $twig->render($baseTemplate.'consult.twig',
	array(
            'entities' => $editais,            
        ));

	}
}else if ($acao == 'download') {
	$id = $_GET['idEdital'];

	$sql = "SELECT * FROM edital WHERE id_edital=".$id;
	$download = mysql_query($sql,$conecta);
	$nome = mysql_result($download, 0, "nome");
	$tipo = mysql_result($download, 0, "tipo");
	$conteudo = mysql_result($download, 0, "arquivo");
	
	header('Content-Type: text/html; charset=utf-8'); 
	header('Content-Type: filesize($conteudo)');
	header('Content-Type: application/pdf');
	header("Content-Disposition: attachment; filename=$nome");
	print($conteudo);


//mysql_free_result($result); 
//mysql_close($conecta); 
}else {
	echo $twig->render('404.twig');
}

