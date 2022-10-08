<!DOCTYPE html>
<html>

<head>
    <?php include("module/head.php") ?>
</head>

<body>
    <?php include("module/header.php"); ?>
    <section>
        <?php # placeholder for login
        if (False) {  ?>
        <h1>dernier message</h1>
        <?php } 
        else{?>
            <h2>log in</h2>
            <form>
                <input type="text" class="entry" id="user" name="user" placeholder="username" required><br>
                <input type="password" class="entry" id="password" name="password" placeholder="password" required><br>
                <input type="submit" value="se connecter">
            </form>
        <?php }; ?>
    </section>
    <?php include("module/footer.php") ?>
</body>

</html>