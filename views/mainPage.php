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
                <li class="header__navigation__list__item">
                    <img src="../assets/img/home-icon.svg" alt="Strona główna." /><span>Strona główna</span>
                </li>
                <li class="header__navigation__list__item">
                    <img src="../assets/img/search-icon.svg" alt="Wyszukaj." /><span>Szukaj</span>
                </li>
            </ul>
        </nav>
        <button class="header__user-info">
            <img class="header__user-info__picture" src="../assets/img/default-profile-picture-male-icon.svg" alt="Awatar użytkownika." />
            <span class="header__user-info__nickname">User</span>
            <img src="../assets/img/arrow-down-icon.svg" alt="Strzałka rozwijająca opcje." />
        </button>
        <div class="header__modal">
            <button class="header__modal__btn">
                Profil użytkownika
                <img src="../assets/img/user-profile-icon.svg" alt="Profil użytkownika." />
            </button>
            <button class="header__modal__btn">
                Wyloguj się
                <img src="../assets/img/logout-icon.svg" alt="Wyloguj się." />
            </button>
        </div>
    </header>
    <main>

    </main>
</body>

</html>