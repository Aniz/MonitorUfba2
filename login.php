<!DOCTYPE html>
<html>
    <head>
            <link rel="stylesheet" href="public/css/bootstrap.css" />
            <title>Welcome</title>
            <script type="text/javascript" src="public/js/jquery-1.8.3.min.js"></script>
            <script type="text/javascript" src="public/js/bootstrap.js"></script>
              <link href="public/theme.css" rel="stylesheet" type="text/css"> 
    </head>
    <body>          
            <form method="post" action="controller/login.php" id="formlogin" name="formlogin" > <fieldset id="fie"> 
            <legend>LOGIN</legend><br /> 
            <label>NOME : </label> 
                <input type="text" name="login" id="login" /><br /> 
            <label>SENHA :</label> 
                <input type="password" name="senha" id="senha" /><br /> 
            <label>Tipo:</label> 
                <select name="tipo">                   
                  <option value="aluno" >Aluno</option>
                  <option value="professor" >Professor</option>       
                  <option value="administrador" >Administrador</option>       
                </select><br />

            <input type="submit" value="LOGAR   " /> </fieldset> </form>





    </body>
</html>