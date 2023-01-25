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

            $novaBuscaUsuarioEmail = $novoCadastro->buscaUsuarioEmailVO($email);

            $novaBuscaUsuarioNome = $novoCadastro->buscaUsuarioNomeVO($usuario);

            if ($novaBuscaUsuarioEmail == false && $novaBuscaUsuarioNome == false){
                $retornoNovoCadastro = $novoCadastro->cadastroUsuarioVO($usuario, $email, $senha, $situacao);

                if($retornoNovoCadastro){
                    $novaBuscaUsuarioEmail = $novoCadastro->buscaUsuarioEmailVO($email);
    
                    if ($novaBuscaUsuarioEmail != false){
                        $novoCadastro->vincularUsuarioGameVO($novaBuscaUsuarioEmail['idusuario'], 1, 0, '[0]');
                    }
    
                    $returnJsonNovoCadastro['cadastro'] = true;
                    $returnJsonNovoCadastro = json_encode($returnJsonNovoCadastro);
                    echo($returnJsonNovoCadastro);
                    exit();
                }else{
                    $returnJsonNovoCadastro['cadastro'] = false;
                    $returnJsonNovoCadastro = json_encode($returnJsonNovoCadastro);
                    echo($returnJsonNovoCadastro);
                    exit();
                }
            }else{
                $returnJsonNovoCadastro['cadastro'] = false;
                $returnJsonNovoCadastro = json_encode($returnJsonNovoCadastro);
                echo($returnJsonNovoCadastro);
                exit();
            }   
        }else if(isset($_POST["buscaPontuacoes"]) && !empty($_POST["buscaPontuacoes"])){
			$novaBusca = new websiteVO;
            $email = $_POST['buscaPontuacoes'];

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $resultado['pontuacoes'] = null;
				$resultado = json_encode($resultado);
				echo($resultado);
				exit();
			}

            $novaBuscaPontuacoes = $novaBusca->pontuacoesVO($email);

            if ($novaBuscaPontuacoes != false){    
                $novaBuscaPontuacoes['pontuacoes'] = true;
                $novaBuscaPontuacoes = json_encode($novaBuscaPontuacoes);
                echo($novaBuscaPontuacoes);
                exit();
            }else{
                $returnJsonPontuacoes['pontuacoes'] = false;
                $returnJsonPontuacoes = json_encode($returnJsonPontuacoes);
                echo($returnJsonPontuacoes);
                exit();
            }
        }else if(isset($_POST["uidusuariovincular"]) && !empty($_POST["uidusuariovincular"]) and isset($_POST["uidgamevincular"]) && !empty($_POST["uidgamevincular"])){
			$novoVinculo = new websiteVO;
            $uidUsuario = $_POST['uidusuariovincular'];
            $uidGame = $_POST['uidgamevincular'];

            $uidUsuario = preg_replace('/[^[:alnum:]_]/', '',$uidUsuario);
            $uidGame = preg_replace('/[^[:alnum:]_]/', '',$uidGame);

            $novoVinculoUsuarioGame;

            switch ($uidGame) {
                case 1:
                    $novoVinculoUsuarioGame = $novoVinculo->vincularUsuarioGameVO($uidUsuario, $uidGame, 0 , '[0]');
                    break;
            }
            

            if ($novoVinculoUsuarioGame != false){    
                $retornoJsonVinculo['vinculo'] = true;
                $retornoJsonVinculo = json_encode($retornoJsonVinculo);
                echo($retornoJsonVinculo);
                exit();
            }else{
                $retornoJsonVinculo['vinculo'] = false;
                $retornoJsonVinculo = json_encode($retornoJsonVinculo);
                echo($retornoJsonVinculo);
                exit();
            }
        }else if(isset($_POST["uidusuarioatualizar"]) && !empty($_POST["uidusuarioatualizar"]) and isset($_POST["uidgameatualizar"]) && !empty($_POST["uidgameatualizar"]) and isset($_POST["pontosatualizar"]) && !empty($_POST["pontosatualizar"])){
			$novaAttPtsUsuario = new websiteVO;
            $uidUsuario = $_POST['uidusuarioatualizar'];
            $uidGame = $_POST['uidgameatualizar'];
            $pontos = $_POST['pontosatualizar'];

            $uidUsuario = preg_replace('/[^[:alnum:]_]/', '',$uidUsuario);
            $uidGame = preg_replace('/[^[:alnum:]_]/', '',$uidGame);

            $novaAttPtsUsuarioGame;

            switch ($uidGame) {
                case 1:
                    $novaAttPtsUsuarioGame = $novaAttPtsUsuario->atualizarPontosVO($uidUsuario, $uidGame, $pontos, '['.$pontos.']');
                    break;
            }
            
            if ($novaAttPtsUsuarioGame != false){    
                $retornoJsonAtualizacao['atualizacao'] = true;
                $retornoJsonAtualizacao = json_encode($retornoJsonAtualizacao);
                echo($retornoJsonAtualizacao);
                exit();
            }else{
                $retornoJsonAtualizacao['atualizacao'] = false;
                $retornoJsonAtualizacao = json_encode($retornoJsonAtualizacao);
                echo($retornoJsonAtualizacao);
                exit();
            }
        }
    }else{
		header("Location: index.php");
		exit();
	}
?>