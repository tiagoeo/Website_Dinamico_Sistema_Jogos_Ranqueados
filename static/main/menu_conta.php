<?php if (isset($_SESSION['UID']) && !empty($_SESSION['UID']) and isset($_SESSION['NOME']) && !empty($_SESSION['NOME']) and isset($_SESSION['EMAIL']) && !empty($_SESSION['EMAIL']) and isset($_SESSION['STATUS']) && !empty($_SESSION['STATUS'])): ?>	
    <!-- // Minha conta -->
    <div class="ui placeholder segment ui autumn leaf" id="uiMinhaConta">
        <div class="ui two column very relaxed stackable grid">
            <div class="column">
                <form class="ui form" id="formularioAlterar">
                    <div class="field" id="fieldUsuarioAlterar">
                        <label>Usuario</label>
                        <div class="ui left icon input disabled">
                            <input type="text" name="sessionNome" id="sessionNome" placeholder="<?php echo($_SESSION['NOME']) ?>">
                            <i class="bug icon"></i>
                        </div>
                        <div id="mensageUsuarioAtualizar">
                        </div>
                    </div>
                    <div class="field" id="fieldEmailAlterar">
                        <label>Email</label>
                        <div class="ui left icon input disabled">
                            <input type="text" name="sessionEmail" id="sessionEmail" placeholder="<?php echo($_SESSION['EMAIL']) ?>">
                            <i class="envelope icon"></i>
                        </div>
                        <div id="mensageEmailAtualizar">
                        </div>
                        <div id="mensageFormularioAtualizar">
                        </div>
                    </div>
                    <!--<div class="ui blue submit button disabled" id="btnFormularioAtualizar">
                        Atualizar
                    </div> -->
                </form>
            </div>
            <div class="middle aligned column">
                <!-- Pontuações -->
                <p id="lblMinhasPontuacoes"><i class="sort numeric up icon"></i><b>Minhas pontuações</b></p>
                <div class="ui two column centered grid">
                    <div class="column">
                    <table class="ui attached table">
                        <thead>
                        <tr><th class="ten wide">Games vinculados</th>
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
        <div class="ui vertical divider" id="ou"></div>
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
                        <i class="sign-in icon"></i>
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
        <div class="ui vertical divider" id="ou">
            Ou
        </div>
    </div>
    <!-- // Login -->	
<?php endif; ?>