<!DOCTYPE html>
<html lang="pl">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Social media platform</title>
  <link rel="stylesheet" href="../assets/css/mainstyles.css" />
  <link rel="stylesheet" href="../assets/css/userProfile.css" />
  <?php
  include_once("../app/config.php");
  session_start();
  ?>
</head>

<body>
  <header class="header">
    <div class="header__logo">
      <span class="header__logo--mobile">S</span>
      <span>Social</span>
      <span>Media</span>
    </div>
    <nav class="header__navigation">
      <ul class="header__navigation__list">
        <a href="mainPage.php">
          <li class="header__navigation__list__item">
            <img src="../assets/img/home-icon.svg" alt="Strona główna." /><span>Strona główna</span>
          </li>
        </a>
        <a href="search.php">
          <li class="header__navigation__list__item">
            <img src="../assets/img/search-icon.svg" alt="Wyszukaj." /><span>Szukaj</span>
          </li>
        </a>
      </ul>
    </nav>
    <button class="header__user-info" id="header__user-info-btn">
      <img class="header__user-info__picture" src=" <?php echo($_SESSION['userImg']) ?> " alt="Awatar użytkownika." />
      <span class="header__user-info__nickname">
        <?php
        if ($_SESSION['firstName'] !== null) {
          echo ($_SESSION['firstName']);
        } else {
          echo ("DATA_ERROR");
        }
        ?>
      </span>
      <img src="../assets/img/arrow-down-icon.svg" alt="Strzałka rozwijająca opcje." />
    </button>
    <div class="header__modal" id="header__modal">
      <a href="userProfile.php" class="header__modal__btn">
        Profil użytkownika
        <img src="../assets/img/user-profile-icon.svg" alt="Profil użytkownika." />
      </a>
      <a href="../app/logout.php" class="header__modal__btn">
        Wyloguj się
        <img src="../assets/img/logout-icon.svg" alt="Wyloguj się." />
      </a>
    </div>
  </header>
  <main class="main" id="main">
    <section class="banner">
      <div class="banner__user-profile">
        <img src=" <?php echo($_SESSION['userImg']) ?> " alt="Awatar użytkownika." />
        <span>
          <?php
          if ($_SESSION['firstName'] !== null) {
            echo ($_SESSION['firstName'] . " " . $_SESSION['lastName']);
          } else {
            echo ("DATA_ERROR");
          }
          ?>
        </span>
      </div>
      <!-- <button class="banner__follow-btn--active">
          Obserwuj!
        </button> -->
      <button class="banner__settings-btn">
        <img src="../assets/img/setting-icon.svg" alt="Ustawienia." />
      </button>
    </section>
    <section class="content">
      <section class="friends">
        <h2 class="friends__heading">Przyjaciele</h2>
        <div class="friends__list">
          <?php
          $check_friends = mysqli_query($db_connect, "SELECT `Follower_Id` FROM `follow_list` WHERE `User_Id` = " . $_SESSION['id']);
          if (mysqli_num_rows($check_friends) > 0) {
            while ($friend = mysqli_fetch_assoc($check_friends)) {
              foreach ($friend as $k => $v) {
                $friend_get_info = mysqli_query($db_connect, "SELECT `UserFirstName`, `UserLastName`, `UserGender` ,`UserImg` FROM `users` WHERE `User_Id` = " . $v);
                $friend_info = mysqli_fetch_array($friend_get_info);
                if ($friend_info[3] !== NULL) {
                  $friendImgURL = $friend_info[3];
                } else if ($friend_info[2] === "F") {
                  $friendImgURL = "../assets/img/default-profile-picture-female-icon.svg";
                } else {
                  $friendImgURL = "../assets/img/default-profile-picture-male-icon.svg";
                }
                echo ("
                <div class=\"friend\">
                  <a href=\"search?id=" . $v . "\" class=\"friend__link\">
                    <img class=\"friend__picture\" src=\"$friendImgURL\" alt=\"Awatar przyjaciela użytkownika.\" />
                    <span class=\"friend__nickname\">" . $friend_info[0] . " " . $friend_info[1] . "</span>
                  </a>
                </div>
                ");
              }
            }
            echo ("</div>");
          } else {
            echo ("</div>");
            echo ("<p class=\"friends__list__error-message\">Brak obserwatorów</p>");
          }
          ?>

      </section>
      <section class="posts">
        <form action="../app/create-post.php" method="post" class="posts__new-post">
          <textarea class="posts__new-post__text" name="post-text" id="post-text" placeholder="Opowiedź coś..."></textarea>
          <button class="posts__new-post__submit-btn" type="submit">
            Udostępnij wpis!
          </button>
        </form>
        <div class="posts__list">
          <?php
          $check_posts = mysqli_query($db_connect, "SELECT `Id` FROM `posts` WHERE `User_Id` = " . $_SESSION['id']);
          if (mysqli_num_rows($check_posts) > 0) {
            while ($post = mysqli_fetch_assoc($check_posts)) {
              foreach ($post as $k => $v) {
                $post_get_info = mysqli_query($db_connect, "SELECT `Post`, `Likes` , `Date` FROM `posts` WHERE `Id` = " . $v);
                $post_info = mysqli_fetch_array($post_get_info);
                if ($_SESSION["userImg"] !== NULL) {
                  $userImgURL = $_SESSION["userImg"];
                } else if ($_SESSION["userGender"] === "M") {
                  $userImgURL = "../assets/img/default-profile-picture-male-icon.svg";
                } else {
                  $userImgURL = "../assets/img/default-profile-picture-female-icon.svg";
                }
                echo ("
              <div class=\"post\">
              <img class=\"post__picture\" src=\"$userImgURL\" alt=\"Awatar użytkownika.\" />
              <div class=\"post__container\">
                <div class=\"post__content\">
                  <p class=\"post__content__nickname\">" . $_SESSION["firstName"] . " " . $_SESSION["lastName"] . "</p>
                  <p class=\"post__content__message\">" . $post_info[0] . "</p>
                </div>
                <div class=\"post__footer\">
                  <div class=\"post__footer__like-section\">
                    <a href=\"../app/likes.php?id=" . $v . "&location=userProfile\" class=\"post__footer__like-section__like-btn\" id=\"post__footer__like-section__like-btn\">
                      <img class=\"post__footer__like-section__like-btn__img\" src=\"../assets/img/heart-line-icon.svg\" alt=\"Polubienia.\" />
                    </a>
                    <span class=\"post__footer__like-section__like-counter\">" . $post_info[1] . "</span>
                  </div>
                  <span class=\"post__footer__date\"> " . $post_info[2] . "</span>
                </div>
              </div>
            </div>
                ");
              }
            }
          } else {
            echo ("<p class=\"posts__error-message\">Brak wpisów</p>");
          }
          ?>
        </div>
      </section>
    </section>
  </main>
  <footer class="footer">
    <p class="footer__copy">Copyright &copy; Marcin Wasilewski 2023</p>
  </footer>
  <script src="../assets/js/modalShow.js"></script>
  <script src="../assets/js/likeBtn.js"></script>
</body>

</html>