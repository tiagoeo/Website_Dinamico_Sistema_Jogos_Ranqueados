<?php
	include(__DIR__.'/vo/websiteVO.php');
    sec_session_start();

	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		if(isset($_POST["usuarioLogin"]) && !empty($_POST["usuarioLogin"]) and isset($_POST["senhaLogin"]) && !empty($_POST["senhaLogin"])){
			$novoLogin = new websiteVO;
			
			$usuario = $_POST['usuarioLogin'];
			$senha = $_POST['senhaLogin'];

            $usuario = filter_var($usuario, FILTER_SANITIZE_STRING);

            if(strlen($usuario) < 3){
                $resultado['login'] = null;
                $resultado = json_encode($resultado);
                echo($resultado);
                exit();
            }

            if(strlen($senha) < 4){
                $resultado['login'] = null;
                $resultado = json_encode($resultado);
                echo($resultado);
                exit();
            }

            $senha = md5($senha);

            $novoLogin = $novoLogin->loginVO($usuario, $senha);

            if($novoLogin){
                $_SESSION['UID'] = $novoLogin['idusuario'];
                $_SESSION['NOME'] = $novoLogin['nome'];
                $_SESSION['EMAIL'] = $novoLogin['email'];
                $_SESSION['STATUS'] = $novoLogin['situacao'];
                $returnNovoLogin['login'] = true;
                $returnNovoLogin = json_encode($returnNovoLogin);
                echo($returnNovoLogin);
                exit();
            }else{
                $returnNovoLogin['login'] = false;
                $returnNovoLogin = json_encode($returnNovoLogin);
                echo($returnNovoLogin);
                exit();
            }
        }else if(isset($_POST["usuarioCadastro"]) && !empty($_POST["usuarioCadastro"]) and isset($_POST["emailCadastro"]) && !empty($_POST["emailCadastro"]) and isset($_POST["email2Cadastro"]) && !empty($_POST["email2Cadastro"]) and isset($_POST["senhaCadastro"]) && !empty($_POST["senhaCadastro"]) and isset($_POST["senha2Cadastro"]) && !empty($_POST["senha2Cadastro"])){
			$novoCadastro = new websiteVO;
			
			$usuario = $_POST['usuarioCadastro'];
            $email = $_POST['emailCadastro'];
            $email2 = $_POST['email2Cadastro'];
			$senha = $_POST['senhaCadastro'];
            $senha2 = $_POST['senha2Cadastro'];
            $situacao = 1;

            $usuario = filter_var($usuario, FILTER_SANITIZE_STRING);

            if (strlen($usuario) < 3){
                $resultado['cadastro'] = null;
                $resultado = json_encode($resultado);
                echo($resultado);
                exit();
            }

            if (strlen($senha) < 4){
                $resultado['cadastro'] = null;
                $resultado = json_encode($resultado);
                echo($resultado);
                exit();
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $resultado['cadastro'] = null;
				$resultado = json_encode($resultado);
				echo($resultado);
				exit();
			}

            if (!filter_var($email2, FILTER_VALIDATE_EMAIL)){
                $resultado['cadastro'] = null;
				$resultado = json_encode($resultado);
				echo($resultado);
				exit();
			}

            if ($email != $email2){
                $resultado['cadastro'] = null;
				$resultado = json_encode($resultado);
				echo($resultado);
				exit();
			}

            if ($senha != $senha2){
                $resultado['cadastro'] = null;
				$resultado = json_encode($resultado);
				echo($resultado);
				exit();
			}
            
            $senha = md5($senha2);

            $novoCadastro = $novoCadastro->cadastroUsuarioVO($usuario, $email, $senha, $situacao);

            if($novoCadastro){
                $returnNovoCadastro['cadastro'] = true;
                $returnNovoCadastro = json_encode($returnNovoCadastro);
                echo($returnNovoCadastro);
                exit();
            }else{
                $returnNovoCadastro['cadastro'] = false;
                $returnNovoCadastro = json_encode($returnNovoLogin);
                echo($returnNovoCadastro);
                exit();
            }
        }
    }else{
		header("Location: index.php");
		exit();
	}
?>