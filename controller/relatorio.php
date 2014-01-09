<?php

require_once '../vendor/autoload.php';
require_once '../helper/twig.php';
require_once '../entidades/Relatorio.class.php';
require_once('../helper/funcoes.php');

$conecta = conectar();

$acao = isset($_GET['acao']) ? $_GET['acao'] : '';

$twig = twig('../view/');

$baseTemplate="relatorio/";

if ($acao == 'new') {  
	 
	echo $twig->render($baseTemplate.'new.twig');

	//echo $twig->render($baseTemplate. 'new.twig', array('name' => 'Professor'));


}else if ($acao == 'edit') {

$id = $_GET["idRelatorio"];
	
$sql = selecaoByID('relatorio','id_relatorio',$id);	

$result = mysql_query($sql, $conecta); 
 
if(!$result)
	    echo "<script>alert(\"Nenhum registro encontrado. Para criar um novo selecione `Novo Cadastro`\");</script>";       
else{

	while($consulta = mysql_fetch_array($result)) { 
		$relatorios[] = $consulta;
	}

echo $twig->render($baseTemplate.'edit.twig',
	array(
            'entities' => $relatorios,            
        ));
}
 
} else if ($acao == 'delete') {
		$idx=$_GET['idRelatorio'];
		
		$idS = "id_relatorio =".$idx;	
		
$sqlDeletar = deletar('relatorio',$idS);

echo $sqlDeletar;

$result = mysql_query($sqlDeletar, $conecta); 

		if(!mysql_error())
		{
			echo "<script>alert(\"Removido!\");</script>";    

			unset($_GET['acao']);
			unset($_GET['idRelatorio']);
		}	
		else   	
			echo "<script>alert(\"Nenhum registro encontrado. Para criar um novo selecione `Novo Cadastro`\");</script>";       
		
		//echo $twig->render('index.php');
		echo ("<script>window.location.href = \"../controller/relatorio.php?acao=consult\";</script>");	
		
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

		$sq = "INSERT INTO relatorio (arquivo,
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
		
	$sqlUpdate = "UPDATE relatorio SET ";

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

	$sq = "UPDATE relatorio SET arquivo ='".$dados."',
	tipo ='".$tipo."',nome ='".$nome."' where id_relatorio='".$id."'";
	
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
	$sql = selecao("relatorio"); 
	$result = mysql_query($sql, $conecta); 
 
if(!$result)
	    echo "<script>alert(\"Nenhum registro encontrado. Para criar um novo selecione `Novo Cadastro`\");</script>";       
else{
	

	while($consulta = mysql_fetch_array($result)) { 
		$relatorios[] = $consulta;
		
	}

	echo $twig->render($baseTemplate.'consult.twig',
	array(
            'entities' => $relatorios,            
        ));

	}
}else if ($acao == 'download') {
	$id = $_GET['idRelatorio'];

	$sql = "SELECT * FROM relatorio WHERE id_relatorio=".$id;
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

