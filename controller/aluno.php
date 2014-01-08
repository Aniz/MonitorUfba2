<?php

require_once '../vendor/autoload.php';
require_once '../helper/twig.php';
require_once '../entidades/Aluno.class.php';
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

$baseTemplate="aluno/";

if ($acao == 'new') {
	echo $twig->render($baseTemplate. 'new.twig', array('name' => 'Aluno'));


}else if ($acao == 'edit') {

$id = $_GET["idAluno"];
	
$sql = selecaoByID('Aluno','id_aluno',$id);	

//echo $sql;

$result = mysql_query($sql, $conecta); 
 
if(!$result)
	    echo "<script>alert(\"Nenhum registro encontrado. Para criar um novo selecione `Novo Cadastro`\");</script>";       
else{

	while($consulta = mysql_fetch_array($result)) { 
	$alunos[] = $consulta;
}

//	var_dump($alunos);
echo $twig->render($baseTemplate.'edit.twig',
	array(
            'entities' => $alunos,
        ));
}
 
} else if ($acao == 'delete') {
		$idx=$_GET['idAluno'];
		
		$idS = "id_aluno =".$idx;	
		
$sqlDeletar = deletar('aluno',$idS);

echo $sqlDeletar;

$result = mysql_query($sqlDeletar, $conecta); 

		if(!mysql_error())
		{
			echo "<script>alert(\"Removido!\");</script>";    

			unset($_GET['acao']);
			unset($_GET['idAluno']);
		}	
		else   	
			echo "<script>alert(\"Nenhum registro encontrado. Para criar um novo selecione `Novo Cadastro`\");</script>";       
		
		//echo $twig->render('index.php');
		echo ("<script>window.location.href = \"../controller/aluno.php?acao=consult\";</script>");	
		
	//	}
	//	else
	//		echo "<script>alert(\"Não foi possível remover!\");</script>";       
	//
} else if ($acao == 'create') {
		$senha2=$_POST['senha2'];
		$aluno = new Aluno($_POST);   	

	  	/*$val = $aluno->ValidaUsuario($senha2);//valida
		
		if(!empty($val))
		{
			foreach ($val as $erro) 
				echo $twig->render($baseTemplate.'erro.twig', array('Erros' => $erro));
    	}*/
	//	else 
	//			{			
		echo $aluno->getNome();

			$dados=array($aluno->getNome(),$aluno->getCpf(),$aluno->getEmail(),$aluno->getRg(),$aluno->getOrgaoEmissor(),
				$aluno->getSenha(),$aluno->getEndereco(),$aluno->getTelefone(),$aluno->getTipo(),$aluno->getMatricula(), 
				$aluno->getCurso(),$aluno->getAnoIngresso(),$aluno->getBanco(),$aluno->getAgencia(),$aluno->getCc(),$aluno->getHistorico());

if(!$aluno->getNome())
	$nome = "";
else
	$nome = $aluno->getNome();

if(!$aluno->getCpf())
	$cpf = "";
else
	$cpf = $aluno->getCpf();

if(!$aluno->getEmail())
	$email = "";
else
	$email = $aluno->getEmail();

if(!$aluno->getRg())
	$rg = "";
else
	$rg = $aluno->getRg();

if(!$aluno->getOrgaoEmissor())
	$oe = "";
else
	$oe = $aluno->getOrgaoEmissor();

if(!$aluno->getSenha())
	$senha = "";
else
	$senha = $aluno->getSenha();

if(!$aluno->getEndereco())
	$endereco = "";
else
	$endereco = $aluno->getEndereco();

if(!$aluno->getTelefone())
	$telefone = "";
else
	$telefone = $aluno->getTelefone();

if(!$aluno->getTipo())
	$tipo = "";
else
	$tipo = $aluno->getTipo();

if(!$aluno->getMatricula())
	$matricula = "";
else
	$matricula = $aluno->getMatricula();

if(!$aluno->getCurso())
	$curso = "";
else
	$curso = $aluno->getCurso();

if(!$aluno->getAnoIngresso())
	$ai = "";
else
	$ai = $aluno->getAnoIngresso();

if(!$aluno->getBanco())
	$curso = "";
else
	$curso = $aluno->getBanco();

if(!$aluno->getAgencia())
	$agencia = "";
else
	$agencia = $aluno->getAgencia();

if(!$aluno->getCc())
	$cc = "";
else
	$cc = $aluno->getCc();

if(!$aluno->getHistorico())
	$historico = "";
else
	$historico = $aluno->getHistorico();
/*
echo "INSERT INTO 
aluno VALUES('".
	$aluno->getCpf()."','".
	$nome."','".
	$aluno->getEmail()."','".
	$aluno->getSenha()."','".
	$aluno->getRg()."','".
	$aluno->getOrgaoEmissor()."','".
	$aluno->getEndereco()."','".
	$aluno->getTelefone()."','".
	$aluno->getTipo()."','".
	$aluno->getMatricula()."','".
	$aluno->getCurso()."','".
	$aluno->getAnoIngresso()."','".
	$aluno->getBanco()."','".
	$aluno->getAgencia()."','".
	$aluno->getCc()."','".
	$aluno->getHistorico().
")";*/

$quer = mysql_query("INSERT INTO aluno VALUES(null,'".
	$cpf."','".
	$nome."','".
	$email."','".
	$senha."','".
	$rg."','".
	$oe."','".
	$endereco."','".
	$telefone."','".
	$tipo."','".
	$matricula."','". 
	$curso."','".
	$ai."','".
	$banco."','".
	$agencia."','".
	$cc."','".
	$historico."')");

echo $cpf;
if(!mysql_error())
{					
	echo "<script>alert(\"Inserido! $mensagem\");</script>";       
	echo ("<script>window.location.href = \"../index.php\";</script>");	
}
else
	echo $twig->render($baseTemplate.'erro.twig', array('Erros' => 'Erro! Nao foi possivel inserir!'));
	
} else if ($acao == 'update') {		
		//$senha2=$_POST['senha2'];

	/*if ($_POST) {
	  foreach ($_POST as $key => $value) {
	    echo $key . ' = ' . $value . '<br />';
	  }
	}*/
		$alunoalt = new Aluno($_POST);   	
		
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
		$sqlUpdate = "UPDATE ALUNO SET ";

if($alunoalt->getNome())
	$sqlUpdate .= "nome ='".$alunoalt->getNome()."'" ;

if($alunoalt->getCpf())
	$sqlUpdate .= ", cpf ='".$alunoalt->getCpf()."'" ;

if($alunoalt->getEmail())
	$sqlUpdate .= ", email ='".$alunoalt->getEmail()."'" ;

if($alunoalt->getRg())
	$sqlUpdate .= ", rg ='".$alunoalt->getRg()."'" ;


if($alunoalt->getOrgaoEmissor())
	$sqlUpdate .= ", orgaoEmissor ='".$alunoalt->getOrgaoEmissor()."'" ;


if($alunoalt->getSenha())
	$sqlUpdate .= ", senha ='".$alunoalt->getSenha()."'" ;


if($alunoalt->getEndereco())
	$sqlUpdate .= ", endereco ='".$alunoalt->getEndereco()."'" ;


if($alunoalt->getTelefone())
	$sqlUpdate .= ", telefone ='".$alunoalt->getTelefone()."'" ;


if($alunoalt->getTipo())
	$sqlUpdate .= ", tipo ='".$alunoalt->getTipo()."'" ;


if($alunoalt->getMatricula())
	$sqlUpdate .= ", matricula ='".$alunoalt->getMatricula()."'" ;

if($alunoalt->getCurso())
	$sqlUpdate .= ", curso ='".$alunoalt->getCurso()."'" ;

if($alunoalt->getAnoIngresso())
	$sqlUpdate .= ", anoIngresso ='".$alunoalt->getAnoIngresso()."'" ;

if($alunoalt->getBanco())
	$sqlUpdate .= ", banco ='".$alunoalt->getBanco()."'" ;

if($alunoalt->getAgencia())
	$sqlUpdate .= ", agencia ='".$alunoalt->getAgencia()."'" ;

if($alunoalt->getCc())
	$sqlUpdate .= ", cc ='".$alunoalt->getCc()."'" ;

if($alunoalt->getHistorico())
	$sqlUpdate .= ", historico ='".$alunoalt->getHistorico()."' " ;

$id = $_POST['id'];
$sqlUpdate .= "where id_aluno=".$id;
echo $sqlUpdate;
$quer = mysql_query($sqlUpdate);

if(!mysql_error())
{					
	echo "<script>alert(\"Editado! $mensagem\");</script>";       
	echo ("<script>window.location.href = \"../index.php\";</script>");	
}
else
	echo $twig->render($baseTemplate.'erro.twig', array('Erros' => 'Erro! Nao foi possivel inserir!'));


} else if ($acao == 'consult') {
	$sql = selecao("Aluno"); 
	$result = mysql_query($sql, $conecta); 
 
if(!$result)
	    echo "<script>alert(\"Nenhum registro encontrado. Para criar um novo selecione `Novo Cadastro`\");</script>";       
else{

	while($consulta = mysql_fetch_array($result)) { 
		$alunos[] = $consulta;
	}

echo $twig->render($baseTemplate.'consult.twig',
	array(
            'entities' => $alunos,
        ));
}
//mysql_free_result($result); 
//mysql_close($conecta); 
}else {
	echo $twig->render('404.twig');
}

