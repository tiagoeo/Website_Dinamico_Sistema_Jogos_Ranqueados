      <div class="ui brown inverted menu">
        <a class="active orange item" href="index.php">
          Home
        </a>
        <?php if (isset($_SESSION['UID']) && !empty($_SESSION['UID']) and isset($_SESSION['NOME']) && !empty($_SESSION['NOME']) and isset($_SESSION['EMAIL']) && !empty($_SESSION['EMAIL']) and isset($_SESSION['STATUS']) && !empty($_SESSION['STATUS'])): ?>
          <div class="comment">
            <div class="content">
              <a class="author">
                <?php echo($_SESSION['NOME']) ?>
              </a>
              <div class="text">
                <?php echo($_SESSION['EMAIL']) ?>
              </div>
            </div>
          </div>
        <?php endif; ?>
        <div class="right menu">
          <div class="green item">
              <div class="ui primary button" id="btnEntrar">Entrar</div>
          </div>
        </div>
      </div>