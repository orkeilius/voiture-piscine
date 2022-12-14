<?php session_start();
include('module/dbTools.php'); ?>
<!DOCTYPE html>
<html>

<head>
    <?php include("module/head.php") ?>
</head>

<body>
    <?php
    if (getUserAccess() > 3) {
        header("Location: /");
    } else {
        include("module/header.php"); ?>
        <section>
            <h2> crée un article</h2>
            <form action="action.php?action=addArticle" method="post" id="form" enctype="multipart/form-data">
                <label for="title">Titre:</label><br />
                <input type="text" name="title" placeholder="Titre" pattern="^.{0,255}" required><br />
                <label for="content">article:</label><br />
                <textarea name="content" placeholder="article&#10;note: les lien doivent commencer par http pour être reconnues" ></textarea><br /><br />

                <!-- file input inserted here-->

                <input type="submit" id="submit">
            </form>
        </section>

        <!-- template-->
        <div style="display:none" id="template"> 
            <div>
                <input type="file">
                <button type="button" style="display:none" >supprimer</button>
                </br>
            </div>
        </div>
        <script>
            function addNode(){
                fileEntry = form.insertBefore(template.cloneNode(true),submitButton);

                fileInput = fileEntry.querySelector("input")
                fileInput.name = "upload_" + nbFile;
                fileInput.id = "upload_" + nbFile;
                fileInput.addEventListener('input', change);

                fileButton = fileEntry.querySelector("button")
                fileButton.id = "delete_" + nbFile;
                fileButton.addEventListener('click',deleteFile);
            }

            function change(e) {
                nbFile += 1;
                fileName = e.target.name.split("_");
                document.getElementById("delete_" + fileName[1]).style.display = "inline";
                addNode();
            }

            function deleteFile(e) {
                e.target.parentNode.remove()
            }

            nbFile = 0
            form = document.getElementById("form")
            template = document.getElementById("template").children[0];
            submitButton = document.getElementById("submit");
            
            addNode()

        </script>
        
    <?php include("module/footer.php");
    }
    ?>
</body>

</html>