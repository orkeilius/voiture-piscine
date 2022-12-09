<?php ?>
<header>
    <h1>Vp enterprise</h1>
    <nav>
        <a class="navItem" href="/">Accueil</a>
        <?php if (isset($_SESSION["user"])) {
            if (getUserAccess() <= 2) { ?>
                <a class="navItem" href="addArticle.php"> + ajouter un article</a>
            <?php } ?>
            <div style="flex-grow:1"></div>
            <div class="dropdown">
                <button class="navItem" href="profile">Profil</button>
                <div>
                    <a class="dropdownItem" href="option.php">Option</a>
                    <a class="dropdownItem" href="action.php?action=logout">Logout</a>
                </div>
            </div>
        <?php } ?>
    </nav>
</header>