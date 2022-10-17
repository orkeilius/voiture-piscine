<?php include ('dbTools.php'); ?>
<header>
    <h1>Vp enterprise</h1>
    <nav>
        <a class="navItem" href="/">Accueil</a>
        <?php if (isset($_SESSION["user"])) {
            if (getUserAccess() <= 2) { ?>
                <a class="navItem" href="addArticle"> + ajouter un article</a>
            <?php } ?>
            <div style="flex-basis:1;flex-grow:100"></div>
            <div class="dropdown">
                <button class="navItem" href="profile">Profil</button>
                <div>
                    <a class="dropdownItem" href="option.php">Option</a>
                    <a class="dropdownItem" href="logout.php">Logout</a>
                </div>

            </div>
        <?php } ?>
    </nav>
</header>