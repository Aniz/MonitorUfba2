<?php

require_once '../vendor/autoload.php';
require_once '../helper/twig.php';
require_once '../entidades/Aluno.class.php';
require_once '../entidades/Projetodemonitoria.class.php';
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

$baseTemplate="projeto/";

if ($acao == 'new') {
$editais = array();
$professores = array();
$relatorios = array();
$selecoes = array();
//Professores
	$sql = selecao('Professor');	
	$result = mysql_query($sql, $conecta); 

	if(!$result)
	    echo "<script>alert(\"Não existem professores cadastrados. Para criar um novo selecione Professor->Novo\");</script>";       
	else{
		while($consulta = mysql_fetch_array($result)) { 
			$professores[] = $consulta;
		}
	}
/*	//Editais
	$sql = selecao('Edital');	
	$result = mysql_query($sql, $conecta); 

	if(!$result)
	    echo "<script>alert(\"Não existem editais cadastrados. Para criar um novo selecione Edital->Novo\");</script>";       
	else{
		while($consulta = mysql_fetch_array($result)) { 
			$editais[] = $consulta;
		}
	}
//Selecoes
	$sql = selecao('Selecao');	
	$result = mysql_query($sql, $conecta); 

	if(!$result)
	    echo "<script>alert(\"Não existem selecoes cadastrados. Para criar um novo selecione Selecao->Novo\");</script>";       
	else{
		while($consulta = mysql_fetch_array($result)) { 
			$editais[] = $consulta;
		}
	}
//Relatorios
	$sql = selecao('Relatorio');	
	$result = mysql_query($sql, $conecta); 

	if(!$result)
	    echo "<script>alert(\"Não existem relatorios cadastrados. Para criar um novo selecione Relatorio->Novo\");</script>";       
	else{
		while($consulta = mysql_fetch_array($result)) { 
			$editais[] = $consulta;
		}
	}*/
	echo $twig->render($baseTemplate. 'new.twig', array('professores' => $professores));//, 'editais' => $editais, 'relatorios' => $relatorios, 'selecoes' => $selecoes));

} else if ($acao == 'create') {

		$projeto = new Projetodemonitoria($_POST);  
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

			$dados=array($projeto->getResumo(),$projeto->getCpf(),$projeto->getEmail(),$projeto->getRg(),$projeto->getOrgaoEmissor(),
				$projeto->getSenha(),$projeto->getEndereco(),$projeto->getTelefone(),$projeto->getTipo(),$projeto->getMatricula(), 
				$projeto->getCurso(),$projeto->getAnoIngresso(),$projeto->getBanco(),$projeto->getAgencia(),$projeto->getCc(),$projeto->getHistorico());

$resumo = $projeto->getResumo();
if(!$resumo)
	$resumo = "";

$atividades = $projeto->getAtividades();
if(!$atividades)
	$atividades = "";

$bolsa = $projeto->getBolsa();
if(!$bolsa)
	$bolsa = 0;

$aprovado = $projeto->getAprovado();
if(!$aprovado)
	$aprovado = 0;

$vagasPedidas = $projeto->getVagasPedidas();
if(!$vagasPedidas)
	$vagasPedidas = 0;

$vagasAprovadas = $projeto->getVagasAprovadas();
if(!$vagasAprovadas)
	$vagasAprovadas = 0;

$chTotal = $projeto->getChTotal();
if(!$chTotal)
	$chTotal = 0;

$chSemanal = $projeto->getChSemanal();
if(!$chSemanal)
	$chSemanal = 0;

$periodoInscricaoInicio = $projeto->getPeriodoInscricaoInicio();
if(!$periodoInscricaoInicio)
	$periodoInscricaoInicio = null;

$periodoInscricaoFinal = $projeto->getPeriodoInscricaoFinal();
if(!$periodoInscricaoFinal)
	$periodoInscricaoFinal = null;

$periodoSelecao = $projeto->getPeriodoSelecao();
if(!$periodoSelecao)
	$periodoSelecao = null;

$id_professor = $projeto->getIdProfessor();
if(!$id_professor)
	$id_professor = 0;

/*echo "INSERT INTO 
projetoDeMonitoria VALUES('".
  $resumo."','".
    $atividades."','".
    $bolsa."','".
    $aprovado."','".
    $vagasPedidas."','".
    $vagasAprovadas."','".
    $chTotal."','".
    $chSemanal."','".
    $periodoInscricaoInicio."','".
    $periodoInscricaoFinal."','".
    $periodoSelecao."','".
    $id_professor."',null,null,null)";*/

echo $quer = mysql_query("INSERT INTO projetoDeMonitoria VALUES(null,'".
	$resumo."','".
    $atividades."','".
    $bolsa."','".
    $aprovado."','".
    $vagasPedidas."','".
    $vagasAprovadas."','".
    $chTotal."','".
    $chSemanal."','".
    $periodoInscricaoInicio."','".
    $periodoInscricaoFinal."','".
    $periodoSelecao."',null,null,null,'".
    $id_professor."')");


if(!mysql_error())
{					
	echo "<script>alert(\"Inserido! $mensagem\");</script>";       
	echo ("<script>window.location.href = \"../index.php\";</script>");	
}
else
	echo $twig->render($baseTemplate.'erro.twig', array('Erros' => 'Erro! Nao foi possivel inserir!'));


}else if ($acao == 'edit') {

$id=$_GET['idProjeto'];
	
$sql = selecaoByID('projetoDeMonitoria','id_projeto',$id);	
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

echo $twig->render($baseTemplate.'edit.twig',
	array(
            'entities' => $projetos,
            'professores' => $professores,
        ));
}}
 
} else if ($acao == 'delete') {
		$idx=$_GET['idProjeto'];
	
		$idS = "id_projeto =".$idx;	
		var_dump($idS);
echo $sqlDeletar = deletar('projetoDeMonitoria',$idS);

$result = mysql_query($sqlDeletar, $conecta); 

		if(!mysql_error())
		{
			echo "<script>alert(\"Removido!\");</script>";       
			unset($_GET['acao']);
			unset($_GET['idProjeto']);
		}	
		else   	
			echo "<script>alert(\"Nenhum registro encontrado. Para criar um novo selecione `Novo Cadastro`\");</script>";       
		
		echo $twig->render('index.php');
		
	//	}
	//	else
	//		echo "<script>alert(\"Não foi possível remover!\");</script>";       
	//	
} else if ($acao == 'update') {		
		//$senha2=$_POST['senha2'];
		$id = $_POST['id'];
		echo $id;
		$projetoalt = new Projetodemonitoria($_POST);  

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

echo $sqlUpdate .= " where id_projeto='".$id."'";
$quer = mysql_query($sqlUpdate);

if(!mysql_error())
{					
	echo "<script>alert(\"Editado! $mensagem\");</script>";       
	echo ("<script>window.location.href = \"../index.php\";</script>");	
}
else
	echo $twig->render($baseTemplate.'erro.twig', array('Erros' => 'Erro! Nao foi possivel inserir!'));







} else if ($acao == 'consult') {
	$sql = selecao("projetoDeMonitoria"); 
	$result = mysql_query($sql, $conecta); 
 
if(!$result)
	    echo "<script>alert(\"Nenhum registro encontrado. Para criar um novo selecione `Novo Cadastro`\");</script>";       
else{

	while($consulta = mysql_fetch_array($result)) { 
	$projetos[] = $consulta;
}
echo $twig->render($baseTemplate.'consult.twig',
	array(
            'entities' => $projetos,
        ));
}
//mysql_free_result($result); 
//mysql_close($conecta); 
}else {
	echo $twig->render('404.twig');
}

