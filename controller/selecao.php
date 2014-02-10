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

$baseTemplate="selecao/";

if(!$tipo = $_SESSION['tipo'])
	header('location:../login.php'); 

/****************************
*
*  New
*
****************************/

if ($acao == 'new') {
	$idProjeto = $_GET['idProjeto'];
	echo $twig->render($baseTemplate. 'new.twig', array('tipo' => $tipo,'idProjeto' => $idProjeto));//, 'editais' => $editais, 'relatorios' => $relatorios, 'selecoes' => $selecoes));

/****************************
*
*  Create
*
****************************/

} else if ($acao == 'create') {

	$idAluno = $_SESSION['id'];
	$idProjeto = $_POST['id'];
	$values = $_POST['listmultiple'];

	foreach($values as $v)
		$horarioAtendimento = $horarioAtendimento+$v;
	
	$quer = mysql_query("INSERT INTO selecao (`id_aluno`,`id_projeto`,`aprovado`,`horario_atendimento`) VALUES(".
		$idAluno.",".
		$idProjeto.",0,".
	    $horarioAtendimento.")");

	if(!mysql_error())
	{					
		echo "<script>alert(\"Inserido! $mensagem\");</script>";       
		echo ("<script>window.location.href = \"../index.php\";</script>");	
	}
	else
		echo $twig->render($baseTemplate.'erro.twig', array('Erros' => 'Erro! Nao foi possivel inserir!','tipo' => $tipo));

/****************************
*
*  Edit
*
****************************/

}else if ($acao == 'edit') {

	$id=$_GET['idSelecao'];
		
	$sql = selecaoByID('Selecao','id_selecao',$id);	
	$result = mysql_query($sql, $conecta); 
	
	if(!$result)
		    echo "<script>alert(\"Nenhum registro encontrado. Para criar um novo selecione `Novo Cadastro`\");</script>";       
	else{
		while($consulta = mysql_fetch_array($result)) { 
		$selecoes[] = $consulta;
	}
}

$values = $_POST['listmultiple'];

	//////edita professor
	/*$sql = selecao('Aluno');	
	$result = mysql_query($sql, $conecta); 

	if(!$result)
	    echo "<script>alert(\"Não existem alunos cadastrados. Para criar um novo selecione Professor->Novo\");</script>";       
	else{
		while($consulta = mysql_fetch_array($result)) { 
			$alunos[] = $consulta;
		}
	}*/

	/*$sql = selecao('Projetodemonitoria');	
	$result = mysql_query($sql, $conecta); 

	if(!$result)
	    echo "<script>alert(\"Não existem projetos cadastrados. Para criar um novo selecione Professor->Novo\");</script>";       
	else{
		while($consulta = mysql_fetch_array($result)) { 
			$projetos[] = $consulta;
		}
	*/
echo $twig->render($baseTemplate.'edit.twig',
	array(
            'entities' => $selecoes,
           // 'projetos' => $projetos,
           // 'alunos' => $alunos,
            'tipo' => $tipo,
        ));
 
} else if ($acao == 'delete') {
	$idx=$_GET['idSelecao'];
	$idS = "id_selecao =".$idx;	
	$sqlDeletar = deletar('Selecao',$idS);
	$result = mysql_query($sqlDeletar, $conecta); 

		if(!mysql_error())
		{
			echo "<script>alert(\"Removido!\");</script>";       
			unset($_GET['acao']);
			unset($_GET['idselecao']);
			echo ("<script>window.location.href = \"../index.php\";</script>");	
		}	
		else   	
			echo "<script>alert(\"Nenhum registro encontrado. Para criar um novo selecione `Novo Cadastro`\");</script>";       
		
		echo $twig->render('index.php',array('tipo' => $tipo));
		
	//	}
	//	else
	//		echo "<script>alert(\"Não foi possível remover!\");</script>";       
	//	

/****************************
*
*  Update
*
****************************/

} else if ($acao == 'update') {	
echo 98;
		$id = $_POST['id'];
		$selecaoalt = new selecao($_POST);  
			
		$sqlUpdate = "UPDATE selecao SET ";

$sqlUpdate .= "nota ='".$_POST['nota']."',";

$sqlUpdate = substr($sqlUpdate,0,-1);
		
$sqlUpdate .= " where id_selecao='".$id."'";

$quer = mysql_query($sqlUpdate);

if(!mysql_error())
{					
	echo "<script>alert(\"Editado! $mensagem\");</script>";       
	echo ("<script>window.location.href = \"../index.php\";</script>");	
}
else
	echo $twig->render($baseTemplate.'erro.twig', array('Erros' => 'Erro! Nao foi possivel inserir!','tipo' => $tipo));

/****************************
*
*  Consult
*
****************************/

} else if ($acao == 'consult') {
	if($tipo=='aluno')
		$sql = "Select * from aluno a, selecao s where email ='".$_SESSION['login']."' and s.id_aluno = a.id_aluno";
	elseif($tipo=='professor')
		$sql = "Select * from professor a, selecao s where email ='".$_SESSION['login']."' and s.id_professor = a.id_professor";
	elseif($tipo=='administrador')
		$sql = selecao("Selecao"); 
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
	$selecoes[] = $consulta;
}
echo $twig->render($baseTemplate.'consult.twig',
	array(
            'entities' => $selecoes,
            'tipo' => $tipo,
        ));
}

/****************************
*
*  Download
*
****************************/

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


/****************************
*
*  nota
*
****************************/

} else if ($acao == 'nota') { 
	if(($tipo=='administrador')||($tipo=='professor'))
	{
	$sql = "Select * from selecao where id_projeto=".$_GET['idProjeto']." order by nota";
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
	$selecoes[] = $consulta;
}
echo $twig->render($baseTemplate.'consultNotas.twig',
	array(
            'entities' => $selecoes,
            'tipo' => $tipo,
        ));
	}
}
/****************************
*
*  Erro
*
****************************/

}else {
	echo $twig->render('404.twig');
}

//mysql_free_result($result); 
//mysql_close($conecta); 


