<?php

require_once '../vendor/autoload.php';
require_once '../helper/twig.php';
require_once '../entidades/Aluno.class.php';
require_once '../entidades/Monitoria.class.php';
require_once('../helper/funcoes.php');

//banco
$conecta = conectar();

$acao = isset($_GET['acao']) ? $_GET['acao'] : '';

session_start(); 	
$tipo = $_SESSION['tipo'];
$idSection = $_SESSION['id'];
$twig = twig('../view/');

$baseTemplate="monitoria/";

if(!$tipo = $_SESSION['tipo'])
	header('location:../login.php'); 

	/****************************
	*
	*  New
	*
	****************************/

if ($acao == 'new') {
$aluno = array();
$professores = array();
//Professores

	if($tipo=='administrador')
		$sql = selecao('Professor');	
	elseif($tipo=='professor')
		$sql = "Select * from Professor where id_professor=".$idSection;	
	$result = mysql_query($sql, $conecta); 

	if(!$result)
	    echo "<script>alert(\"Não existem professores cadastrados. Para criar um novo selecione Professor->Novo\");</script>";       
	else{
		while($consulta = mysql_fetch_array($result)) { 
			$professor[] = $consulta;
		}

	}

	$sql = selecao('Professor');	
	$result = mysql_query($sql, $conecta); 

	if(!$result)
	    echo "<script>alert(\"Não existem professores cadastrados. Para criar um novo selecione Professor->Novo\");</script>";       
	else{
		while($consulta = mysql_fetch_array($result)) { 
			$professores[] = $consulta;
		}
	}

//Alunos
	$sql = "Select * from Aluno where id_aluno=".$_GET['idAluno'];	
	$result = mysql_query($sql, $conecta); 

	if(!$result)
	    echo "<script>alert(\"Não existem professores cadastrados. Para criar um novo selecione Professor->Novo\");</script>";       
	else{
		while($consulta = mysql_fetch_array($result)) { 
			$alunos[] = $consulta;
		}
	}

	echo $twig->render($baseTemplate. 'new.twig', array('professores' => $professores,'professor' => $professor, 'alunos' => $alunos,'tipo' => $tipo));//, 'editais' => $editais, 'relatorios' => $relatorios, 'selecoes' => $selecoes));

} else if ($acao == 'create') {
	$monitoria = new Monitoria($_POST);  
	var_dump($_POST);
	echo('passou');
	
	//	var_dump($projeto);
		/*	
		if(!empty($val))
		{
			foreach ($val as $erro) 
				echo $twig->render($baseTemplate.'erro.twig', array('Erros' => $erro));
    	}*/
	//	else 
	//			{	
//trocaPorID(&$post['id_relatorio']);		
		//echo $projeto->getResumo();
var_dump($monitoria);
$dataInicio = implode("-", array_reverse(explode("/", $monitoria->getDataInicio())));
if(!$dataInicio)
	$dataInicio = ''; 

$dataFim = implode("-", array_reverse(explode("/", $monitoria->getDataFimf())));
if(!$dataFim)
	$dataFim = '2014-06-01';

$semestre = $monitoria->getSemestre();
if(!$semestre)
	$semestre = "";

$status = $monitoria->getStatus();
if(!$status)
	$status = 0;

$bolsa = $monitoria->getBolsa();
if(!$bolsa)
	$bolsa = 0;

$unidade = $monitoria->getUnidade();
if(!$unidade)
	$unidade = 0;

$orgao = $monitoria->getOrgao();
if(!$orgao)
	$orgao = 0;
$componentesCurriculres = $monitoria->getComponentesCurriculres();
$componentesCurriculres = $_POST["componentesCurriculres"];
if(!$componentesCurriculres)
	$componentesCurriculres = 0;
//echo($componentesCurriculres);
$idProfessor = $monitoria->getIdProfessor();
if(!$idProfessor)
	$idProfessor = 0;

$idAluno = $monitoria->getIdAluno();
if(!$idAluno)
	$idAluno = 0;

$idProfessorOrientador = $monitoria->getIdProfessorOrientador();
if(!$idProfessorOrientador)
	$idProfessorOrientador = 0;

echo "INSERT INTO Monitoria VALUES(null,'".
	$dataInicio."','".
	$dataFim."','".
	$semestre."','".
	$status."','".
	$bolsa."',null,null,'".
	$unidade."','".
	$orgao."','".
	$componentesCurriculres."',null,'".
	$idProfessorOrientador."',null,null,'".
	$idAluno."','".
	$idProfessor."')";

echo $quer = mysql_query("INSERT INTO Monitoria VALUES(null,'".
	$dataInicio."','".
	$dataFim."','".
	$semestre."','".
	$status."','".
	$bolsa."',null,null,'".
	$unidade."','".
	$orgao."','".
	$componentesCurriculres."',null,'".
	$idProfessorOrientador."',null,null,'".
	$idAluno."','".
	$idProfessor."')");
//echo($componentesCurriculres);
//echo("---".$monitoria->getComponentesCurriculres());

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

$id=$_GET['idMonitoria'];
	
$sql = selecaoByID('Monitoria','id_monitoria',$id);	
$result = mysql_query($sql, $conecta); 
 
if(!$result)
	    echo "<script>alert(\"Nenhum registro encontrado. Para criar um novo selecione `Novo Cadastro`\");</script>";       
else{

	while($consulta = mysql_fetch_array($result)) { 
	$projetos[] = $consulta;
}
//////edita professor
	$sql = selecao('Professor');	
	$result = mysql_query($sql, $conecta); 

	if(!$result)
	    echo "<script>alert(\"Não existem professores cadastrados. Para criar um novo selecione Professor->Novo\");</script>";       
	else{
		while($consulta = mysql_fetch_array($result)) { 
			$professores[] = $consulta;
		}
}
//////edita professor
	$sql = selecao('Aluno');	
	$result = mysql_query($sql, $conecta); 

	if(!$result)
	    echo "<script>alert(\"Não existem professores cadastrados. Para criar um novo selecione Professor->Novo\");</script>";       
	else{
		while($consulta = mysql_fetch_array($result)) { 
			$alunos[] = $consulta;
		}


echo $twig->render($baseTemplate.'edit.twig',
	array(
            'entities' => $projetos,
            'professores' => $professores,
            'alunos' => $alunos,
            'tipo' => $tipo,
        ));
}}
 
} else if ($acao == 'delete') {
		$idx=$_GET['idMonitoria'];
		$idS = "id_monitoria =".$idx;	
 	
 		$sqlDeletar = deletar('Monitoria',$idS);

		$result = mysql_query($sqlDeletar, $conecta); 

		if(!mysql_error())
		{
			echo "<script>alert(\"Removido!\");</script>";       
			unset($_GET['acao']);
			unset($_GET['idProjeto']);
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
		//$senha2=$_POST['senha2'];
		$id = $_POST['id'];
		$projetoalt = new Monitoria($_POST);  

	//	$id = $alunoalt->getId();   
	 //  	var_dump($id);
	   	
	   	//$val = $alunoalt->ValidaUsuarioAlterado($senha2);//valida
		
		//if(!empty($val))
		//{
		//	foreach ($val as $erro) 
		//		echo $twig->render($baseTemplate.'erro.twig', array('Erros' => $erro));
    	//}
		//else 
		//		{				
		$sqlUpdate = "UPDATE Projetodemonitoria SET ";

$sqlUpdate .= "vagas_pedidas ='".$projetoalt->getVagasPedidas()."'";


if($projetoalt->getAtividades())
	$sqlUpdate .= ", atividades ='".$projetoalt->getAtividades()."'";

if($projetoalt->getResumo())
	$sqlUpdate .= ", resumo ='".$projetoalt->getResumo()."'";

if($projetoalt->getBolsa())
	$sqlUpdate .= ", bolsa ='".$projetoalt->getBolsa()."'";

if($projetoalt->getAprovado())
	if($projetoalt->getAprovado()=='on')
		$sqlUpdate .= ", aprovado = 1";
	else
		$sqlUpdate .= ", aprovado = 0";

if($projetoalt->getVagasAprovadas())
	$sqlUpdate .= ", vagas_aprovadas ='".$projetoalt->getVagasAprovadas()."'";

if($projetoalt->getChTotal())
	$sqlUpdate .= ", ch_total ='".$projetoalt->getChTotal()."'";

if($projetoalt->getChSemanal())
	$sqlUpdate .= ", ch_semanal ='".$projetoalt->getChSemanal()."'";

if($projetoalt->getPeriodoInscricaoInicio())
	$sqlUpdate .= ", periodo_inscricao_inicio ='".$projetoalt->getPeriodoInscricaoInicio()."'";

if($projetoalt->getPeriodoInscricaoFinal())
	$sqlUpdate .= ", periodo_inscricao_final ='".$projetoalt->getPeriodoInscricaoFinal()."'";

if($projetoalt->getPeriodoSelecao())
	$sqlUpdate .= ", periodo_selecao ='".$projetoalt->getPeriodoSelecao()."'";

if($projetoalt->getIdProfessor())
	$sqlUpdate .= ", id_professor ='".$projetoalt->getIdProfessor()."'";

if($projetoalt->getIdSelecao())
	$sqlUpdate .= ", id_selecao ='".$projetoalt->getIdSelecao()."'";

if($projetoalt->getIdEdital())
	$sqlUpdate .= ", id_edital ='".$projetoalt->getIdEdital()."'";

if($projetoalt->getIdRelatorio())
	$sqlUpdate .= ", id_relatorio ='".$projetoalt->getIdRelatorio()."'";

$sqlUpdate .= " where id_projeto='".$id."'";
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
		echo $sql = "Select * from aluno a, monitoria s where email ='".$_SESSION['login']."' and s.id_aluno = a.id_aluno";
	elseif($tipo=='professor')
		$sql = "Select * from professor a, monitoria s where email ='".$_SESSION['login']."' and s.id_professor = a.id_professor";
	elseif($tipo=='administrador')
		$sql = selecao("Monitoria"); 
	$result = mysql_query($sql, $conecta); 

	if(!mysql_num_rows($result) > 0 ) { 
		if($tipo=='aluno')
		    echo "<script>alert(\"Nenhum registro encontrado. Nenhuma monitoria ativa!\");</script>";       
		else
		    echo "<script>alert(\"Nenhum registro encontrado. Cadastre um novo projeto.\");</script>";       
		//echo ("<script>window.location.href = \"../index.php\";</script>");	
	}
	else{

	while($consulta = mysql_fetch_array($result)) { 
		$projetos[] = $consulta;
	}
echo $twig->render($baseTemplate.'consult.twig',
	array(
            'entities' => $projetos,
            'tipo' => $tipo,
        ));
}
//mysql_free_result($result); 
//mysql_close($conecta); 
}else {
	echo $twig->render('404.twig');
}

