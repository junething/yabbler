<!--<script language="JavaScript">
    $(document).ready(function() {
        $('.parent').click(function() {
            $('.sub-nav').toggleClass('visible');
        });
    });
</script>-->
<header id="header">
      <div class="container">
        <h1>
            Yabbler Beta
        </h1>
        <nav id="nav">
          <ul>
            <li>
              <a href="/index.php">Home</a>
            </li>
            <li>
              <a href="/about.php ">About</a>
            </li>
            <li>
              <a href="/dashboard.php">Dashboard</a>
            </li>
            <? if($username): ?>
                <li>
                  <a href="#"><? echo $username; ?></a>
                </li>
            <? else : ?>
                <li>
                  <a href="/login.php">Login</a>
                </li>
            <? endif; ?>
          </ul>
        </nav>
      </div>
    </header>