<?php

require_once '../vendor/autoload.php';
require_once '../helper/twig.php';
require_once '../entidades/Edital.class.php';
require_once('../helper/funcoes.php');


//banco
$conecta = conectar();
$acao = isset($_GET['acao']) ? $_GET['acao'] : '';

$twig = twig('../view/');

$baseTemplate="edital/";

if ($acao == 'new') {  
 
	echo $twig->render($baseTemplate.'new.twig');

	//echo $twig->render($baseTemplate. 'new.twig', array('name' => 'Professor'));


}else if ($acao == 'newProjeto') {  

	$idProjeto = $_GET['idProjeto'];
 	echo $_GET['idProjeto'];
	echo $twig->render($baseTemplate.'newEP.twig', 
		array(
			'entity' => $idProjeto,
			));

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
			unset($_GET['idEdital']);
		}	
		else   	
			echo "<script>alert(\"Nenhum registro encontrado. Para criar um novo selecione `Novo Cadastro`\");</script>";       
		
		//echo $twig->render('index.php');
		echo ("<script>window.location.href = \"../controller/edital.php?acao=consult\";</script>");	
		
	//	}
	//	else
	//		echo "<script>alert(\"Não foi possível remover!\");</script>";       
	//
} else if ($acao == 'create') {
		//$senha2=$_POST['senha2'];
		$arquivo = $_FILES["arquivo"]["tmp_name"]; 
		$tipo    = $_FILES["arquivo"]["type"];
		$nome  = $_FILES["arquivo"]["name"];

		$pub = $_POST['publicacao'];

		chdir('temp');

		echo $tipo;
		echo $nome;
		echo getcwd()."\\ultimo.pdf";

		move_uploaded_file($arquivo, getcwd()."\\ultimo.pdf");

		$pont = fopen(getcwd()."\\ultimo.pdf", "rb");

		$dados = addslashes(fread($pont, filesize(getcwd()."\\ultimo.pdf")));

		$sq = "INSERT INTO edital (arquivo,
		tipo,nome,publicacao) VALUES('".$dados."', '".$tipo."','".$nome."','".$pub."')";
		


		//echo $_POST['id'];
		
		$sql = mysql_query($sq,$conecta);

		
		if($_POST['id']){

			$idx = $_POST['id'];
			$sq1 =  "SELECT MAX(id_edital) as id FROM edital";
			$sql2 = mysql_query($sq1,$conecta);
			//$idxd = explode('#', $sql2);

			while($consulta = mysql_fetch_array($sql2)) { 
				$editais[] = $consulta;
		
			}
			
			$sql_tab1 ="UPDATE projetodemonitoria SET id_edital ='".$editais[0]['id']."' where id_projeto='".$idx."'";
			echo $sql_tab1;
			$sql2 = mysql_query($sql_tab1,$conecta);
			
		}

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
	$publicacao = $_POST['publicacao'];
		
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
	tipo ='".$tipo."',nome ='".$nome."',publicacao ='".$publicacao."' where id_edital='".$id."'";
	
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

