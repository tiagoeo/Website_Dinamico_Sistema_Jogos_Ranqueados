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
        }else if(isset($_POST["usuarioAppLogin"]) && !empty($_POST["usuarioAppLogin"]) and isset($_POST["senhaAppLogin"]) && !empty($_POST["senhaAppLogin"]) and isset($_POST["appLogin"]) && !empty($_POST["appLogin"])){
			$novoLogin = new websiteVO;
            $novaBusca = new websiteVO;
			
			$usuario = $_POST['usuarioAppLogin'];
			$senha = $_POST['senhaAppLogin'];
            $uidGame = $_POST['appLogin'];

            $usuario = filter_var($usuario, FILTER_SANITIZE_STRING);
            $uidGame = preg_replace('/[^[:alnum:]_]/', '', $uidGame);

            if(strlen($usuario) < 3){
                $resultado['loginapp'] = null;
                $resultado = json_encode($resultado);
                echo($resultado);
                exit();
            }

            if(strlen($senha) < 4){
                $resultado['loginapp'] = null;
                $resultado = json_encode($resultado);
                echo($resultado);
                exit();
            }

            $senha = md5($senha);

            $novoLogin = $novoLogin->loginVO($usuario, $senha);

            if($novoLogin){
                $returnNovoLogin['UID'] = $novoLogin['idusuario'];
                $returnNovoLogin['NOME'] = $novoLogin['nome'];
                $returnNovoLogin['EMAIL'] = $novoLogin['email'];
                $returnNovoLogin['STATUS'] = $novoLogin['situacao'];
                $returnNovoLogin['loginapp'] = true;

                $novaBuscaPontuacoes = $novaBusca->pontuacoesVO($novoLogin['email']);

                $returnNovoLogin['pontuacoes'] = false;

                if ($novaBuscaPontuacoes != false){   
                    for ($i =0; $i < count($novaBuscaPontuacoes); $i++){
                        if ($novaBuscaPontuacoes[$i]["idgame"] == $uidGame){
                            $returnNovoLogin['GamePontos'] = $novaBuscaPontuacoes[$i]['pontos'];
                            $returnNovoLogin['GameExtras'] = $novaBuscaPontuacoes[$i]['extras'];
                            $returnNovoLogin['GameNome'] = $novaBuscaPontuacoes[$i]['nome'];
                            $returnNovoLogin['GameBonus'] = $novaBuscaPontuacoes[$i]['bonus'];
                            $returnNovoLogin['pontuacoes'] = true;
                        }
                    }
                }

                $returnNovoLogin = json_encode($returnNovoLogin);
                echo($returnNovoLogin);
                exit();
            }else{
                $returnNovoLogin['loginapp'] = false;
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
        }else if(isset($_POST["buscaPontos"]) && !empty($_POST["buscaPontos"]) and isset($_POST["buscaAppLogin"]) && !empty($_POST["buscaAppLogin"])){
			$novaBusca = new websiteVO;
            $email = $_POST['buscaPontos'];
            $uidGame = $_POST['buscaAppLogin'];

            $uidGame = preg_replace('/[^[:alnum:]_]/', '', $uidGame);

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $resultado['pontuacoes'] = null;
				$resultado = json_encode($resultado);
				echo($resultado);
				exit();
			}

            $novaBuscaPontuacoes = $novaBusca->pontuacoesVO($email);

            $returnJsonPontuacoes['pontuacoes'] = false;

            if ($novaBuscaPontuacoes != false){   
                for ($i =0; $i < count($novaBuscaPontuacoes); $i++){
                    if ($novaBuscaPontuacoes[$i]["idgame"] == $uidGame){
                        $returnJsonPontuacoes['uid'] = $novaBuscaPontuacoes[$i]['idusuario'];
                        $returnJsonPontuacoes['GamePontos'] = $novaBuscaPontuacoes[$i]['pontos'];
                        $returnJsonPontuacoes['GameExtras'] = $novaBuscaPontuacoes[$i]['extras'];
                        $returnJsonPontuacoes['GameNome'] = $novaBuscaPontuacoes[$i]['nome'];
                        $returnJsonPontuacoes['GameBonus'] = $novaBuscaPontuacoes[$i]['bonus'];
                        $returnJsonPontuacoes['pontuacoes'] = true;
                        $returnJsonPontuacoes = json_encode($returnJsonPontuacoes);
                        echo($returnJsonPontuacoes);
                        exit();
                    }
                }
            }else{
                $returnJsonPontuacoes['pontuacoes'] = false;
                $returnJsonPontuacoes = json_encode($returnJsonPontuacoes);
                echo($returnJsonPontuacoes);
                exit();
            }
        }else if(isset($_POST["uidusuariovincular"]) && !empty($_POST["uidusuariovincular"]) and isset($_POST["uidgamevincular"]) && !empty($_POST["uidgamevincular"])and isset($_POST["buscausuariovincular"]) && !empty($_POST["buscausuariovincular"])){
			$novoVinculo = new websiteVO;
            $novaBusca = new websiteVO;

            $uidUsuario = $_POST['uidusuariovincular'];
            $uidGame = $_POST['uidgamevincular'];
            $email = $_POST["buscausuariovincular"];

            $uidUsuario = preg_replace('/[^[:alnum:]_]/', '',$uidUsuario);
            $uidGame = preg_replace('/[^[:alnum:]_]/', '',$uidGame);

            $novaBuscaPontuacoes = $novaBusca->pontuacoesVO($email);

            if ($novaBuscaPontuacoes != false){   
                for ($i =0; $i < count($novaBuscaPontuacoes); $i++){
                    if ($novaBuscaPontuacoes[$i]["idgame"] == $uidGame){
                        $returnJsonPontuacoes['uid'] = $novaBuscaPontuacoes[$i]['idusuario'];
                        $retornoJsonVinculo['GamePontos'] = $novaBuscaPontuacoes[$i]['pontos'];
                        $retornoJsonVinculo['GameExtras'] = $novaBuscaPontuacoes[$i]['extras'];
                        $retornoJsonVinculo['GameNome'] = $novaBuscaPontuacoes[$i]['nome'];
                        $retornoJsonVinculo['GameBonus'] = $novaBuscaPontuacoes[$i]['bonus'];
                        $retornoJsonVinculo['Vinculo'] = "existe";
                        $retornoJsonVinculo = json_encode($retornoJsonVinculo);
                        echo($retornoJsonVinculo);
                        exit();
                    }
                }
            }
            
            $novoVinculoUsuarioGame;

            switch ($uidGame) {
                case 1:
                    $novoVinculoUsuarioGame = $novoVinculo->vincularUsuarioGameVO($uidUsuario, $uidGame, 0 , '[0]');
                    break;
                case 2:
                    $novoVinculoUsuarioGame = $novoVinculo->vincularUsuarioGameVO($uidUsuario, $uidGame, 0 , '[0]');
                    break;
                default:
                    $novoVinculoUsuarioGame = null;
                    $retornoJsonVinculo['Vinculo'] = null;
                    $retornoJsonVinculo = json_encode($retornoJsonVinculo);
                    echo($retornoJsonVinculo);
                    exit();
                    break;
            }
            

            if ($novoVinculoUsuarioGame != false){    
                $retornoJsonVinculo['Vinculo'] = true;
                $retornoJsonVinculo = json_encode($retornoJsonVinculo);
                echo($retornoJsonVinculo);
                exit();
            }else{
                $retornoJsonVinculo['Vinculo'] = false;
                $retornoJsonVinculo = json_encode($retornoJsonVinculo);
                echo($retornoJsonVinculo);
                exit();
            }
        }else if(isset($_POST["uidusuarioatualizar"]) && !empty($_POST["uidusuarioatualizar"]) and isset($_POST["uidgameatualizar"]) && !empty($_POST["uidgameatualizar"]) and isset($_POST["pontosatualizar"]) && !empty($_POST["pontosatualizar"]) and isset($_POST["extrasatualizar"]) && !empty($_POST["extrasatualizar"])){
			$novaAttPtsUsuario = new websiteVO;
            $uidUsuario = $_POST['uidusuarioatualizar'];
            $uidGame = $_POST['uidgameatualizar'];
            $pontos = $_POST['pontosatualizar'];
            $extras = $_POST['extrasatualizar'];

            $uidUsuario = preg_replace('/[^[:alnum:]_]/', '',$uidUsuario);
            $uidGame = preg_replace('/[^[:alnum:]_]/', '',$uidGame);

            $novaAttPtsUsuarioGame;

            switch ($uidGame) {
                case 1:
                    $novaAttPtsUsuarioGame = $novaAttPtsUsuario->atualizarPontosVO($uidUsuario, $uidGame, $pontos, $extras);
                    break;
                case 2:
                    $novaAttPtsUsuarioGame = $novaAttPtsUsuario->atualizarPontosVO($uidUsuario, $uidGame, $pontos, $extras);
                    break;

                default:
                    $retornoJsonAtualizacao['atualizacao'] = null;
                    $retornoJsonAtualizacao = json_encode($retornoJsonAtualizacao);
                    echo($retornoJsonAtualizacao);
                    exit();
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