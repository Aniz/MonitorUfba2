<?php

require_once '../vendor/autoload.php';
require_once '../helper/twig.php';
require_once '../entidades/Selecao.class.php';
require_once('../helper/funcoes.php');

$conecta = conectar();

$acao = isset($_GET['acao']) ? $_GET['acao'] : '';

$twig = twig('../view/');

$baseTemplate="selecao/";

/****************************
*
*  New
*
****************************/

if ($acao == 'new') {
$editais = array();
$professores = array();
$relatorios = array();
$selecoes = array();
//Professores
	$sql = selecao('Aluno');	
	$result = mysql_query($sql, $conecta); 

	if(!$result)
	    echo "<script>alert(\"Não existem professores cadastrados. Para criar um novo selecione Professor->Novo\");</script>";       
	else{
		while($consulta = mysql_fetch_array($result)) { 
			$alunos[] = $consulta;
		}
	}
	$sql = selecao('Projetodemonitoria');	
	$result = mysql_query($sql, $conecta); 

	if(!$result)
	    echo "<script>alert(\"Não existem professores cadastrados. Para criar um novo selecione Professor->Novo\");</script>";       
	else{
		while($consulta = mysql_fetch_array($result)) { 
			$projetos[] = $consulta;
		}
	}

	echo $twig->render($baseTemplate. 'new.twig', array('alunos' => $alunos, 'projetos'=>$projetos));//, 'editais' => $editais, 'relatorios' => $relatorios, 'selecoes' => $selecoes));

/****************************
*
*  Create
*
****************************/

} else if ($acao == 'create') {

		$selecao = new Selecao($_POST);  

$nota = $selecao->getNota();
if(!$nota)
	$nota = "";

$horarioAtendimento = $selecao->getHorarioAtendimento();
if(!$horarioAtendimento)
	$horarioAtendimento = "";

$idAluno = $selecao->getIdAluno();
if(!$idAluno)
	$idAluno = 0;

$idProjeto = $selecao->getIdProjeto();
if(!$idProjeto)
	$idProjeto = 0;

$aprovado = $selecao->getAprovado();
if(!$aprovado)
	$aprovado = 0;

echo $quer = mysql_query("INSERT INTO selecao VALUES(null,'".
	$nota."','".
    $idAluno."','".
	$idProjeto."','".  
  	$aprovado."','".
    $horarioAtendimento."')");


if(!mysql_error())
{					
	echo "<script>alert(\"Inserido! $mensagem\");</script>";       
	echo ("<script>window.location.href = \"../index.php\";</script>");	
}
else
	echo $twig->render($baseTemplate.'erro.twig', array('Erros' => 'Erro! Nao foi possivel inserir!'));

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
        ));

 
} else if ($acao == 'delete') {
		$idx=$_GET['idSelecao'];
	
		$idS = "id_selecao =".$idx;	
		var_dump($idS);
echo $sqlDeletar = deletar('Selecao',$idS);

$result = mysql_query($sqlDeletar, $conecta); 

		if(!mysql_error())
		{
			echo "<script>alert(\"Removido!\");</script>";       
			unset($_GET['acao']);
			unset($_GET['idselecao']);
		}	
		else   	
			echo "<script>alert(\"Nenhum registro encontrado. Para criar um novo selecione `Novo Cadastro`\");</script>";       
		
		echo $twig->render('index.php');
		
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
		$id = $_POST['id'];
		echo $id;
		$selecaoalt = new selecao($_POST);  
			
		$sqlUpdate = "UPDATE selecao SET ";

$sqlUpdate .= "vagas_pedidas ='".$selecaoalt->getVagasPedidas()."'";


if($selecaoalt->getAtividades())
	$sqlUpdate .= ", atividades ='".$selecaoalt->getAtividades()."'";

if($selecaoalt->getResumo())
	$sqlUpdate .= ", resumo ='".$selecaoalt->getResumo()."'";

if($selecaoalt->getBolsa())
	$sqlUpdate .= ", bolsa ='".$selecaoalt->getBolsa()."'";

if($selecaoalt->getAprovado())
	if($selecaoalt->getAprovado()=='on')
		$sqlUpdate .= ", aprovado = 1";
	else
		$sqlUpdate .= ", aprovado = 0";

if($selecaoalt->getVagasAprovadas())
	$sqlUpdate .= ", vagas_aprovadas ='".$selecaoalt->getVagasAprovadas()."'";

if($selecaoalt->getChTotal())
	$sqlUpdate .= ", ch_total ='".$selecaoalt->getChTotal()."'";

if($selecaoalt->getChSemanal())
	$sqlUpdate .= ", ch_semanal ='".$selecaoalt->getChSemanal()."'";

if($selecaoalt->getPeriodoInscricaoInicio())
	$sqlUpdate .= ", periodo_inscricao_inicio ='".$selecaoalt->getPeriodoInscricaoInicio()."'";

if($selecaoalt->getPeriodoInscricaoFinal())
	$sqlUpdate .= ", periodo_inscricao_final ='".$selecaoalt->getPeriodoInscricaoFinal()."'";

if($selecaoalt->getPeriodoSelecao())
	$sqlUpdate .= ", periodo_selecao ='".$selecaoalt->getPeriodoSelecao()."'";

if($selecaoalt->getIdProfessor())
	$sqlUpdate .= ", id_professor ='".$selecaoalt->getIdProfessor()."'";

if($selecaoalt->getIdSelecao())
	$sqlUpdate .= ", id_selecao ='".$selecaoalt->getIdSelecao()."'";

if($selecaoalt->getIdEdital())
	$sqlUpdate .= ", id_edital ='".$selecaoalt->getIdEdital()."'";

if($selecaoalt->getIdRelatorio())
	$sqlUpdate .= ", id_relatorio ='".$selecaoalt->getIdRelatorio()."'";

echo $sqlUpdate .= " where id_selecao='".$id."'";
$quer = mysql_query($sqlUpdate);

if(!mysql_error())
{					
	echo "<script>alert(\"Editado! $mensagem\");</script>";       
	echo ("<script>window.location.href = \"../index.php\";</script>");	
}
else
	echo $twig->render($baseTemplate.'erro.twig', array('Erros' => 'Erro! Nao foi possivel inserir!'));

/****************************
*
*  Consult
*
****************************/

} else if ($acao == 'consult') {
	$sql = selecao("Selecao"); 
	$result = mysql_query($sql, $conecta); 
 
if(!$result)
	    echo "<script>alert(\"Nenhum registro encontrado. Para criar um novo selecione `Novo Cadastro`\");</script>";       
else{

	while($consulta = mysql_fetch_array($result)) { 
	$selecoes[] = $consulta;
}

echo $twig->render($baseTemplate.'consult.twig',
	array(
            'entities' => $selecoes,
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
*  Erro
*
****************************/

}else {
	echo $twig->render('404.twig');
}

//mysql_free_result($result); 
//mysql_close($conecta); 


