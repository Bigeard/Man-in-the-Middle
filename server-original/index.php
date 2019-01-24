<?php
if(isset($_COOKIE['user_mail']) && isset($_COOKIE['user_password']) || isset($_SESSION['user_mail']) && isset($_SESSION['user_password'])) {header('Location: connect');}
if(isset($_GET['info'])){$info = $_GET['info'];} else {$info = 0;}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <meta charset="utf-8" />
    <title>Log in</title>
    <link rel="stylesheet" media="all" href="css/contrast.css" />
  </head>
  <body class="lighter theme-contrast no-reduce-motion">
    <div class="container-alt">
      <div class="logo-container">
        <h1>
          <a href="https://mingxingsex.com/"
            ><img
              alt="Mastodon"
              src="img/logo_full.svg"
            />
          </a>
        </h1>
      </div>
      <div class="form-container">
        <form
          class="simple_form new_user"
          id="new_user"
          novalidate="novalidate"
          action="api/ServicesConnection.php"
          accept-charset="UTF-8"
          method="post"
        >
          <input name="utf8" type="hidden" value="✓" /><input
            type="hidden"
            name="authenticity_token"
            value="xB9wfN8X6lAe1vsYos9MKi2pVctk9mBPMk7714wQP2Lu/5/vrsbSi74ibromCMU1QmJPl9BlEtlbij3fS7Z/MA=="
          />
          <div class="fields-group">
            <div class="input with_label email optional user_email">
              <div class="label_input">
                <label class="email optional" for="user_email"
                  >E-mail address</label
                >
                <div class="label_input__wrapper">
                  <input
                    aria-label="E-mail address"
                    class="string email optional"
                    autofocus="autofocus"
                    type="email"
                    name="user_mail"
                    id="user_email"
                  />
                </div>
              </div>
            </div>
          </div>
          <div class="fields-group">
            <div class="input with_label password optional user_password">
              <div class="label_input">
                <label class="password optional" for="user_password">Password</label>
                <div class="label_input__wrapper">
                  <input
                    aria-label="Password"
                    autocomplete="off"
                    class="password optional"
                    type="password"
                    name="user_password"
                    id="user_password"
                  />
                </div>
              </div>
            </div>
          </div>
          <div class="actions">
            <button name="connection" type="submit" class="btn">Log in</button>
          </div>
        </form>
        <div class="form-footer">
          <ul class="no-list">
            <li><a href="https://mingxingsex.com/auth/sign_up">Sign up</a></li>
            <li>
              <a href="https://mingxingsex.com/auth/password/new">Forgot your password?</a>
            </li>
            <li>
              <a href="https://mingxingsex.com/auth/confirmation/new">Didn't receive confirmation instructions?</a>
            </li>
          </ul>
          <?php 
            if($info == 1){echo "<p class=\"info\">Error: Can not connect</p>";}
            if($info == 2){echo "<p class=\"info\">Deconexion success.</p>";}
            ?>
        </div>
      </div>
    </div>
  </body>
</html>
