<!DOCTYPE html>
<html lang="pl">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Social media platform</title>
  <link rel="stylesheet" href="../assets/css/mainstyles.css" />
  <link rel="stylesheet" href="../assets/css/signin.css" />
  <?php
  include("../app/config.php");
  ?>
</head>

<body>
  <div class="wrapper signin-img"></div>
  <div class="wrapper">
    <section class="signin">
      <h1>Zaloguj się</h1>
      <form action="#" method="POST">
        <label class="form__field">Adres Email:
          <input type="email" name="email" id="email" />
        </label>
        <label class="form__field">Hasło:
          <input type="password" name="password" id="password" />
          <button type="button" class="form__field--password-icon" id="showPassword-btn">
            <img src="../assets/img/eye-icon.svg" alt="Pokaż swoje hasło." />
          </button>
        </label>
        <input class="form__submit-btn" type="submit" value="Zaloguj się" />
        <?php
        session_start();
        if (isset($_POST["email"])) {
          if (empty($_POST["email"])) {
            echo ("<div class=\"form__error-container\">Pole email musi zostać wypełnione</div>");
          } else if (empty($_POST["password"])) {
            echo ("<div class=\"form__error-container\">Pole hasła musi zostać wypełnione</div>");
          } else {
            $email = $_POST["email"];
            $password = $_POST["password"];

            if ($stmt = mysqli_prepare($db_connect, "SELECT `User_Id`, `UserFirstName` ,`UserPassword` FROM `users` WHERE `UserEmail` = '$email'")) {
              mysqli_stmt_execute($stmt);
              mysqli_stmt_store_result($stmt);
              if (mysqli_stmt_num_rows($stmt) > 0) {
                mysqli_stmt_bind_result($stmt, $mysqlId, $mysqlFirstName, $mysqlPassword);
                mysqli_stmt_fetch($stmt);
                if (password_verify($password, $mysqlPassword)) {
                  session_regenerate_id();
                  $_SESSION['loggedin'] = TRUE;
                  $_SESSION['firstName'] = $mysqlFirstName;
                  $_SESSION['id'] = $mysqlId;
                  header('location: mainPage.php');
                  exit;
                } else {
                  echo ("<div class=\"form__error-container\">Podano złe hasło</div>");
                }
              } else {
                echo ("<div class=\"form__error-container\">Podano zły email</div>");
              }
            } else {
              echo ("<div class=\"form__error-container\">Nie znaleziono użytkownika</div>");
            }
          }
        }
        ?>
      </form>
      <div class="signup__link">
        <p class="signup__link--text">
          Nie posiadasz konta?
          <a class="signup__link--link" href="signUp.php">Zarejestruj się!</a>
        </p>
      </div>
    </section>
  </div>
  <script src="../assets/js/passwordShow.js"></script>
</body>

</html>