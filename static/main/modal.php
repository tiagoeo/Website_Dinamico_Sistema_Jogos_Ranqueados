    <div class="ui modal long" id="modalCadastro">
      <i class="close icon"></i>
      <div class="header">
        <i class="signup icon"></i>
        Formulário de cadastro
      </div>
      <div class="description">
        <div class="ui raised violet segment">
          <form class="ui form" id="formularioCadastro">
            <div class="field" id="fieldUsuarioCadastro">
              <label>Apelido</label>
              <input type="text" placeholder="Apelido" name="usuarioCadastro" id="usuarioCadastro">
              <div id="mensageUsuarioCadastro"></div>
            </div>
            <div class="field">
              <label>Email</label>
              <div class="two fields">
                <div class="field" id="fieldEmailCadastro">
                  <input type="text" placeholder="Email" name="emailCadastro" id="emailCadastro">
                  <div id="mensageEmailCadastro"></div>
                </div>
                <div class="field" id="fieldEmail2Cadastro">
                  <input type="text" placeholder="Confirmar email" name="email2Cadastro" id="email2Cadastro">
                  <div id="mensageEmail2Cadastro"></div>
                </div>
              </div>
            </div>
            <div class="field">
              <label>Senha</label>
              <div class="two fields">
                <div class="field" id="fieldSenhaCadastro">
                  <input type="password" placeholder="senha" name="senhaCadastro" id="senhaCadastro">
                  <div id="mensageSenhaCadastro"></div>
                </div>
                <div class="field" id="fieldSenha2Cadastro">
                  <input type="password" placeholder="repetir senha" name="senha2Cadastro" id="senha2Cadastro">
                  <div id="mensageSenha2Cadastro"></div>
                </div>
              </div>
            </div>
            <div class="field" id="fieldCheckboxCadastro">
              <div class="ui checkbox">
                <input type="checkbox" id="checkboxCadastro">
                <label>Aceito os termos e condições</label>
              </div>
            </div>
          </form>
          <div id="mensageCadastro"></div>
        </div>
      </div>
      <div class="actions">
        <div class="ui cancel button" onclick="limparRegistros();"><i class="close icon"></i>Cancelar</div>
        <div class="ui button" id="btnCadastrar"><i class="edit icon"></i>Cadastrar</div>
      </div>
    </div>

    <div class="ui modal long" id="modalLogin">
      <i class="close icon"></i>
      <div class="header">
        <i class="user icon"></i>
        Login
      </div>
      <div class="description">
        <div class="ui raised violet segment">
          <form class="ui form" id="formularioLoginMenu">
            <div class="field" id="fieldUsuarioLoginMenu">
              <label>Usuário</label>
              <div class="ui left icon input">
                  <input type="text" placeholder="Usuário" name="usuarioLogin" id="usuarioLoginMenu">
                  <i class="user icon"></i>
              </div>
              <div id="mensageUsuarioLoginMenu"></div>
            </div>
            <div class="field" id="fieldSenhaLoginMenu">
                <label>Senha</label>
                <div class="ui left icon input">
                    <input type="password" name="senhaLogin" id="senhaLoginMenu">
                    <i class="lock icon"></i>
                </div>
                <div id="mensageSenhaLoginMenu"></div>
            </div>
          </form>
          <div id="mensageLoginMenu"></div>
        </div>
      </div>
      <div class="actions">
        <div class="ui cancel button" onclick="limparRegistros();"><i class="close icon"></i>Cancelar</div>
        <div class="ui button" id="btnLoginMenu"><i class="user icon"></i>Login</div>
      </div>
    </div>

    <div class="ui basic modal" id="footerModal">
      <div class="ui icon header" id="footerModalTitulo">
      </div>
      <div class="content" id="footerModalDescricao">
      </div>
      <div class="actions">
        <div class="ui green ok inverted button">
          <i class="checkmark icon"></i>
          OK
        </div>
      </div>
    </div>