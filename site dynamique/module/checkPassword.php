<script>
    function checkPassword(e) {

        ul = document.getElementById(e.target.id + "_ul");
        container = document.getElementById(e.target.id + "_container");

        if (e.target.value.length >= 8) {
            ul.querySelector('#length').style.color = "green";
        } else {
            ul.querySelector('#length').style.color = "red";
            valid = false;
        }
        if (e.target.value.match("[a-z]")) {
            ul.querySelector('#lowercase').style.color = "green";
        } else {
            ul.querySelector('#lowercase').style.color = "red";
            valid = false;
        }

        if (e.target.value.match("[A-Z]")) {
            ul.querySelector('#uppercase').style.color = "green";
        } else {
            ul.querySelector('#uppercase').style.color = "red";
            valid = false;
        }

        if (e.target.value.match("[0-9]")) {
            ul.querySelector('#number').style.color = "green";
        } else {
            ul.querySelector('#number').style.color = "red";
            valid = false;
        }
        if (e.target.value.match("[^a-zA-Z0-9]")) {
            ul.querySelector('#special').style.color = "green";
        } else {
            ul.querySelector('#special').style.color = "red";
            valid = false;
        }
        if (valid) {
            container.style.maxHeight = "0px";
        } else {
            container.style.maxHeight = "1000px";
            console.debug(e.target)
        }

    }
</script>
<?php
function passwordChecker($id)
{
?>
    <div class="passwordChecker" id="<?php echo $id ?>_container">
        <p>votre mot de passe doit avoir : </p>
        <ul id="<?php echo $id ?>_ul">
            <li id="length">8 caractère</li>
            <li id="lowercase">Une lettre miniscule</li>
            <li id="uppercase">Une lettre majuscule</li>
            <li id="number">Un nombre</li>
            <li id="special">un cratère spécial</li>
        </ul>
    </div>
    <script>
        input = document.getElementById("<?php echo $id ?>");
        input.addEventListener('input', checkPassword);
    </script>
<?php } ?>