<?php
include_once "includes/composants/nav-bar.php";


$id_proposition = filter_input(INPUT_POST, 'id_proposition', FILTER_SANITIZE_SPECIAL_CHARS);
$id_createur = filter_input(INPUT_POST, 'id_createur', FILTER_SANITIZE_SPECIAL_CHARS);
$id_matiere = filter_input(INPUT_POST, "id_matiere", FILTER_SANITIZE_SPECIAL_CHARS);
$id_promo = filter_input(INPUT_POST, "id_promo", FILTER_SANITIZE_SPECIAL_CHARS);
$timeZone = new DateTimeZone("Europe/Paris");
$dateTime = new DateTime("now", $timeZone);
$dateDuJour = date("Y-m-d", $dateTime->getTimestamp());

//Si on ne récupére aucune valeur, alors on met le value set à false, pour pouvoir savoir quand est ce qu'on préremplis le formulaire ou non
if ($id_proposition === null && $id_createur === null && $id_createur === null && $id_promo === null) {
    $valueSet = false;
} else {
//    si il y a des valeurs qui ont étés récupérés par les filters input alors, on passe le value set à true
    $valueSet = true;
}
$idPersonneConnecter = (string)($_SESSION["me"]->id_personne);

// on récupéres toutes les matières // toutes les promos // toutes les infos de la personne par rapport a son id
$getMatiere = hget("http://localhost:4567/api/matieres");
if (property_exists((object)$getMatiere, "error")) {
    $getMatiere = null;
}
$getPromo = hget("http://localhost:4567/api/promos");
if (property_exists((object)$getPromo, "error")) {
    $getPromo = null;
}
$getInfosPersonne = hpost("http://localhost:4567/api/personneById", array("idPeople" => $idPersonneConnecter));
if (property_exists((object)$getInfosPersonne, "error")) {
    $getInfosPersonne = null;
}
if (isset($_SESSION['retourUser'])) {
    retourUtilisateur($_SESSION['retourUser']);
}
?>

<div class="login-box">
    <h2>Donner un cours</h2>
    <form method="post" action="/actions/actionsCreateCourse.php" id="formEnter">
        <a class="btn" href="/suggestion-liste">
            <span></span>
            <span></span>
            <span></span>
            <span></span>Voir la liste des suggestions
        </a>
        <div class="user-box">
            <div class="user-box">
                <input type="text" name="intitule" required>
                <label>Le titre de votre cours !</label>
            </div>
            <input type="hidden" name="id_personne" value="<?= $idPersonneConnecter ?>">
            <select name="id_matiere" id="matiere-select" required>
                <option value="">Matière</option>
                <?php
                if ($getMatiere != null) {
                    foreach ($getMatiere as $ligneMatiere) {
                        echo "<option value='" . $ligneMatiere->id_matiere . "'";
                        if ($valueSet && $ligneMatiere->id_matiere == $id_matiere) {
                            echo " selected";
                        }
                        echo ">" . $ligneMatiere->intitule;
                        echo "</option>";
                    }
                } else {
                    echo "<option value=''>Aucune matière n'a pu être récupéree</option>";
                } ?>
            </select>
        </div>
        <div class="user-box">
            <select name="id_promo" id="promo-select" required>
                <option value="">promo</option>
                <?php
                if ($getPromo != null) {
                    foreach ($getPromo as $lignePromo) {
                        echo "<option value='" . $lignePromo->id_promo . "'";
                        if ($valueSet && $lignePromo->id_promo == $id_promo) {
                            echo " selected";
                        }
                        echo ">" . $lignePromo->intitule;
                        echo "</option>";
                    }
                } else {
                    echo "<option value=''>Aucune promo n'a pu être récupéree</option>";
                } ?>
            </select>
        </div>
        <br>
        <div class="user-box">
            <input type="text" name="commentaires">
            <label>Indiquez ce que vous allez aborder dans ce cours :</label>
        </div>
        <div class='user-box'>
            <input type='date' name='date' min="<?= $dateDuJour ?>" required value='<?= $dateDuJour ?>'>
            <label>date</label>
        </div>
        <div class='user-box'>
            <input type='time' name='dateHeure' required value='17:00'>
            <label>heure</label>
            <button type="submit">Proposer le cours</button>
        </div>
    </form>
</div>

