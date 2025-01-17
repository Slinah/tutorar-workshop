<?php
//include_once "includes/composants/nav-bar.php";

$dataSchools = hget('http://localhost:4567/api/getAllSchools');
retourUtilisateur($dataSchools);
$dataPromosFromSchools = hget('http://localhost:4567/api/getPromoFromSchool');
retourUtilisateur($dataPromosFromSchools);
$dataClassesFromPromos = hget('http://localhost:4567/api/getClassFromPromo');
retourUtilisateur($dataClassesFromPromos);


if (isset($_SESSION['retourUser'])) {
    retourUtilisateur($_SESSION['retourUser']);
}

if (!empty($_POST)) {

    if (array_key_exists("class", $_POST)) {
        if (!is_null($_POST["class"])) {
            $DB_PASS = hpost("http://localhost:4567/api/createAccount",
                array(
                    "school" => sanitize($_POST["school"]),
                    "promo" => sanitize($_POST["promo"]),
                    "class" => sanitize($_POST["class"]),
                    "firstname" => sanitize($_POST["firstname"]),
                    "lastname" => sanitize($_POST["lastname"]),
                    "email" => sanitize($_POST["email"]),
                    "password" => sanitize(password_hash($_POST["password"], PASSWORD_DEFAULT)),
                ));
            retourUtilisateur($DB_PASS);
            if (password_verify($_POST["password"], $DB_PASS->password)) {
                $_SESSION["me"] = $DB_PASS;
                header("Location: /");
                die();
            }
        }
    }
}


?>
<div class="login-box">
    <h2>Créer un compte</h2>
    <form id="register" method="post">
        <div class="user-box">
            <select name="school" id="school-select" required>
                <option value="">Choisir l'école</option>
                <?php foreach ($dataSchools as $dataSchool) { ?>
                    <option value="<?= $dataSchool->id_ecole ?>"><?= $dataSchool->intitule ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="user-box">
            <select name="promo" id="promo-select" required>
                <option value="">Choisir promo</option>
                <?php foreach ($dataPromosFromSchools as $dataPromosFromSchool) { ?>
                    <option value="<?= $dataPromosFromSchool->id_promo ?>"
                            class="<?= 'ec_' . $dataPromosFromSchool->id_ecole ?>"><?= $dataPromosFromSchool->intitulePromo ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="user-box">
            <select name="class" id="classe-select" required>
                <option value="">Choisir classe</option>
                <?php foreach ($dataClassesFromPromos as $dataClassesFromPromo) { ?>
                    <option value="<?= $dataClassesFromPromo->id_classe ?>"
                            class="<?= 'pro_' . $dataClassesFromPromo->id_promo ?>"><?= $dataClassesFromPromo->intituleClasse ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="user-box">
            <input type="text" name="firstname" required>
            <label>Prénom</label>
        </div>
        <div class="user-box">
            <input type="text" name="lastname" required>
            <label>Nom</label>
        </div>
        <div class="user-box">
            <input type="email" name="email" required>
            <label>Mail</label>
        </div>
        <div class="user-box">
            <input type="password" name="password" required>
            <label>Password</label>
        </div>
        <a onclick="document.getElementById('register').submit()" type="submit">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            Je m'inscris
        </a>
        <a href="/connexion">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            J'ai déjà un compte
        </a>
    </form>
</div>






