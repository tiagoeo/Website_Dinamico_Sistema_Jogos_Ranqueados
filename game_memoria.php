<?php
	include(__DIR__.'/vo/websiteVO.php');
    sec_session_start();

    $novoWebsiteVO = new websiteVO;
    $pagina = 2;

    $novoDadosWebsite = $novoWebsiteVO->dadosWebsiteVO();
    if (!$novoDadosWebsite){
        $novoDadosWebsite['nome'] = 'Falha no acesso ao banco de dados, entre em contato com o suporte';
        $novoDadosWebsite['telefone'] = '91999999999';
        $novoDadosWebsite['manutencao'] = '1';

        $novoDadosPagina['nome'] = 'Modo manutenção';
        $novoDadosPagina['descricao'] = 'Website dinâmico em modo manutenção';
        $novoDadosPagina['palavraschave'] = 'Site em manutenção';

        $novoDadosGrid = false;
    }else{
        $novoDadosPagina = $novoWebsiteVO->dadosPaginaVO($pagina);
    }
?>
        <?php include_once(__DIR__.'/static/main/cabecalho.php');?>

        <title> <?php echo $novoDadosPagina['nome']; ?> </title>
        <meta name="description" content="<?php echo $novoDadosPagina['descricao']; ?>">
        <meta name="keywords" content="<?php echo $novoDadosPagina['palavraschave']; ?>">
        <link rel="stylesheet" type="text/css" href="static/css/game_memoria.css">
        </head>

    <body>
        <header>
            <?php include_once(__DIR__.'/static/main/menu.php');?>			
		</header>
        <!-- Main -->
        <main>
            <?php if ($novoDadosWebsite['manutencao'] != '1'): ?>
                <!-- Minha conta -->	
                <?php include_once(__DIR__.'/static/main/menu_conta.php');?>		
                <!-- // Minha conta -->

                <!-- GAME DA MEMÓRIA COM ICONES -->
                <!-- Descrição -->
                <div class="ui vertical stripe segment">
                    <div class="ui middle aligned stackable grid container">
                        <div class="row">
                            <div class="eight wide column">
                                <h3 class="ui header">Jogo da memória</h3>
                                <p id="lblSobre">Este é um jogo da memória com icones com código fonte aberto e livre, desenvolvido em PHP em POO e arquitetura MVC, HTML5, CSS3, Javascript, Semantic UI e JQuery com sincronizações AJAX.</p>
                                <h3 class="ui header">Informações e regras</h3>
                                <ul>
                                    <li>No 'Modo Livre' inicia o jogo sem a necessidade de logar, contudo não pontua no ranque do site;</li>
                                    <li>Em 'Modo Ranqueado' é necessário login e criar um vinculo com o game, será carregado o jogo com a ultima pontuação salva, mantendo a dificuldade em relação ao pontos;</li>
                                    <li>O botão de 'Nova fase', cria um novo jogo e mantém os pontos atuais, mas caso pressionado antes de terminar a fase perde-se o bônus;</li>
                                    <li>Até 50 pontos, o tempo de memorizar os icones são de 4seg, bônus de 5 pontos em acertos sem erros, após o primeiro erro perde-se o bônus, mas não há penalidades em novos erros;</li>
                                    <li>A partir de 50 pontos, o bônus passa para 2 e o tempo para memorizar passa a 3seg, em caso de erro é perdido o bônus e descontado 1 ponto por cada erro;</li>
                                    <li>Depois dos 100 pontos, não há bônus, erros passam a descontar 2 pontos;</li>
                                    <li>Após 150 pontos, o tempo de memorizar é 2seg;</li>
                                </ul>
                            </div>
                            <div class="six wide right floated column">
                                <img class="visible content" src="static/img/game_memoria.png" width="356" height="356">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- // Descrição -->
                <!-- Pontuações -->
                <div class="ui centered card">
                    <div class="content">
                        <div class="center aligned header">
                            <div class="ui two column centered grid">
                                <div class="ui statistics">
                                    <div class="teal statistic">
                                        <div class="value" id="pontos">
                                            0
                                        </div>
                                        <div class="label">
                                            Pontos
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="extra content">
                        <div class="center aligned author">
                            <div class="ui indicating progress" data-value="0" data-total="6" id="gameProgresso">
                                <div class="bar">
                                    <div class="progress"></div>
                                </div>
                                <div class="label">Progresso</div>
                            </div>
                        </div>
                        <div id="gameBonus">
                            <i class="circular star icon link" data-tooltip="Bônus de 5x" data-position="right center">
                                <i class="smile outline icon"></i>
                            </i>
                        </div>
                    </div>
                </div>
                <!-- // Pontuações -->

                <!-- Game -->
                <div class="ui middle aligned stackable grid container">
                    <div class="ui four cards centered" id="btns">
                        <div class="card">
                            <button class="ui disabled icon button" id="btn0" name="btn">
                                <i class="huge icon"></i>
                            </button>
                        </div>
                        <div class="card">
                            <button class="ui disabled icon button" id="btn1" name="btn">
                                <i class="huge icon"></i>
                            </button>
                        </div>
                        <div class="card">
                            <button class="ui disabled icon button" id="btn2" name="btn">
                                <i class="huge icon"></i>
                            </button>
                        </div>
                        <div class="card">
                            <button class="ui disabled icon button" id="btn3" name="btn">
                                <i class="huge icon"></i>
                            </button>
                        </div>
                        <div class="card">
                            <button class="ui disabled icon button" id="btn4" name="btn">
                                <i class="huge icon"></i>
                            </button>
                        </div>
                        <div class="card">
                            <button class="ui disabled icon button" id="btn5" name="btn">
                                <i class="huge icon"></i>
                            </button>
                        </div>
                        <div class="card">
                            <button class="ui disabled icon button" id="btn6" name="btn">
                                <i class="huge icon"></i>
                            </button>
                        </div>
                        <div class="card">
                            <button class="ui disabled icon button" id="btn7" name="btn">
                                <i class="huge icon"></i>
                            </button>
                        </div>
                        <div class="card">
                            <button class="ui disabled icon button" id="btn8" name="btn">
                                <i class="huge icon"></i>
                            </button>
                        </div>
                        <div class="card">
                            <button class="ui disabled icon button" id="btn9" name="btn">
                                <i class="huge icon"></i>
                            </button>
                        </div>
                        <div class="card">
                            <button class="ui disabled icon button" id="btn10" name="btn">
                                <i class="huge icon"></i>
                            </button>
                        </div>
                        <div class="card">
                            <button class="ui disabled icon button" id="btn11" name="btn">
                                <i class="huge icon"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- // Game -->

                <!-- Rodapé Game -->
                <div class="ui two column centered grid" id="rodape">
                    <div class="ui massive buttons disabled" id="btnModoLR">
                        <button class="ui button" id="btnModoLivre">
                            <i class="coffee icon"></i>
                            Modo Livre
                        </button>
                        <div class="or" data-text="ou"></div>
                        <button class="ui button" id="btnModoRanqueado">
                            <i class="chart line icon"></i>
                            Modo Ranqueado
                        </button>
                    </div>
                    <?php if (isset($_SESSION['UID']) && !empty($_SESSION['UID']) and isset($_SESSION['NOME']) && !empty($_SESSION['NOME']) and isset($_SESSION['EMAIL']) && !empty($_SESSION['EMAIL']) and isset($_SESSION['STATUS']) && !empty($_SESSION['STATUS'])): ?>
                    <div class="ui massive buttons disabled" id="btnModoRS">
                        <button class="ui button" id="btnNovaFaseRanqueado">
                            <i class="redo icon"></i>
                            Nova Fase
                        </button>
                        <div class="or" data-text="ou"></div>
                        <button class="ui button" id="btnSairModo1">
                            <i class="sign-out icon"></i>
                            Sair
                        </button>
                    </div>
                    <div class="ui massive buttons disabled" id="btnModoVS">
                        <button class="ui button" id="btnVincularRanqueado">
                            <i class="linkify icon"></i>
                            Vincular Game
                        </button>
                        <div class="or" data-text="ou"></div>
                        <button class="ui button" id="btnSairModo2">
                            <i class="sign-out icon"></i>
                            Sair
                        </button>
                    </div>
                    <?php else: ?>
                    <div class="ui massive buttons disabled" id="btnModoLS">
                        <button class="ui button" id="btnLoginModal2">
                            <i class="user icon"></i>
                            Necessário Login
                        </button>
                        <div class="or" data-text="ou"></div>
                        <button class="ui button" id="btnSairModo3">
                            <i class="sign-out icon"></i>
                            Sair
                        </button>
                    </div>
                    <?php endif;?>
                    <div class="ui massive buttons disabled" id="btnModoFS">
                        <button class="ui button" id="btnNovaFaseLivre">
                            <i class="redo icon"></i>
                            Nova fase
                        </button>
                        <div class="or" data-text="ou"></div>
                        <button class="ui button" id="btnSairModo4">
                            <i class="sign-out icon"></i>
                            Sair
                        </button>
                    </div>
                </div>
                <!-- // Rodapé Game -->
                <!-- // GAME DA MEMÓRIA COM ICONES -->
            <?php else: ?>
                <?php header("Location: logout.php"); exit();?>
            <?php endif; ?>
        </main>
        <!-- // Main -->

        <!-- Modal -->
        <div id="modal">
            <?php include(__DIR__.'/static/main/modal.php'); ?>
        </div>
        <!-- // Modal -->

        <!-- Rodapé -->
        <div id="footer">
            <?php include(__DIR__.'/static/main/rodape.php'); ?>
        </div>
        <!-- // Rodapé -->

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/semantic-ui@2.5.0/dist/semantic.min.js"></script>
        <script type="text/javascript" src="static/js/game_memoria.js"></script>
        <script>
            var minhasPontuacoes;
            var pontosCarregados;
            subEDButtons(null, 'modoMenuLivreOuRanqueado');

            $("#btnFooterQuemSomos").click(function(){
                footerModal('<i class="user secret icon icon"></i>Quem somos','<p>Quem somos</p>');
            });

            $("#btnFooterContato").click(function(){
                footerModal('<i class="phone icon"></i>Contato','<p><?php echo($novoDadosWebsite['telefone'])?></p>');
            });

            $("#btnFooterTermos").click(function(){
                footerModal('<i class="paste icon"></i>Termos e condições','<p>Termos e condições</p>');
            });

            $("#btnFooterPoliticaPrivacidade").click(function(){
                footerModal('<i class="file alternate icon"></i>Política de privacidade','<p>Política de privacidade</p>');
            });
            
            $("#btnModoLivre").click(function(){
                iniciar('novo_jogo_livre');
            });

            $("#btnModoRanqueado").click(function(){
                <?php if (isset($_SESSION['UID']) && !empty($_SESSION['UID']) and isset($_SESSION['NOME']) && !empty($_SESSION['NOME']) and isset($_SESSION['EMAIL']) && !empty($_SESSION['EMAIL']) and isset($_SESSION['STATUS']) && !empty($_SESSION['STATUS'])): ?>
                    submitMinhasPontuacoes();
                    var todosJogos = Object.keys(minhasPontuacoes).length -1;

                    if (todosJogos > 0){
                        for(i = 0; i <= todosJogos; i++){
                            if (typeof minhasPontuacoes[i] !== 'undefined'){
                                if (minhasPontuacoes[i].idgame == 1){
                                    iniciar('novo_jogo_ranqueado');
                                    break;
                                }else if(i == todosJogos){
                                    subEDButtons(null, 'modoMenuFaseVincularOuSair');
                                    break;
                                }
                            }else{
                                subEDButtons(null, 'modoMenuFaseVincularOuSair');
                            }
                        }
                    }else{
                        subEDButtons(null, 'modoMenuFaseVincularOuSair');
                    }
                <?php else: ?>
                    subEDButtons(null, 'modoMenuLoginOuSair');
                <?php endif ?>
            });

            $("#btnNovaFaseLivre").click(function(){
                iniciar('nova_fase_livre');
            });

            $("#btnNovaFaseRanqueado").click(function(){
                iniciar('nova_fase_ranqueado');
            });

            $("#btnVincularRanqueado").click(function(){
                submitVincularUsuarioGame(1);
            });

            $("#btnSairModo1").click(function(){
                if(pontosCarregados != pontos){
                    submitAtualizarPontosUsuario(1, pontos);
                }
                
                submitMinhasPontuacoes();
                resetGame('total');
            });

            $("#btnSairModo2").click(function(){
                submitMinhasPontuacoes();
                resetGame('total');
            });

            $("#btnSairModo3").click(function(){
                resetGame('total');
            });

            $("#btnSairModo4").click(function(){
                resetGame('total');
            });

            $("#btn0").click(function(){
                game('#btn0');
            });

            $("#btn1").click(function(){
                game('#btn1');
            });

            $("#btn2").click(function(){
                game('#btn2');
            });

            $("#btn3").click(function(){
                game('#btn3');
            });

            $("#btn4").click(function(){
                game('#btn4');
            });

            $("#btn5").click(function(){
                game('#btn5');
            });

            $("#btn6").click(function(){
                game('#btn6');
            });

            $("#btn7").click(function(){
                game('#btn7');
            });

            $("#btn8").click(function(){
                game('#btn8');
            });

            $("#btn9").click(function(){
                game('#btn9');
            });

            $("#btn10").click(function(){
                game('#btn10');
            });

            $("#btn11").click(function(){
                game('#btn11');
            });

            $("#btnCadastro").click(function(){
                limparRegistros();
                $("#modalCadastro").modal('show');
			});

            $("#btnLoginModal").click(function(){
                limparRegistros();
                $("#modalLogin").modal('show');
			});

            $("#btnLoginModal2").click(function(){
                limparRegistros();
                $("#modalLogin").modal('show');
			});

            $("#btnLogin").click(function(){
                submitLogin(1);
			});
          
            $("#btnLoginMenu").click(function(){
                submitLogin(2);
			});

            $("#btnCadastrar").click(function(){
                submitCadastrar();
			});

            function footerModal(titulo, descricao){
                $("#footerModalTitulo").html(titulo);
                $("#footerModalDescricao").html(descricao);
                $("#footerModal").modal('show');
            }

            function limparRegistros(){
                $('#formularioCadastro').each (function(){
                    this.reset();
                });

                $('#fieldUsuarioCadastro').removeClass('error');
                $('#mensageUsuarioCadastro').html('');

                $('#fieldEmailCadastro').removeClass('error');
                $('#mensageEmailCadastro').html('');

                $('#fieldEmail2Cadastro').removeClass('error');
                $('#mensageEmail2Cadastro').html('');

                $('#fieldSenhaCadastro').removeClass('error');
                $('#mensageSenhaCadastro').html('');

                $('#fieldSenha2Cadastro').removeClass('error');
                $('#mensageSenha2Cadastro').html('');

                $('#mensageCadastro').html('');
                $('#mensageLogin').html('');
                $('#mensageLoginMenu').html('');
            }

            function validarLogin(tipo){
                if (tipo == 1){
                    var usuario = $("#usuarioLogin");
                    var senha = $("#senhaLogin");

                    if(!usuario.val() || usuario.val().length < 3){
                        $('#fieldUsuarioLogin').addClass('error');
                        $('#mensageUsuarioLogin').html('<div class="ui pointing label">Mínimo 3 (três) caracteres</div>');
                        return false;
                    }else{
                        $('#fieldUsuarioLogin').removeClass('error');
                        $('#mensageUsuarioLogin').html('');
                    }

                    if(!senha.val() || senha.val().length < 4){
                        $('#fieldSenhaLogin').addClass('error');
                        $('#mensageSenhaLogin').html('<div class="ui pointing label">Mínimo 4 (quatro) caracteres</div>');
                        return false;
                    }else{
                        $('#fieldSenhaLogin').removeClass('error');
                        $('#mensageSenhaLogin').html('');
                    }
                    return true;
                }else{
                    var usuario = $("#usuarioLoginMenu");
                    var senha = $("#senhaLoginMenu");

                    if(!usuario.val() || usuario.val().length < 3){
                        $('#fieldUsuarioLoginMenu').addClass('error');
                        $('#mensageUsuarioLoginMenu').html('<div class="ui pointing label">Mínimo 3 (três) caracteres</div>');
                        return false;
                    }else{
                        $('#fieldUsuarioLoginMenu').removeClass('error');
                        $('#mensageUsuarioLoginMenu').html('');
                    }

                    if(!senha.val() || senha.val().length < 4){
                        $('#fieldSenhaLoginMenu').addClass('error');
                        $('#mensageSenhaLoginMenu').html('<div class="ui pointing label">Mínimo 4 (quatro) caracteres</div>');
                        return false;
                    }else{
                        $('#fieldSenhaLoginMenu').removeClass('error');
                        $('#mensageSenhaLoginMenu').html('');
                    }
                    return true;
                }
            }

            function validarCadastro(){
                var usuario = $("#usuarioCadastro");
                var email = $("#emailCadastro");
                var email2 = $("#email2Cadastro");
				var senha = $("#senhaCadastro");
                var senha2 = $("#senha2Cadastro");
                var checkbox = $("#checkboxCadastro");

                if(!usuario.val() || usuario.val().length < 3){
					$('#fieldUsuarioCadastro').addClass('error');
                    $('#mensageUsuarioCadastro').html('<div class="ui pointing label">Mínimo 3 (três) caracteres</div>');
					return false;
				}else{
					$('#fieldUsuarioCadastro').removeClass('error');
                    $('#mensageUsuarioCadastro').html('');
				}

                if(!email.val()){
					$('#fieldEmailCadastro').addClass('error');
                    $('#mensageEmailCadastro').html('<div class="ui pointing label">Campo em branco!, digite seu email</div>');
					return false;
				}else if(!validaEmail(email.val())){
					$('#fieldEmailCadastro').addClass('error');
                    $('#mensageEmailCadastro').html('<div class="ui pointing label">Formato de email inválido! ex.: exemplo@exemplo.com</div>');
					return false;
				}else{
					$('#fieldEmailCadastro').removeClass('error');
                    $('#mensageEmailCadastro').html('');
				}

                if(!email2.val()){
					$('#fieldEmail2Cadastro').addClass('error');
                    $('#mensageEmail2Cadastro').html('<div class="ui pointing label">Campo em branco!, digite novamente seu email</div>');
					return false;
				}else if(!validaEmail(email2.val())){
					$('#fieldEmail2Cadastro').addClass('error');
                    $('#mensageEmail2Cadastro').html('<div class="ui pointing label">Formato de email inválido! ex.: exemplo@exemplo.com</div>');
					return false;
				}else if(email.val() != email2.val()){
					$('#fieldEmail2Cadastro').addClass('error');
                    $('#mensageEmail2Cadastro').html('<div class="ui pointing label">Emails diferentes.');
					return false;
                }else{
					$('#fieldEmail2Cadastro').removeClass('error');
                    $('#mensageEmail2Cadastro').html('');
				}
                

				if(!senha.val() || senha.val().length < 4){
					$('#fieldSenhaCadastro').addClass('error');
                    $('#mensageSenhaCadastro').html('<div class="ui pointing label">Mínimo 4 (quatro) caracteres</div>');
					return false;
				}else{
					$('#fieldSenhaCadastro').removeClass('error');
                    $('#mensageSenhaCadastro').html('');
				}

                if(!senha2.val() || senha2.val().length < 4){
					$('#fieldSenha2Cadastro').addClass('error');
                    $('#mensageSenha2Cadastro').html('<div class="ui pointing label">Mínimo 4 (quatro) caracteres</div>');
					return false;
				}else if(senha.val() != senha2.val()){
					$('#fieldSenha2Cadastro').addClass('error');
                    $('#mensageSenha2Cadastro').html('<div class="ui pointing label">Senhas diferentes.');
					return false;
                }else{
					$('#fieldSenha2Cadastro').removeClass('error');
                    $('#mensageSenha2Cadastro').html('');
				}

                if(!checkbox.is(':checked')){
                    $('#fieldCheckboxCadastro').addClass('error');
                    return false;
				}else{
                    $('#fieldCheckboxCadastro').removeClass('error');
                }

				return true;

                function validaEmail(em) {
					var regex = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
					return regex.test(em);
				}
            }

            function submitLogin(tipo) {
                var form;
                if (tipo == 1){
                    form = $("#formularioLogin");
                }else{
                    form = $("#formularioLoginMenu");
                }

				if (validarLogin(tipo)){
					$.ajax({ 
						url: "transmitir.php",
						data: form.serialize(),
						type: "POST",
						dataType: "json",
						contentType: "application/x-www-form-urlencoded; charset=UTF-8",
						success: function(retorno){
							if (retorno.login == true){
                                if (tipo == 1){
                                    $('#mensageLogin').html('<div class="ui pointing label">Login efetuado</div>');
                                }else{
                                    $('#mensageLoginMenu').html('<div class="ui pointing label">Login efetuado</div>');
                                }                                
								window.location.href = "index.php";
							}else{
                                if (tipo == 1){
                                    $('#mensageLogin').html('<div class="ui pointing label">Usuário ou senha incorretos</div>');
                                    $('#formularioLogin').removeClass('loading');
                                }else{
                                    $('#mensageLoginMenu').html('<div class="ui pointing label">Usuário ou senha incorretos</div>');
                                    $('#formularioLoginMenu').removeClass('loading');
                                }
                                
                            }
                            
						},
						beforeSend: function() { 
                            if (tipo == 1){
                                $('#formularioLogin').addClass('loading');
                            }else{
                                $('#formularioLoginMenu').addClass('loading');
                            }
						},
						error: function(e) {
                            if (tipo == 1){
                                $('#formularioLogin').removeClass('loading');
                            }else{
                                $('#formularioLoginMenu').removeClass('loading');
                            }
                            //console.log('erro - '+Object.values(e));
						}
					});
				}		
			}

            function submitCadastrar() {
				if (validarCadastro()){
					$.ajax({ 
						url: "transmitir.php",
						data: $("#formularioCadastro").serialize(),
						type: "POST",
						dataType: "json",
						contentType: "application/x-www-form-urlencoded; charset=UTF-8",
						success: function(retorno){
							if (retorno.cadastro == true){
                                $('#mensageCadastro').html('<div class="ui pointing label">Cadastro efetuado</div>');
								//window.location.href = "index.php";
							}else{
                                $('#mensageCadastro').html('<div class="ui pointing label">Falha no cadastro: usuário ou email já registrados?.</div>');
                            }
                            $('#formularioCadastro').removeClass('loading');
						},
						beforeSend: function() { 
							$('#formularioCadastro').addClass('loading');
						},
						error: function(e) {
							$('#formularioCadastro').removeClass('loading');
                            //console.log('erro - '+Object.values(e));
                            $('#mensageCadastro').html('<div class="ui pointing label">Erro ao cadastrar.</div>');
						}
					});
				}		
			}

            function submitMinhasPontuacoes() {
                var dados = {"buscaPontuacoes": '<?php if (isset($_SESSION['EMAIL']) && !empty($_SESSION['EMAIL'])){echo($_SESSION['EMAIL']);} ?>'};
                $.ajax({ 
                    url: "transmitir.php",
                    data: dados,
                    type: "POST",
                    dataType: "json",
                    contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                    success: function(retorno){
                        if (retorno.pontuacoes == true){
                            minhasPontuacoes = retorno;
                            var totalJogos = Object.keys(retorno).length-1;

                            $('#minhasPontuacoes').html('');
                            for(i = 0; i <= totalJogos; i++){
                                if (typeof retorno[i] !== 'undefined'){
                                    $('#minhasPontuacoes').append('<tr><td>'+retorno[i].nome+'</td><td>'+retorno[i].pontos+'</td></tr>');
                                }
                            }

                            $('#meuTotalJogos').html('<tr><th>Total de Jogos</th><th>'+totalJogos+'</th></tr>');
                        }else{
                            minhasPontuacoes = false;
                            $('#meuTotalJogos').html('<tr><th>Usuário sem games vinculados.</th></tr>');
                        }
                        $('#btnModoRanqueado').html('<i class="chart line icon"></i>Modo Ranqueado');
                        $('#btnModoRanqueado').removeClass('disabled');
                    },
                    beforeSend: function() { 
                        $('#minhasPontuacoes').html('<div class="ui active loader"></div>');
                        $('#btnModoRanqueado').addClass('disabled');
                        $('#btnModoRanqueado').html('<i class="loading spinner icon"></i>Modo Ranqueado');
                        
                    },
                    error: function(e) {
                        $('#meuTotalJogos').html('<tr><th>Erro: ao buscar informações.</th></tr>');
                        $('#btnModoRanqueado').html('<i class="chart line icon"></i>Modo Ranqueado');
                        $('#btnModoRanqueado').removeClass('disabled');
                    }
                });
			}

            function submitVincularUsuarioGame(uidgame) {
                var dados = {"uidusuariovincular": '<?php if (isset($_SESSION['UID']) && !empty($_SESSION['UID'])){echo($_SESSION['UID']);} ?>', "uidgamevincular": uidgame, "buscausuariovincular": '<?php if (isset($_SESSION['EMAIL']) && !empty($_SESSION['EMAIL'])){echo($_SESSION['EMAIL']);} ?>'};
                $.ajax({ 
                    url: "transmitir.php",
                    data: dados,
                    type: "POST",
                    dataType: "json",
                    contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                    success: function(retorno){
                        if (retorno.vinculo == true){
                            submitMinhasPontuacoes();
                            subEDButtons(null, 'modoMenuFaseRanqueadaOuSair');
                        }else{
                            subEDButtons(null, 'modoMenuFaseVincularOuSair');
                        }
                        $('#btnVincularRanqueado').html('<i class="linkify icon"></i>Vincular Game');
                        $('#btnVincularRanqueado').removeClass('disabled');
                    },
                    beforeSend: function() { 
                        $('#btnVincularRanqueado').addClass('disabled');
                        $('#btnVincularRanqueado').html('<i class="loading spinner icon"></i>Vincular Game');
                        
                    },
                    error: function(e) {
                        $('#btnVincularRanqueado').html('<i class="linkify icon"></i>Vincular Game');
                        $('#btnVincularRanqueado').removeClass('disabled');
                    }
                });
			}

            function submitAtualizarPontosUsuario(uidgame, pontosUsuario) {
                var dados = {"uidusuarioatualizar": '<?php if (isset($_SESSION['UID']) && !empty($_SESSION['UID'])){echo($_SESSION['UID']);} ?>', "uidgameatualizar": uidgame, "pontosatualizar": pontosUsuario, "extrasatualizar": '['+pontosUsuario+']'};
                $.ajax({ 
                    url: "transmitir.php",
                    data: dados,
                    type: "POST",
                    dataType: "json",
                    contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                    success: function(retorno){
                        if (retorno.atualizacao == true){
                            submitMinhasPontuacoes();
                        }
                        $('#btnNovaFaseRanqueado').html('<i class="redo icon"></i>Nova Fase');
                        subEDButtons('#btnNovaFaseRanqueado', 'removeClassDisabled');
                        subEDButtons('#btnSairModo1', 'removeClassDisabled');
                    },
                    beforeSend: function() { 
                        subEDButtons('#btnNovaFaseRanqueado', 'addClassDisabled');
                        subEDButtons('#btnSairModo1', 'addClassDisabled');
                        $('#btnNovaFaseRanqueado').html('<i class="loading spinner icon"></i> Nova Fase');
                        
                    },
                    error: function(e) {
                        $('#btnNovaFaseRanqueado').html('<i class="redo icon"></i> Nova Fase');
                        subEDButtons('#btnNovaFaseRanqueado', 'removeClassDisabled');
                        subEDButtons('#btnSairModo1', 'removeClassDisabled');
                    }
                });
			}

            <?php if (isset($_SESSION['UID']) && !empty($_SESSION['UID']) and isset($_SESSION['NOME']) && !empty($_SESSION['NOME']) and isset($_SESSION['EMAIL']) && !empty($_SESSION['EMAIL']) and isset($_SESSION['STATUS']) && !empty($_SESSION['STATUS'])): ?>
            $(window).on("load", function() {
				submitMinhasPontuacoes();
			});
            <?php endif ?>	
        </script>
    </body>
</html>