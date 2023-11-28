<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Social media platform</title>
    <link rel="stylesheet" href="../assets/css/mainstyles.css" />
    <link rel="stylesheet" href="../assets/css/mainPage.css" />
    <?php
    include("../app/authorization.php");
    include("../app/config.php");
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
        <h1 class="main__heading">Dla ciebie</h1>
        <section class="posts">
            <div class="posts__list">
                <?php
                $display_random_posts = mysqli_query($db_connect, "SELECT `Id` FROM `posts`");
                if (mysqli_num_rows($display_random_posts) > 0) {
                    while ($post = mysqli_fetch_assoc($display_random_posts)) {
                        foreach ($post as $k => $v) {
                            $post_get_info = mysqli_query($db_connect, "SELECT `User_Id`, `Post`, `Likes` , `Date` FROM `posts` WHERE `Id` = " . $v);
                            $post_info = mysqli_fetch_array($post_get_info);
                            $get_user_info = mysqli_query($db_connect, "SELECT `UserFirstName`, `UserLastName`, `UserGender`, `UserImg` FROM `users` WHERE `User_Id` = " . $post_info[0]);
                            $user_info = mysqli_fetch_array($get_user_info);
                            if ($user_info[3] !== NULL) {
                                $userImgURL = $user_info[3];
                            } else if ($user_info[2] === "M") {
                                $userImgURL = "../assets/img/default-profile-picture-male-icon.svg";
                            } else {
                                $userImgURL = "../assets/img/default-profile-picture-female-icon.svg";
                            }

                            echo ("
                        <div class=\"post\">
                        <img class=\"post__picture\" src=\"$userImgURL\" alt=\"Awatar użytkownika.\" />
                        <div class=\"post__container\">
                          <div class=\"post__content\">
                            <p class=\"post__content__nickname\">" . $user_info[0] . " " . $user_info[1] . "</p>
                            <p class=\"post__content__message\">" . $post_info[1] . "</p>
                          </div>
                          <div class=\"post__footer\">
                            <div class=\"post__footer__like-section\">
                              <a href=\"../app/likes.php?id=" . $v . "&location=mainPage\" class=\"post__footer__like-section__like-btn\" id=\"post__footer__like-section__like-btn\">
                                <img class=\"post__footer__like-section__like-btn__img\" src=\"../assets/img/heart-line-icon.svg\" alt=\"Polubienia.\" />
                              </a>
                              <span class=\"post__footer__like-section__like-counter\">" . $post_info[2] . "</span>
                            </div>
                            <span class=\"post__footer__date\"> " . $post_info[3] . "</span>
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
    </main>
    <footer class="footer">
        <p class="footer__copy">Copyright &copy; Marcin Wasilewski 2023</p>
    </footer>
    <script src="../assets/js/modalShow.js"></script>
</body>

</html>