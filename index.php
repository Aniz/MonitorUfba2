<!DOCTYPE html>
<?php /* esse bloco de código em php verifica se existe a sessão, pois o usuário pode simplesmente não fazer
 o login e digitar na barra de endereço do seu navegador o caminho para a página principal do site (sistema), 
 burlando assim a obrigação de fazer um login, com isso se ele não estiver feito o login não será criado a session, 
 então ao verificar que a session não existe a página redireciona o mesmo para a index.php.*/ 
	 session_start(); 
	 if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true)) {
	  	unset($_SESSION['login']); 
	  	unset($_SESSION['senha']); 
	  	header('location:login.php'); 
	  } 
	  $logado = $_SESSION['login']; 
  ?>



<html>
    <head>
            <link rel="stylesheet" href="public/css/bootstrap.css" />
            <title>Welcome</title>
            <script type="text/javascript" src="public/js/jquery-1.8.3.min.js"></script>
            <script type="text/javascript" src="public/js/bootstrap.js"></script>
              <link href="public/theme.css" rel="stylesheet" type="text/css"> 
    </head>
    <body>	    	
	    	<div class="btn-group">
			  <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
			    Aluno
			    <span class="caret"></span>
			  </a>
			  <ul class="dropdown-menu">
			    <li><a href="controller/aluno.php?acao=new">Novo</a></li>			    
			    <li><a href="controller/aluno.php?acao=consult">Lista</a></li>
			  </ul>
			</div>
			<div class="btn-group">
			  <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
			    Professor
			    <span class="caret"></span>
			  </a>
			  <ul class="dropdown-menu">
			    <li><a href="controller/professor.php?acao=new">Novo</a></li>			    
			    <li><a href="controller/professor.php?acao=consult">Lista</a></li>
			  </ul>
			</div>			
	    <div class="btn-group">
			  <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
			    Projetos de Monitoria
			    <span class="caret"></span>
			  </a>
			  <ul class="dropdown-menu">
			    <li><a href="controller/projeto.php?acao=new">Novo</a></li>			    
			    <li><a href="controller/projeto.php?acao=consult">Lista</a></li>
			  </ul>
		</div>
		<div class="btn-group">
			  <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
			    Departamento
			    <span class="caret"></span>
			  </a>
			  <ul class="dropdown-menu">
			    <li><a href="controller/departamento.php?acao=new">Novo</a></li>			    
			    <li><a href="controller/departamento.php?acao=consult">Lista</a></li>
			  </ul>
		</div>	
		<div class="btn-group">
			  <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
			    Relatorio
			    <span class="caret"></span>
			  </a>
			  <ul class="dropdown-menu">
			    <li><a href="controller/relatorio.php?acao=new">Novo</a></li>			    
			    <li><a href="controller/relatorio.php?acao=consult">Lista</a></li>
			  </ul>
		</div>	
		<div class="btn-group">
			  <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
			    Edital
			    <span class="caret"></span>
			  </a>
			  <ul class="dropdown-menu">
			    <li><a href="controller/edital.php?acao=new">Novo</a></li>			    
			    <li><a href="controller/edital.php?acao=consult">Lista</a></li>
			  </ul>
		</div>		
		<div class="btn-group">
			  <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
			    Monitoria
			    <span class="caret"></span>
			  </a>
			  <ul class="dropdown-menu">
			    <li><a href="controller/monitoria.php?acao=new">Novo</a></li>			    
			    <li><a href="controller/monitoria.php?acao=consult">Lista</a></li>
			  </ul>
		</div>				
	    <div class="btn-group">
			  <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
			    Selecao
			    <span class="caret"></span>
			  </a>
			  <ul class="dropdown-menu">
			    <li><a href="controller/selecao.php?acao=new">Novo</a></li>			    
			    <li><a href="controller/selecao.php?acao=consult">Lista</a></li>
			  </ul>
		</div>				
	    
	    </div>


<h1>MonitorUfba</h1>
 
	<footer>© AJA</footer>

    </body>
</html>