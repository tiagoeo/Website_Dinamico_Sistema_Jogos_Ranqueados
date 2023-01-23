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
        <div class="ui cancel button" onclick="limparCadastro();">Cancelar</div>
        <div class="ui button" id="btnCadastrar">Cadastrar</div>
      </div>
    </div>

    <div class="ui modal" id="modalFooter">
      <div class="header" id="modalFooterCabecalho">Quem Somos</div>
      <div class="scrolling content" id="modalFooterConteudo">
        <p>=)</p>
      </div>
    </div>