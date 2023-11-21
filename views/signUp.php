<!DOCTYPE html>
<html lang="pl">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Social media platform</title>
  <link rel="stylesheet" href="../assets/css/mainstyles.css" />
  <link rel="stylesheet" href="../assets/css/signup.css" />
  <?php
  include("../app/config.php");
  ?>
</head>

<body>
  <div class="wrapper signup-img"></div>
  <div class="wrapper">
    <section class="signup">
      <h1>Zarejestruj się</h1>
      <form id="registrationForm" method="POST">
        <div class="form__field--personal-information">
          <label class="form__field">Imię:
            <input type="text" name="firstName" id="firstName" required />
          </label>
          <label class="form__field">Nazwisko:
            <input type="text" name="lastName" id="lastName" required />
          </label>
        </div>
        <label class="form__field">Adres Email:
          <input type="email" name="email" id="email" required />
        </label>
        <label class="form__field">Hasło:
          <input type="password" name="password" id="password" required />
          <button class="form__field--password-icon">
            <img src="../assets/img/eye-icon.svg" alt="Pokaż swoje hasło." />
          </button>
        </label>
        <label class="form__field">Powtórz Hasło:
          <input type="password" name="confirmPassword" id="confirmPassword" required />
        </label>
        <div class="form__field--gender">
          <label class="form__field--gender__value">
            <input type="radio" name="gender" value="M" checked />
            Mężczyzna
          </label>
          <label class="form__field--gender__value">
            <input type="radio" name="gender" value="F" /> Kobieta
          </label>
        </div>
        <input class="form__submit-btn" type="submit" value="Zarejestruj się" />
        <?php
        if (isset($_POST["firstName"])) {
          if (empty($_POST["firstName"]) || empty($_POST["lastName"]) || empty($_POST["email"]) || empty($_POST["password"]) || empty($_POST["confirmPassword"])) {
            echo ("<div class=\"form__error-container\">Wszystkie pola muszą zostać poprawnie wypełnione</div>");
          } else {
            $firstName = $_POST["firstName"];
            $lastName = $_POST["lastName"];
            $email = $_POST["email"];
            $gender = $_POST["gender"];
            $password = $_POST["password"];
            $confirmPassword = $_POST["confirmPassword"];
            if (!($password === $confirmPassword)) {
              echo ("<div class=\"form__error-container\">Hasła nie są identyczne</div>");
            } else {
              $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
              $confirmPassword = password_hash($_POST["confirmPassword"], PASSWORD_DEFAULT);
              $check_user_exists = mysqli_query($db_connect, "SELECT * FROM `users` WHERE `UserEmail` = '$email'");
              if ($check_user_exists) {
                if (mysqli_num_rows($check_user_exists) > 0) {
                  echo ("<div class=\"form__error-container\">Użytkownik już istnieje</div>");
                } else {
                  $user_create_value = mysqli_query($db_connect, "INSERT INTO `users` VALUES (NULL,'$firstName','$lastName','$gender','$email','$password',NULL,NULL)");
                  echo ("<div class=\"form__success-container\">Użytkownik został pomyślnie dodany</div>");
                }
              }
            }
          }
        }
        ?>
      </form>
      <div class="signup__link">
        <p class="signup__link--text">
          Posiadasz konto?
          <a class="signup__link--link" href="signIn.php">Zaloguj się!</a>
        </p>
      </div>
    </section>
  </div>
</body>

</html>