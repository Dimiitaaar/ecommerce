<!DOCTYPE html>
<html>
<head>
    <title>I-Quipment</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body id="top">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="position: fixed; top:0; z-index: 999999; width: 100vw;">
        <a class="navbar-brand" href="?page=home" title="IQ">IQuipment</a>
            <div class="collapse navbar-collapse" id="navBar">

                <!-- Permet d'afficher les liens(accueil/produits/inscription et connexion de la navbar si l'utilisateur n'est pas connecté -->
                <?php if(!isset($_SESSION['idUtilisateur'])) : ?>
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link fa fa-home fa-lg" href="?page=home" title="Accueil"></a>
                            <a class="nav-link fa fa-building fa-lg" href="?page=company" title="Entreprise"></a>
                            <a class="nav-link fa fa-product-hunt fa-lg" href="?page=product" title="Produits"></a>
                            <a class="nav-link fa fa-pencil fa-lg" href="?page=signin" title="Inscription"></a>
                            <a class="nav-link fa fa-sign-in fa-lg" href="?page=login" title="Connexion"></a>
                        </li>
                    </ul>

                <!-- Sinon affiche seulement l'accueil et les produts -->
                <?php else : ?>
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link fa fa-home fa-lg" href="?page=home" title="Accueil"></a>
                            <a class="nav-link fa fa-product-hunt fa-lg" href="?page=product" title="Produits"></a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ml-auto mr-0">
                        <li class="nav-item">
                                <a class="nav-link" href="#"><?php echo $_SESSION['pseudo']; ?></a><!-- Affiche le pseudo de l'utilisateur s'il est connecté -->
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="?page=login&&action=logout" title="Deconnexion"><span class="fa fa-power-off fa-lg"></span></a><!-- Bouton deconnexion pour sortir de sa session sur le site -->
                        </li>
                    </ul>
                <?php endif; ?>
            </div>

    </nav>
    <!--</*?php var_dump($_SESSION); ?*/>-->

    <?= $content ?>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>

</body>
</html>