<?php
	include(__DIR__.'/vo/websiteVO.php');
    sec_session_start();

    $novoWebsiteVO = new websiteVO;
    $pagina = 1;

    $novoDadosWebsite = $novoWebsiteVO->dadosWebsiteVO();
    if (!$novoDadosWebsite){
        $novoDadosWebsite['nome'] = 'Falha no acesso ao banco de dados, entre em contato com o suporte';
        $novoDadosWebsite['telefone'] = '91999999999';
        $novoDadosWebsite['manutencao'] = '1';
    }

    $novoDadosPagina = $novoWebsiteVO->dadosPaginaVO($pagina);
    $novoDadosGrid = $novoWebsiteVO->dadosGridVO(intval($novoDadosPagina['idpagina']));

?>
        <?php include_once(__DIR__.'/static/main/cabecalho.php');?>

        <title> <?php echo $novoDadosPagina['nome']; ?> </title>
        <meta name="description" content="<?php echo $novoDadosPagina['descricao']; ?>">
        <meta name="keywords" content="<?php echo $novoDadosPagina['palavraschave']; ?>">
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
                                <div class="ui blue submit button" id="btnSenhaAtualizar">
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
                                    <tbody>
                                        <?php $novoDadosRanqueUsuario = $novoWebsiteVO->pontuacoesVO($_SESSION['EMAIL']); foreach ($novoDadosRanqueUsuario as $chave => $valor): ?>
                                            <tr>
                                                <td><?php echo $valor['nome'];?></td>
                                                <td><?php echo $valor['pontos'];?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                    <tfoot>
                                    <tr><th>Total de Jogos</th>
                                    <th><?php echo count($novoDadosRanqueUsuario);?></th>
                                    </tr></tfoot>
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

            <!-- Descrição Game -->
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
                                <p>Classificação</p>
                                <div class="ui two column centered grid">
                                    <div class="column">
                                    <table class="ui attached table">
                                        <thead>
                                        <tr><th class="ten wide">Nome</th>
                                        <th class="six wide">Pontos</th>
                                        </tr></thead>
                                        <tbody>
                                            <?php $novoDadosRanque = $novoWebsiteVO->ranqueGeralVO($valor['titulo']); for ($i=0; count($novoDadosRanque); $i++): ?>
                                                <?php if ($i < 3): ?>
                                                <tr>
                                                    <td><?php echo $novoDadosRanque[$i]['nome'];?></td>
                                                    <td><?php echo $novoDadosRanque[$i]['pontos'];?></td>
                                                </tr>
                                                <?php else: break; ?>
                                                <?php endif; ?>
                                            <?php endfor; ?>
                                        </tbody>
                                        <tfoot>
                                        <tr><th>Total de jogadores</th>
                                        <th><?php echo count($novoDadosRanque);?></th>
                                        </tr></tfoot>
                                    </table>
                                    </div>
                                </div>
                                <!-- // Classificação -->
                            </div>
                        </div>
                        <div class="row">
                            <div class="center aligned column">
                                <a class="ui huge button" href="<?php echo $valor['botaoLink'];?>" ><?php echo $valor['botaoNome'];?></a>
                            </div>
                        </div>
                    </div> 
                </div>
                <div class="ui section divider"></div>
            <?php endforeach; ?>
            <!-- // Descrição Game -->

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
            $("#btnCadastro").click(function(){
                limparCadastro();
                $("#modalCadastro").modal('show');
			});

            $("#btnLogin").click(function(){
                submitLogin();
			});

            $("#btnCadastrar").click(function(){
                submitCadastrar();
			});

            function limparCadastro(){
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
            }

            function validarLogin(){
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

            function submitLogin() {
				if (validarLogin()){
					$.ajax({ 
						url: "transmitir.php",
						data: $("#formularioLogin").serialize(),
						type: "POST",
						dataType: "json",
						contentType: "application/x-www-form-urlencoded; charset=UTF-8",
						success: function(retorno){
							if (retorno.login == true){
                                $('#mensageLogin').html('<div class="ui pointing label">Login efetuado</div>');
								//window.location.href = "index.php";
							}else{
                                $('#mensageLogin').html('<div class="ui pointing label">Usuário ou senha incorretos</div>');
                            }
                            $('#formularioLogin').removeClass('loading');
						},
						beforeSend: function() { 
							$('#formularioLogin').addClass('loading');
						},
						error: function(e) {
							$('#formularioLogin').removeClass('loading');
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
                                $('#mensageCadastro').html('<div class="ui pointing label">Falha ao cadastrar.</div>');
                            }
                            $('#formularioCadastro').removeClass('loading');
						},
						beforeSend: function() { 
							$('#formularioCadastro').addClass('loading');
						},
						error: function(e) {
							$('#formularioCadastro').removeClass('loading');
                            console.log('erro - '+Object.values(e));
						}
					});
				}		
			}
        </script>
    </body>
</html>