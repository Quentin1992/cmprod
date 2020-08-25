<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="icon" href="public/images/eye.jpg" />

    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <!-- header and footer css stylesheets -->
    <link rel="stylesheet" href="public/css/style.css" />
    <link rel="stylesheet" media="screen and (max-width: 1440px)" href="public/css/style-medium.css">
    <link rel="stylesheet" media="screen and (max-width: 1024px)" href="public/css/style-small.css">
    <link rel="stylesheet" media="screen and (max-width: 768px)" href="public/css/style-tablet.css">
    <link rel="stylesheet" media="screen and (max-width: 426px)" href="public/css/style-smartphone.css">

    <!-- pages stylesheets -->
    <link rel="stylesheet" href="public/css/<?php echo $page ?>/<?php echo $page ?>Page.css">
    <link rel="stylesheet" media="screen and (max-width: 1440px)" href="public/css/<?php echo $page ?>/<?php echo $page ?>Page-medium.css">
    <link rel="stylesheet" media="screen and (max-width: 1024px)" href="public/css/<?php echo $page ?>/<?php echo $page ?>Page-small.css">
    <link rel="stylesheet" media="screen and (max-width: 768px)" href="public/css/<?php echo $page ?>/<?php echo $page ?>Page-tablet.css">
    <link rel="stylesheet" media="screen and (max-width: 426px)" href="public/css/<?php echo $page ?>/<?php echo $page ?>Page-smartphone.css">

    <!-- specific elements stylesheets -->
    <?php if($page == ("index" || "backend")){ ?>
    <link rel="stylesheet" href="public/css/index/reviews.css" />
    <link rel="stylesheet" media="screen and (max-width: 1024px)" href="public/css/index/reviews-small.css">
    <link rel="stylesheet" media="screen and (max-width: 768px)" href="public/css/index/reviews-tablet.css">
    <?php }
    if($page == ("articles" || "backend")){ ?>
    <link rel="stylesheet" href="public/css/articles/articles.css" />
    <link rel="stylesheet" media="screen and (max-width: 768px)" href="public/css/articles/articles-tablet.css">
    <?php }
    if($page == ("projects" || "backend")){ ?>
    <link rel="stylesheet" href="public/css/projects/projects.css" />
    <link rel="stylesheet" media="screen and (max-width: 1440px)" href="public/css/projects/projects-medium.css">
    <link rel="stylesheet" media="screen and (max-width: 1024px)" href="public/css/projects/projects-small.css">
    <link rel="stylesheet" media="screen and (max-width: 426px)" href="public/css/projects/projects-smartphone.css">
    <?php } ?>

    <!-- javascript scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <?php if($page == ("index" || "projects" || "skills" || "articles" || "contact")){ ?>
    <script src="public/js/frontend/eyeblink.js"></script>
    <?php }
    if($page == ("index" || "projects" || "articles" || "backend")){ ?>
    <script src="public/js/ajax.js"></script>
    <?php }
    if($page == "index"){ ?>
    <script src="public/js/video.js"></script>
    <?php }
    if($page == ("articles" || "backend")){ ?>
    <script src="public/js/ArticlesHandler.js"></script>
    <script src="public/js/Converter.js"></script>
    <?php }
    if($page == ("projects" || "backend")){ ?>
    <script src="public/js/ProjectsHandler.js"></script>
    <?php }
    if($page == ("index" || "backend")){ ?>
    <script src="public/js/ReviewsHandler.js"></script>
    <?php }
    if($page == "backend"){ ?>
    <script src="public/js/backend/<?= $page ?>.js"></script>
    <?php } else{ ?>
    <script src="public/js/frontend/<?= $page ?>.js"></script>
    <?php } ?>
</head>

<body>
    <?php if(($page != "backend") && ($page != "index")){ ?>
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
                <a href="#"><i class="fas fa-bars"></i></a>
            </nav>
            <div>
                <a href="https://www.instagram.com/chaudmirette_prod/"><i class="fab fa-instagram"></i></a>
                <a href="https://fr.linkedin.com/in/roxane-balcerek-718728134"><i class="fab fa-linkedin-in"></i></a>
                <a href="https://www.youtube.com/channel/UCTnIumn2sT4wIQL3qFRteRA/videos"><i class="fab fa-youtube"></i></a>
                <a href="https://www.facebook.com/chaud.mirette/"><i class="fab fa-facebook-f"></i></a>
            </div>
        </div>
    </div>
    <?php } ?>

    <?= $content ?>

    <?php if($page != "backend"){ ?>
    <footer>
        <div>
            <h3>Vous avez un <span>projet ?</span></h3>
            <a href="index.php?action=contactView">Contactez-nous</a>
            <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fchaud.mirette%2F&tabs=messages&width=340&height=299&small_header=true&adapt_container_width=true&hide_cover=true&show_facepile=false&appId=131622276870917" width="340" height="299" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
        </div>
        <div>
            <div>
                <img src="public/images/logos/inlineLogo.jpg" alt="logo oeil Chaud Mirette Productions">
            </div>
            <div>
                <a href="index.php?action=projectsView">Réalisations</a>
                <a href="index.php?action=skillsView">Compétences</a>
                <a href="index.php?action=contactView">Contact</a>
            </div>
            <div>
                <a href="https://www.instagram.com/chaudmirette_prod/"><i class="fab fa-instagram"></i></a>
                <a href="https://fr.linkedin.com/in/roxane-balcerek-718728134"><i class="fab fa-linkedin-in"></i></a>
                <a href="https://www.youtube.com/channel/UCTnIumn2sT4wIQL3qFRteRA/videos"><i class="fab fa-youtube"></i></a>
                <a href="https://www.facebook.com/chaud.mirette/"><i class="fab fa-facebook-f"></i></a>
            </div>
        </div>
        <div>
            <p>Copyright &copy;2019 Chaud Mirette Productions - Mentions légales</p>
            <p><a href="index.php?action=privacyView">Politique de confidentialité</a> - Sitemap</p>
            <p>Drone icon from <a href="www.freepik.com">www.freepik.com</a></p>
            <p>Site développé par <a href="https://qbog.fr/">Quentin Bogaert</a></p>
        </div>
    </footer>
    <?php } ?>
</body>

</html>
