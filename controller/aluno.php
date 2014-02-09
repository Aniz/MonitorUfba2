<?php

require_once '../vendor/autoload.php';
require_once '../helper/twig.php';
require_once '../entidades/Aluno.class.php';
require_once('../helper/funcoes.php');

//banco
$conecta = conectar();
$acao = isset($_GET['acao']) ? $_GET['acao'] : '';

session_start(); 	
$tipo = $_SESSION['tipo'];
$idSection = $_SESSION['id'];
$twig = twig('../view/');

$baseTemplate="aluno/";

/****************************
*
*  New
*  Alunos sem login podem cadastrar novos alunos ou o administrador
*
****************************/

if ($acao == 'new') {
	echo $twig->render($baseTemplate. 'new.twig', array('tipo' => $tipo));

	/****************************
	*
	*  Create
	*
	****************************/

} else if ($acao == 'create') {
	//$senha2=$_POST['senha2'];
	$aluno = new Aluno($_POST);   	
  	/*$val = $aluno->ValidaUsuario($senha2);//valida
	
	if(!empty($val))
	{
		foreach ($val as $erro) 
			echo $twig->render($baseTemplate.'erro.twig', array('Erros' => $erro));
	}*/
//	else 
//			{			
	//echo $aluno->getOrgaoEmissor();
	//echo $aluno->getAnoIngresso();

	/*$dados=array($aluno->getNome(),$aluno->getCpf(),$aluno->getEmail(),$aluno->getRg(),$aluno->getOrgaoEmissor(),
		$aluno->getSenha(),$aluno->getEndereco(),$aluno->getTelefone(),$aluno->getMatricula(), 
		$aluno->getCurso(),$aluno->getAnoIngresso(),$aluno->getBanco(),$aluno->getAgencia(),$aluno->getCc(),$aluno->getGenero(),$aluno->getHistorico());
	*/
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
		$banco = "";
	else
		$banco = $aluno->getBanco();

	if(!$aluno->getAgencia())
		$agencia = "";
	else
		$agencia = $aluno->getAgencia();

	if(!$aluno->getCc())
		$cc = "";
	else
		$cc = $aluno->getCc();

	if(!$aluno->getGenero())
		$genero= "";
	else
		$genero = $aluno->getGenero();

	$pquer = mysql_query("Select email from professor where email='".$email."'or cpf ='".$cpf."'");
$aquer = mysql_query("Select email from aluno where email='".$email."'or cpf =".$cpf."'");

if((mysql_num_rows($pquer) > 0)||(mysql_num_rows($aquer) > 0)) { 
	echo $twig->render($baseTemplate.'new.twig', array('Erros' => 'Erro! Esse email ou cpf já está cadastrado! ',array('tipo' => $tipo,'entity'=>$entity)));
}

	$dados;
	$tipo_historico;
	$nome_historico;

	$arquivo = $_FILES["historico"]["tmp_name"]; 
	$tipo_historico    = $_FILES["historico"]["type"];
	$nome_historico  = $_FILES["historico"]["name"];

	chdir('temp');
	move_uploaded_file($arquivo, getcwd()."\\ultimo.pdf");

	$pont = fopen(getcwd()."\\ultimo.pdf", "rb");
	$dados = addslashes(fread($pont, filesize(getcwd()."\\ultimo.pdf")));
 	$quer = mysql_query("INSERT INTO aluno 
	(`cpf`, `nome`, `genero`, `email`, `senha`, `rg`, `orgao_emissor`, `endereco`, `telefone`, `matricula`, `curso`, `ano_ingresso`, `banco`, `agencia`, `cc`, `historico`, `nome_historico`, `tipo_historico`)
	VALUES('".
		$cpf."','".
		$nome."','".
		$genero."','".
		$email."','".
		$senha."','".
		$rg."','".
		$oe."','".
		$endereco."','".
		$telefone."','".
		$matricula."','". 
		$curso."','".
		$ai."','".
		$banco."','".
		$agencia."','".
		$cc."','".
		$dados."','".
		$nome_historico."','".
		$tipo_historico."')");

	if(!mysql_error())
	{					
		echo "<script>alert(\"Inserido! $mensagem\");</script>";       
		echo ("<script>window.location.href = \"../index.php\";</script>");	
	}
	else
		echo $twig->render($baseTemplate.'erro.twig', array('Erros' => 'Erro! Nao foi possivel inserir!',  'tipo' => $tipo,));
}

if($tipo){

	/****************************
	*
	*  Edit
	*  Apenas alunos logados ou o administrador podem editar os dados do aluno
	*
	****************************/

	if ($acao == 'edit') {
		$aux = $idSection;
		if($tipo!='aluno'){
			$idSection = $_GET["idAluno"];
		}
		
		$sql = selecaoByID('Aluno','id_aluno',$idSection);	
		//echo($tipo);
		$result = mysql_query($sql, $conecta); 
		//echo($idSection);
		$idSection = $aux;
		if(!$result)
			    echo "<script>alert(\"Nenhum registro encontrado. Cadastre-se!\");</script>";       
		else{
			
			while($consulta = mysql_fetch_array($result)) { 
				
				if($consulta['genero'] == 'M')
					$consulta['genero'] = "Masculino";
				else
					$consulta['genero'] = "Feminino";
				
				$alunos[] = $consulta;

			}
			//var_dump($alunos);
			echo $twig->render($baseTemplate.'edit.twig',
				array(
			            'entities' => $alunos,
			            'tipo' => $tipo,
			        ));
		}
		 
	/****************************
	*
	*  Delete
	*
	****************************/

	} else if ($acao == 'delete') {
				
		$idx=$_GET['idAluno'];
		$idS = "id_aluno =".$idx;	
				
		echo $sqlDeletar = deletar('aluno',$idS);

		$result = mysql_query($sqlDeletar, $conecta); 
				if(!mysql_error())
				{
					echo "<script>alert(\"Removido!\");</script>";    

					unset($_GET['acao']);
					unset($_GET['idAluno']);
				}	
				else   	
					echo "<script>alert(\"Esse aluno possui monitoria, portanto não pode ser excluído!\");</script>";       
				
				if($tipo=='administrador')
					echo ("<script>window.location.href = \"../controller/aluno.php?acao=consult\";</script>");	
				else
					echo ("<script>window.location.href = \"../index.php\";</script>");	
	
	/****************************
	*
	*  Update
	*
	****************************/

	} else if ($acao == 'update') {		
				//$senha2=$_POST['senha2'];
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

		if($alunoalt->getEmail())
			$sqlUpdate .= "email ='".$alunoalt->getEmail()."'," ;

		if($alunoalt->getRg())
			$sqlUpdate .= "rg ='".$alunoalt->getRg()."'," ;

		if($alunoalt->getOrgaoEmissor())
			$sqlUpdate .= "orgao_emissor ='".$alunoalt->getOrgaoEmissor()."'," ;

		if($alunoalt->getSenha())
			$sqlUpdate .= "senha ='".$alunoalt->getSenha()."'," ;

		if($alunoalt->getEndereco())
			$sqlUpdate .= "endereco ='".$alunoalt->getEndereco()."'," ;

		if($alunoalt->getTelefone())
			$sqlUpdate .= "telefone ='".$alunoalt->getTelefone()."'," ;

		if($alunoalt->getMatricula())
			$sqlUpdate .= "matricula ='".$alunoalt->getMatricula()."'," ;

		if($alunoalt->getCurso())
			$sqlUpdate .= "curso ='".$alunoalt->getCurso()."'," ;

		if($alunoalt->getAnoIngresso())
			$sqlUpdate .= "ano_ingresso ='".$alunoalt->getAnoIngresso()."'," ;

		if($alunoalt->getBanco())
			$sqlUpdate .= "banco ='".$alunoalt->getBanco()."'," ;

		if($alunoalt->getAgencia())
			$sqlUpdate .= "agencia ='".$alunoalt->getAgencia()."'," ;

		if($alunoalt->getCc())
			$sqlUpdate .= "cc ='".$alunoalt->getCc()."'," ;

		$sqlUpdate = substr($sqlUpdate,0,-1);
		
		$aux = $sqlUpdate;

		$arquivo = $_FILES["historico"]["tmp_name"]; 
		$tipo_historico    = $_FILES["historico"]["type"];
		$nome_historico  = $_FILES["historico"]["name"];

		chdir('temp');

		move_uploaded_file($arquivo, getcwd()."\\ultimo.pdf");

		$pont = fopen(getcwd()."\\ultimo.pdf", "rb");

		$dados = addslashes(fread($pont, filesize(getcwd()."\\ultimo.pdf")));

		echo $sqlUpdate .= ", historico ='".$dados."',
		tipo_historico ='".$tipo_historico."',nome_historico ='".$nome_historico."' ";


		$id = $_POST['id'];
		echo $sqlUpdate .= "where id_aluno=".$id;
		$aux.",tipo_historico ='".$tipo_historico."',nome_historico ='".$nome_historico." ' where id_aluno=".$id ;
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
		             'tipo' => $tipo,
		        ));
		}
		}else if ($acao == 'download') {
			$id = $_GET['idAluno'];

			$sql = "SELECT * FROM aluno WHERE id_aluno=".$id;
			$download = mysql_query($sql,$conecta);
			$nome_historico = mysql_result($download, 0, "nome_historico");
			$tipo = mysql_result($download, 0, "tipo_historico");
			$conteudo = mysql_result($download, 0, "historico");
			
			header('Content-Type: text/html; charset=utf-8'); 
			header('Content-Type: filesize($conteudo)');
			header('Content-Type: application/pdf');
			header("Content-Disposition: attachment; filename=$nome_historico");
			print($conteudo);


		//mysql_free_result($result); 
		//mysql_close($conecta); 
		}
		else {
			echo $twig->render('404.twig', array('tipo' => $tipo));
		}
	}
	else
		echo $twig->render('new.twig', array('tipo' => $tipo));



