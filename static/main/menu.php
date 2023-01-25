      <div class="ui brown inverted menu">
        <a class="active orange item" href="index.php">
          <i class="home icon"></i>      
          Home
        </a>
        <?php if ($novoDadosWebsite['manutencao'] != '1'): ?>
          <?php if (isset($_SESSION['UID']) && !empty($_SESSION['UID']) and isset($_SESSION['NOME']) && !empty($_SESSION['NOME']) and isset($_SESSION['EMAIL']) && !empty($_SESSION['EMAIL']) and isset($_SESSION['STATUS']) && !empty($_SESSION['STATUS'])): ?>
            <div class="right menu">
              <a class="active positive item" href="logout.php">
                <i class="sign-out icon"></i>
                Logout
              </a>
          </div>
          <?php else: ?>
            <div class="right menu">
              <a class="active blue item" id="btnLoginModal">
                <i class="sign-in icon"></i>
                Login
              </a>
            </div>
          <?php endif; ?>
        <?php endif ?>
      </div>