<?php
$title = "Tableau de bord - Chaud Mirette Productions";
$page = "backend";
?>

<header>
    <h1>Tableau de bord</h1>
    <p>Ajout et mise à jour des réalisations, articles, et avis.</p>
</header>

<?php
if(isset($_POST['password']) && password_verify($_POST['password'], "$2y$10$6nFFUwa7z172LBLT597/cOd0UHrzUCm31xYQ4pIuGj/PiZ6RuA5TC")){
?>
<section>
    <h2>Ajouter ou modifier une publication :</h2>
    <div></div>
</section>
<nav>
    <button><h3>Avis</h3></button>
    <button><h3>Réalisations</h3></button>
    <button><h3>Articles</h3></button>
</nav>
<section id="reviewsDisplay">
    <div>
        <button><i class="fas fa-chevron-left"></i></button>
        <a href="index.php?action=articlesView"></a>
        <button><i class="fas fa-chevron-right"></i></button>
    </div>
    <div></div>
</section>
<section id="projectsDisplay"></section>
<section id="articlesDisplay"></section>
<?php
}
else {
?>
<form id="passwordForm" action="#" method="post">
    <label for"name">Entrer le mot de passe :</label>
    <input type="password" name="password" required>
    <input type="submit" value="Accéder au tableau de bord">
</form>
<?php
}
?>
