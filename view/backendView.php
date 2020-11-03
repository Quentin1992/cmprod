<?php
session_start();
$title = "Tableau de bord - Chaud Mirette Productions";
$page = "backend";
?>

<header>
    <h1>Tableau de bord</h1>
    <p>Ajout et mise à jour des réalisations, articles, et avis.</p>
</header>

<?php
//check for email in session or posted and compare, then do the same for password
if(((isset($_SESSION['email']) && ($_SESSION['email'] == "chaudmiretteprod@gmail.com"))
|| (isset($_POST['email']) && ($_POST['email'] == "chaudmiretteprod@gmail.com")))
&& ((isset($_SESSION['password']) && password_verify($_SESSION['password'], "$2y$10$6nFFUwa7z172LBLT597/cOd0UHrzUCm31xYQ4pIuGj/PiZ6RuA5TC"))
|| (isset($_POST['password']) && password_verify($_POST['password'], "$2y$10$6nFFUwa7z172LBLT597/cOd0UHrzUCm31xYQ4pIuGj/PiZ6RuA5TC")))){
    if(isset($_POST['password'])){
        $_SESSION['password'] = $_POST['password'];
    }
    if(isset($_POST['email'])){
        $_SESSION['email'] = $_POST['email'];
    }
?>
<div>
    <a href="../controller/logout.php">Déconnexion</a>
</div>
<section id="addPublication">
    <h2>Ajouter une publication :</h2>
    <div>
        <button id="newReviewButton">Nouvel avis</button>
        <button id="newProjectButton">Nouvelle réalisation</button>
        <button id="newArticleButton">Nouvel article</button>
    </div>
</section>
<div id="form-modal"></div>
<div id="publicationsSelector">
    <button id="reviewsButton">Avis</button>
    <button id="projectsButton">Réalisations</button>
    <button id="articlesButton">Articles</button>
</div>
<section id="reviewsDisplay">
    <h4>Affichage sur le site</h4>
    <div id="sliderDiv">
        <button id="previousSlideButton"><i class="fas fa-chevron-left"></i></button>
        <a href="index.php?action=articlesView"></a>
        <button id="nextSlideButton"><i class="fas fa-chevron-right"></i></button>
    </div>
    <h4>Vue d'ensemble</h4>
    <div id="reviewsTableLocation"></div>
</section>
<section id="projectsDisplay"></section>
<section id="articlesDisplay"></section>
<div id="video-modal"></div>
<?php
}
else {
?>
<form id="passwordForm" action="#" method="post">
    <label for"email">Identifiant :</label>
    <input type="email" name="email" id="email" required>
    <label for"password">Mot de passe :</label>
    <input type="password" name="password" id="password" required>
    <input type="submit" value="Accéder au tableau de bord">
</form>
<?php
}
?>
