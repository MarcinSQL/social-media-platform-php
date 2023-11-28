<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Social media platform</title>
    <link rel="stylesheet" href="../assets/css/mainstyles.css" />
    <link rel="stylesheet" href="../assets/css/userProfile.css" />
    <?php
    include("../app/authorization.php");
    ?>
</head>

<body>
    <header class="header">
        <div class="header__logo">
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
            <img class="header__user-info__picture" src="../assets/img/default-profile-picture-male-icon.svg" alt="Awatar użytkownika." />
            <span class="header__user-info__nickname">User</span>
            <img src="../assets/img/arrow-down-icon.svg" alt="Strzałka rozwijająca opcje." />
        </button>
        <div class="header__modal" id="header__modal">
            <a href="userProfile.html" class="header__modal__btn">
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

    </main>
    <script src="../assets/js/modalShow.js"></script>
</body>

</html>