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
    }

    $novoDadosPagina = $novoWebsiteVO->dadosPaginaVO($pagina);

?>
        <?php include_once(__DIR__.'/static/main/cabecalho.php');?>

        <title> <?php echo $novoDadosPagina['nome']; ?> </title>
        <meta name="description" content="<?php echo $novoDadosPagina['descricao']; ?>">
        <meta name="keywords" content="<?php echo $novoDadosPagina['palavraschave']; ?>">
        <link href="static/css/game.css" rel="stylesheet">
        </head>

    <body>
        <header>
            <?php include_once(__DIR__.'/static/main/menu.php');?>			
		</header>
        <!-- Main -->
        <main>
            <?php if (isset($_SESSION['UID']) && !empty($_SESSION['UID']) and isset($_SESSION['NOME']) && !empty($_SESSION['NOME']) and isset($_SESSION['EMAIL']) && !empty($_SESSION['EMAIL']) and isset($_SESSION['STATUS']) && !empty($_SESSION['STATUS'])): ?>
                <!-- Minha conta -->		
                <div class="ui placeholder segment ui autumn leaf" id="uiMinhaConta">
                    <div class="ui two column very relaxed stackable grid">
                        <div class="column">
                            <form class="ui form" id="formularioAlterarSenha">
                                <div class="field" id="fieldSenha1Atualizar">
                                    <label>Nova senha</label>
                                    <div class="ui left icon input disabled">
                                        <input type="password" name="senha1Atualizar" id="senha1Atualizar">
                                        <i class="lock icon"></i>
                                    </div>
                                    <div id="mensageSenha1Atualizar">
                                    </div>
                                </div>
                                <div class="field" id="fieldSenha2Atualizar">
                                    <label>Repetir nova senha</label>
                                    <div class="ui left icon input disabled">
                                        <input type="password" name="senha2Atualizar" id="senha2Atualizar">
                                        <i class="lock icon"></i>
                                    </div>
                                    <div id="mensageSenha2Atualizar">
                                    </div>
                                    <div id="mensageSenhasAtualizar">
                                    </div>
                                </div>
                                <div class="ui blue submit button disabled" id="btnSenhaAtualizar">
                                    Atualizar
                                </div>
                            </form>
                        </div>
                        <div class="middle aligned column">
                            <!-- Pontuações -->
                            <p>Minhas pontuações</p>
                            <div class="ui two column centered grid">
                                <div class="column">
                                <table class="ui attached table">
                                    <thead>
                                    <tr><th class="ten wide">Game</th>
                                    <th class="six wide">Pontos</th>
                                    </tr></thead>
                                    <tbody id="minhasPontuacoes">
                                    </tbody>
                                    <tfoot id="meuTotalJogos">
                                        <tr>
                                            <th>Total de Jogos</th>
                                            <th>0</th>
                                        </tr>
                                    </tfoot>
                                </table>
                                </div>
                            </div>
                            <!-- // Pontuações -->
                        </div>
                    </div>
                    <div class="ui vertical divider"></div>
                </div>
                <!-- // Minha conta -->
            <?php else: ?>
                <!-- Login -->		
                <div class="ui placeholder segment ui autumn leaf" id="uiLogin">
                    <div class="ui two column very relaxed stackable grid">
                        <div class="column">
                            <form class="ui form" id="formularioLogin">
                                <div class="field" id="fieldUsuarioLogin">
                                    <label>Usuário</label>
                                    <div class="ui left icon input">
                                        <input type="text" placeholder="Usuário" name="usuarioLogin" id="usuarioLogin">
                                        <i class="user icon"></i>
                                    </div>
                                    <div id="mensageUsuarioLogin">
                                    </div>
                                </div>
                                <div class="field" id="fieldSenhaLogin">
                                    <label>Senha</label>
                                    <div class="ui left icon input">
                                        <input type="password" name="senhaLogin" id="senhaLogin">
                                        <i class="lock icon"></i>
                                    </div>
                                    <div id="mensageSenhaLogin">
                                    </div>
                                    <div id="mensageLogin">
                                    </div>
                                </div>
                                <div class="ui blue submit button" id="btnLogin">
                                    Login
                                </div>
                            </form>
                        </div>
                        <div class="middle aligned column">
                            <div class="ui big button" id="btnCadastro">
                                <i class="signup icon"></i>
                                Cadastro
                            </div>
                            
                        </div>
                    </div>
                    <div class="ui vertical divider">
                        Ou
                    </div>
                </div>
                <!-- // login -->
            <?php endif; ?>

            <!-- GAME DA MEMÓRIA COM ICONES -->
            <!-- Descrição -->
            <div class="ui vertical stripe segment">
                <div class="ui middle aligned stackable grid container">
                    <div class="row">
                        <div class="eight wide column">
                            <h3 class="ui header">Jogo da memória</h3>
                            <p>Este é um jogo da memória com icones com código fonte aberto e livre, desenvolvido em HTML5, CSS3, Javascript, Semantic UI e JQuery.</p>
                            <h3 class="ui header">Informações e regras</h3>
                            <ul>
                                <li>Os botões 'Começar' e 'Sair', resetam as pontos adquiridos;</li>
                                <li>O botão de 'Nova fase', cria um novo jogo e mantém os pontos atuais, mas caso pressionado antes de terminar a fase perde-se o bônus;</li>
                                <li>Até 50 pontos, o tempo de memorizar os icones são de 4seg, bônus de 5 pontos em acertos sem erros, após o primeiro erro perde-se o bônus, mas não há penalidades em novos erros;</li>
                                <li>A partir de 50 pontos, o bônus passa para 2 e o tempo para memorizar passa a 3seg, em caso de erro é perdido o bônus e descontado 1 ponto por cada erro;</li>
                                <li>Depois dos 100 pontos, não há bônus, erros passam a descontar 2 pontos;</li>
                                <li>Após 150 pontos, o tempo de memorizar é 2seg;</li>
                            </ul>
                        </div>
                        <div class="six wide right floated column">
                            <div class="ui fade reveal image">
                                <img class="visible content" src="static/img/game_memoria.png" width="356" height="356">
                                <img class="hidden content" src="https://github.com/tiagoeo/tiagoeo/blob/main/img/game_memoria.gif" width="356" height="356">
                            </div>
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
                <button class="ui massive labeled icon button" id="btnComecar">
                    <i class="caret right icon"></i>
                    Começar
                </button>
                <div class="ui massive buttons" id="btnExtra">
                    <button class="ui button" id="btnNovaFase">
                        Nova fase
                    </button>
                    <div class="or" data-text="ou"></div>
                    <button class="ui button" id="btnSair">
                        Sair
                    </button>
                </div>
            </div>
            <!-- // Rodapé Game -->
            <!-- // GAME DA MEMÓRIA COM ICONES -->

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
        <script type="text/javascript" src="static/js/game.js"></script>
        <script>
            var minhasPontuacoes;
            $("#btnExtra").hide();
            
            $("#btnComecar").click(function(){
                iniciar('novo_jogo');
            });

            $("#btnNovaFase").click(function(){
                iniciar('nova_fase');
            });

            $("#btnSair").click(function(){
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

            $("#btnLogin").click(function(){
                submitLogin(1);
			});

            $("#btnLoginMenu").click(function(){
                submitLogin(2);
			});

            $("#btnCadastrar").click(function(){
                submitCadastrar();
			});

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
                var dados = {"buscaPontuacoes": '<?php if (isset($_SESSION['UID']) && !empty($_SESSION['UID'])){echo($_SESSION['EMAIL']);} ?>'};
                $.ajax({ 
                    url: "transmitir.php",
                    data: dados,
                    type: "POST",
                    dataType: "json",
                    contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                    success: function(retorno){
                        if (retorno.pontuacoes == true){
                            minhasPontuacoes = retorno;
                            var totalJogos = Object.keys(retorno).length -1;

                            for(i = 0; i <= totalJogos; i++){
                                if (typeof retorno[i] !== 'undefined'){
                                    $('#minhasPontuacoes').html('<tr><td>'+retorno[i].nome+'</td><td>'+retorno[i].pontos+'</td></tr>');
                                    if (retorno[i].idgame == 1){
                                        pontos = retorno[i].pontos;
                                        $('#pontos').html(parseInt(retorno[i].pontos));
                                    }
                                }
                            }

                            $('#meuTotalJogos').html('<tr><th>Total de Jogos</th><th>'+totalJogos+'</th></tr>');
                        }else{
                            $('#meuTotalJogos').html('<tr><th>Falha ao buscar informações.</th></tr>');
                        }
                    },
                    beforeSend: function() { 
                        $('#minhasPontuacoes').html('<div class="ui active loader"></div>');
                    },
                    error: function(e) {
                        $('#meuTotalJogos').html('<tr><th>Erro: ao buscar informações.</th></tr>');
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