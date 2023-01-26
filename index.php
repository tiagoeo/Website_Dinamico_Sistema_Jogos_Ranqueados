<?php
	include(__DIR__.'/vo/websiteVO.php');
    sec_session_start();

    $novoWebsiteVO = new websiteVO;
    $novoDadosPagina;
    $novoDadosGrid;
    $pagina = 1;

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
        $novoDadosGrid = $novoWebsiteVO->dadosGridVO(intval($novoDadosPagina['idpagina']));
    }
?>
        <?php include_once(__DIR__.'/static/main/cabecalho.php');?>

        <title> <?php echo $novoDadosPagina['nome']; ?> </title>
        <meta name="description" content="<?php echo $novoDadosPagina['descricao']; ?>">
        <meta name="keywords" content="<?php echo $novoDadosPagina['palavraschave']; ?>">
        </head>

    <body onLoad="testeJavascript();">
        <header>
            <?php include_once(__DIR__.'/static/main/menu.php');?>			
		</header>
        <!-- Main -->
        <main>
            <?php if ($novoDadosWebsite['manutencao'] != '1'): ?>
                <!-- Menu conta -->
                <?php include_once(__DIR__.'/static/main/menu_conta.php');?>		
                <!-- // Menu conta -->

                <!-- Descrição Game -->
                <?php if ($novoDadosGrid != false): ?>
                    <?php foreach ($novoDadosGrid as $chave => $valor): ?>
                        <div class="ui vertical stripe segment"> 
                            <div class="ui middle aligned stackable grid container">
                                <div class="row"> 
                                    <div class="eight wide column"> 
                                        <h3 class="ui header"><?php echo $valor['titulo'];?></h3> 
                                        <p><?php echo $valor['descricao'];?></p>
                                    </div>
                                    <div class="eight wide right floated column"> 
                                        <!-- Classificação -->
                                        <p id="lblClassificacao"><i class="sort amount up icon"></i><b>Classificação</b></p>
                                        <div class="ui two column centered grid">
                                            <div class="column">
                                            <table class="ui attached table">
                                                <thead>
                                                <tr><th class="ten wide">Nome</th>
                                                <th class="six wide">Pontos</th>
                                                </tr></thead>
                                                <tbody>
                                                    <?php $novoDadosRanque = $novoWebsiteVO->ranqueGeralVO($valor['titulo']); if ($novoDadosRanque != false): ?>
                                                        <?php for ($i=0; $i < count($novoDadosRanque); $i++): ?>
                                                            <?php if ($i < 3): ?>
                                                            <tr>
                                                                <td><?php echo $novoDadosRanque[$i]['nome'];?></td>
                                                                <td><?php echo $novoDadosRanque[$i]['pontos'];?></td>
                                                            </tr>
                                                            <?php else: break; ?>
                                                            <?php endif; ?>
                                                        <?php endfor; ?>
                                                    <?php endif; ?>
                                                </tbody>
                                                <tfoot>
                                                <tr><th>Total de jogadores</th>
                                                <th><?php if ($novoDadosRanque != false){echo count($novoDadosRanque);}else{echo('0');}?></th>
                                                </tr></tfoot>
                                            </table>
                                            </div>
                                        </div>
                                        <!-- // Classificação -->
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="center aligned column">
                                        <a class="ui huge button" href="<?php echo $valor['botaolink'];?>" ><?php echo $valor['botaonome'];?></a>
                                    </div>
                                </div>
                            </div> 
                        </div>
                        <div class="ui section divider"></div>
                    <?php endforeach; ?>
                <?php endif; ?>
                <!-- // Descrição Game -->
            <?php else: ?>
                <h2 class="ui center aligned icon header" id="lblHeaderModoManutencao">
                    <i class="circular settings icon"></i>
                    Modo Manutenção
                </h2>

                <?php if ($testeDadosWebsite = $novoWebsiteVO->dadosWebsiteVO() != false):  ?>
                    <div class="ui grid center aligned">
                        <div class="eight wide column" id="lblDescModoManutencao">
                            <div class="ui segment">
                            <p> Webite em manutenção - contate o administrador para mais informações.</p>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="ui grid center aligned">
                        <div class="eight wide column">
                            <table class="ui celled table" id="lblTabelaModoManutencao">
                                <thead>
                                    <tr>
                                        <th>Sevidor</th>
                                        <th class="ui center aligned">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr <?php echo('class="positive"') ?>>
                                        <td>PHP</td>
                                        <td class="ui center aligned"><i class="icon checkmark"></i>OK - Versão: <?php echo(phpversion()); ?></td>
                                    </tr>
                                    <tr class="positive">
                                        <td>CSS3</td>
                                        <td class="ui center aligned" id="testeCSSModoManutencao"><i class="icon close"></i>Falha</td>
                                    </tr>
                                    <tr class="negative" id="testeJavascriptModoManutencao">
                                        <td>Javascript</td>
                                        <td class="ui center aligned"><i class="icon close"></i>Falha</td>
                                    </tr>
                                    <?php if ($testeDadosWebsite = $novoWebsiteVO->dadosWebsiteVO() == false):  ?>
                                    <tr class="negative">
                                        <td>Banco de dados</td>
                                        <td class="ui center aligned">
                                            <i class="icon close"></i>
                                            Falha
                                        </td>
                                    </tr>
                                    <?php elseif ($novoDadosWebsite['manutencao'] == '1'): ?>
                                    <tr class="positive">
                                        <td>Banco de dados</td>
                                        <td class="ui center aligned">
                                            <i class="icon checkmark"></i>
                                            OK
                                        </td>
                                    </tr>
                                    <?php endif;?>
                                </tbody>
                            </table>
                        </div>
                    <div>
                <?php endif; ?>   
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
        <script>
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

            function testeJavascript(){
                $('#testeJavascriptModoManutencao').removeClass('negative');
                $('#testeJavascriptModoManutencao').addClass('positive');
                $('#testeJavascriptModoManutencao').html('<td>Javascript</td><td class="ui center aligned"><i class="icon checkmark"></i>OK</td>');
            }

            <?php if (isset($_SESSION['UID']) && !empty($_SESSION['UID']) and isset($_SESSION['NOME']) && !empty($_SESSION['NOME']) and isset($_SESSION['EMAIL']) && !empty($_SESSION['EMAIL']) and isset($_SESSION['STATUS']) && !empty($_SESSION['STATUS'])): ?>
            $(window).on("load", function() {
				submitMinhasPontuacoes();
			});
            <?php endif ?>	
        </script>
    </body>
</html>