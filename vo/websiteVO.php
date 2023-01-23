<?php
    date_default_timezone_set('America/Sao_Paulo'); 

    require_once(__DIR__.'/../dao/websiteDAO.php');

    function sec_session_start() {
        $secure = true;
        $httponly = true;

        ini_set('session.use_only_cookies', 1);
        $cookieParams = session_get_cookie_params();
        session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure, $httponly);
        session_name('Website_Dinamico');
        session_start();
    }
    
    class websiteVO{
        function dadosWebsiteVO(){
            try{
                $novoWebsiteDAO = new websiteDAO;
                
                $retornoNovoWebsiteDAO = $novoWebsiteDAO->dadosWebsiteDAO();

                if ($retornoNovoWebsiteDAO != false){
                    return $retornoNovoWebsiteDAO;
                }else{
                    return false;
                }
            }catch(Exception  $e){
                return $e->getMessage();
            }
        }

        function dadosPaginaVO($pagina){
            try{
                $novaPaginaDAO = new websiteDAO;
                
                $retornoNovaPaginaDAO = $novaPaginaDAO->dadosPaginaDAO($pagina);

                if ($retornoNovaPaginaDAO != false){
                    return $retornoNovaPaginaDAO;
                }else{
                    return false;
                }
            }catch(Exception  $e){
                return $e->getMessage();
            }
        }

        function dadosGridVO($pagina){
            try{
                $novosGridsDAO = new websiteDAO;
                
                $retornoNovosGridsDAO = $novosGridsDAO->dadosGridsDAO($pagina);

                if ($retornoNovosGridsDAO != false){
                    return $retornoNovosGridsDAO;
                }else{
                    return false;
                }
            }catch(Exception  $e){
                return $e->getMessage();
            }
        }

        function loginVO($nome, $senha){
            try{
                $novologinDAO = new websiteDAO;
                
                $retornoNovologinDAO = $novologinDAO->loginDAO($nome, $senha);

                if ($retornoNovologinDAO != false){
                    return $retornoNovologinDAO;
                }else{
                    return false;
                }
            }catch(Exception  $e){
                return $e->getMessage();
            }
        }

        function buscaUsuarioEmailVO($email){
            try{
                $novaBuscaUsuarioEmailDAO = new websiteDAO;
                
                $retornoNovaBuscaUsuarioEmailDAO = $novaBuscaUsuarioEmailDAO->buscaUsuarioEmailDAO($email);

                if ($retornoNovaBuscaUsuarioEmailDAO != false){
                    return $retornoNovaBuscaUsuarioEmailDAO;
                }else{
                    return false;
                }
            }catch(Exception  $e){
                return $e->getMessage();
            }
        }

        function buscaUsuarioNomeVO($nome){
            try{
                $novaBuscaUsuarioNomeDAO = new websiteDAO;
                
                $retornoNovaBuscaUsuarioNomeDAO = $novaBuscaUsuarioNomeDAO->buscaUsuarioNomeDAO($nome);

                if ($retornoNovaBuscaUsuarioNomeDAO != false){
                    return $retornoNovaBuscaUsuarioNomeDAO;
                }else{
                    return false;
                }
            }catch(Exception  $e){
                return $e->getMessage();
            }
        }

        function pontuacoesVO($email){
            try{
                $novoPontuacoesDAO = new websiteDAO;
                
                $retornoNovoPontuacoesDAO = $novoPontuacoesDAO->pontuacoesDAO($email);

                if ($retornoNovoPontuacoesDAO != false){
                    return $retornoNovoPontuacoesDAO;
                }else{
                    return false;
                }
            }catch(Exception  $e){
                return $e->getMessage();
            }
        }

        function ranqueGeralVO($nomeGame){
            try{
                $novoRanqueGeralDAO = new websiteDAO;
                
                $retornoNovoRanqueGeralDAO = $novoRanqueGeralDAO->ranqueGeralDAO($nomeGame);

                if ($retornoNovoRanqueGeralDAO != false){
                    return $retornoNovoRanqueGeralDAO;
                }else{
                    return false;
                }
            }catch(Exception  $e){
                return $e->getMessage();
            }
        }

        # CADASTRO
        function cadastroUsuarioVO($valorParam1, $valorParam2, $valorParam3, $valorParam4){
            try{
                $novoCadastroUsuarioDAO = new websiteDAO;
                
                $retornoNovoCadastroUsuarioDAO = $novoCadastroUsuarioDAO->cadastroUsuarioDAO($valorParam1, $valorParam2, $valorParam3, $valorParam4);

                if ($retornoNovoCadastroUsuarioDAO != false){
                    return $retornoNovoCadastroUsuarioDAO;
                }else{
                    return false;
                }
            }catch(Exception  $e){
                return $e->getMessage();
            }
        }

        function vincularUsuarioGameVO($valorParam1, $valorParam2, $valorParam3, $valorParam4){
            try{
                $novoVincularUsuarioGameDAO = new websiteDAO;
                
                $retornoNovoVincularUsuarioGameDAO = $novoVincularUsuarioGameDAO->vincularUsuarioGameDAO($valorParam1, $valorParam2, $valorParam3, $valorParam4);

                if ($retornoNovoVincularUsuarioGameDAO != false){
                    return $retornoNovoVincularUsuarioGameDAO;
                }else{
                    return false;
                }
            }catch(Exception  $e){
                return $e->getMessage();
            }
        }

        # ATUALIZAR
        function atualizarPontosVO($valorParam1, $valorParam2, $valorParam3, $valorParam4){
            try{
                $novaAtualizacaoPontosDAO = new websiteDAO;
                
                $retornoNovaAtualizacaoPontosDAO = $novaAtualizacaoPontosDAO->atualizarPontosDAO($valorParam1, $valorParam2, $valorParam3, $valorParam4a);

                if ($retornoNovaAtualizacaoPontosDAO != false){
                    return $retornoNovaAtualizacaoPontosDAO;
                }else{
                    return false;
                }
            }catch(Exception  $e){
                return $e->getMessage();
            }
        }
    }
?>