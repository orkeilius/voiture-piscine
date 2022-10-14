<header>
    <h1>Vp enterprise</h1>
    <nav>
        <a class="navItem" href="accueil">Accueil</a>
        <?php if(isset($_SESSION["user"])){ ?>
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