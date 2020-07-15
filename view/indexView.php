<?php
$title = "Chaud Mirette Productions - Qui sommes-nous ?";
$page = "index";
 ?>

<header id="container">
    <video id="video" poster="public/images/frontend/showreel-light.png">
        <source src="public/videos/showreel_720.mp4" type="video/mp4">
        Votre navigateur ne supporte pas la balise "video".
    </video>
    <button id="video-button">Voir notre showreel<i class="fas fa-play"></i></button>
    <div>
        <div>
            <svg width="100%" height="10px"><line id="seek-bar" x1="0" y1="0" x2="0%" y2="0" /></svg>
        </div>
        <i id="full-screen" class="fas fa-expand"></i>
    </div>
</header>
<div id="navbar">
    <div>
        <a href="index.php">
            <img src="public/images/logos/inlineLogo.jpg" alt="logo oeil Chaud Mirette Productions">
        </a>
    </div>
    <div>
        <nav>
            <a href="index.php?action=projectsView">Réalisations</a>
            <a href="index.php?action=skillsView">Compétences</a>
            <a href="index.php?action=articlesView">On parle de nous</a>
            <a href="index.php?action=contactView">Contact</a>
        </nav>
        <div>
            <a href="https://www.instagram.com/chaudmirette_prod/"><i class="fab fa-instagram"></i></a>
            <a href="https://fr.linkedin.com/in/roxane-balcerek-718728134"><i class="fab fa-linkedin-in"></i></a>
            <a href="https://www.youtube.com/channel/UCTnIumn2sT4wIQL3qFRteRA/videos"><i class="fab fa-youtube"></i></a>
            <a href="https://www.facebook.com/chaud.mirette/"><i class="fab fa-facebook-f"></i></a>
        </div>
    </div>
</div>
<section id="whoAreWe">
    <div>
        <h2>Qui sommes-<span>nous ?</span></h2>
        <p>C'est à la suite de longues études de photographie, de cinéma et de journalisme, que Chaud Mirette Productions a vu le jour en tant que société de productions audiovisuelles.<br />
        Très rapidement, elle a su s'imposer dans le milieu audiovisuel.<br />
        Savoir-faire unique, mise-en-oeuvre de moyens techniques, professionnalisme en toute situation, passion du métier, sont d'autant de facteurs qui forgent aujourd'hui, la renommée de Chaud Mirette Productions.<br />
        C'est grâce à cette réputation et à ces compétences, qu'une multitude de clients nous font aujourd'hui totalement confiance.<br />
        Pour en savoir plus, et tentez vous aussi l'expérience de prestations audiovisuelles de qualité, contactez-nous ici.</p>
        <a href="index.php?action=contactView">Contactez-nous</a>
    </div>
    <div>
        <img src="public/images/frontend/index/whoAreWe-light.png">
    </div>
</section>
<section id="ourProjects">
    <img src="public/images/frontend/index/ourProjects-light.png">
    <div>
        <h2>Nos <span>réalisations</span></h2>
        <p>Réalisations audiovisuelles publicitaires, événementielles, promotionnelles, artistiques, atypique, dynamique, moderne ?<br />
        La multidisciplinarité de nos réalisations, la constante recherche de perfection ainsi que l'écoute du client et de ses désirs, font que nos réalisations d'aujourd'hui possèdent un réel impact visuel et un véritable attrait pour les clients ciblés par ce support communicatif.</p>
        <a href="index.php?action=projectsView">Découvrir</a>
    </div>
</section>
<section id="reviewsDisplay">
    <div>
        <button><i class="fas fa-chevron-left"></i></button>
        <a href="index.php?action=articlesView"></a>
        <button><i class="fas fa-chevron-right"></i></button>
    </div>
</section>
<section id="ourSkills">
    <div>
        <img src="public/images/frontend/index/ourSkills-light.png">
    </div>
    <div>
        <h2>Nos <span>compétences</span></h2>
        <p>Rigueur, minutie et persévérance sont les maîtres-mots qui définissent notre travail.<br />
        Au terme de notre collaboration, il en résultera donc un support de communication, de qualité, qui respecte votre ADN autant que vos choix et vos envies.<br />
        Mais également, une réalisation qui se veut autant artistique que marketing.<br />
        Faire appel à Chaud Mirette Productions, c’est avoir la certitude de traiter avec des professionnels de l’image, capables d’accroître votre image, comme votre visibilité sur le marché.</p>
        <a href="index.php?action=skillsView">Découvrir</a>
    </div>
</section>
