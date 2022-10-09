<!DOCTYPE html>
<html>

<head>
    <?php include("module/head.php") ?>
</head>

<body>
    <?php include("module/header.php"); ?>
    <?php # placeholder for login
    if (False) {  ?>
        <h1>dernier message</h1>
    <?php } else { ?>
        <section id="sectionLogin">
            <div class="itemWarper">
                <h2>log in</h2>
                <form action="/login.php" method="post">
                    <input type="text" class="entry" id="username" name="username" placeholder="username" required><br>
                    <input type="password" class="entry" id="password" name="password" placeholder="password" required><br>
                    <input type="submit" value="se connecter">
                </form>
            </div>
            <svg id="svgBackground" xmlns="http://www.w3.org/2000/svg" width="200%" height="100%">
                <defs>
                    <pattern id="bg" patternUnits="userSpaceOnUse" width="200" height="1000">
                        <path id="rect1465" style="fill:#004bff;stroke:none;stroke-width:17.1931" d="M 0,9.8923415 V 987.03985 c 0,0 200,29.16035 200,0 V 9.8923415 c -80.63446,31.7000165 -110.451513,-33.5702665 -200,0 z" />
                    </pattern>
                </defs>
                <rect width="200%" height="100%" fill="url(#bg)" />
            </svg>

        </section>
    <?php }; ?>
    <?php include("module/footer.php") ?>
</body>

</html>