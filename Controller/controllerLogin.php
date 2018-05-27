<?php

/* Retrieve Action */

$action = null;

if (isset($_REQUEST['action'])) {
    $action = $_REQUEST['action'];
} else {
    $action = 'default';
}

/* Switch permettant : Soit de se connecter avec ses identifiants ou  de se Déconnecter  */

switch ($action) {

    case 'login':

        /* Récupération de l'email et du mot de passe insérer */

        $email = $_REQUEST['email'];
        $mdp = $_REQUEST['mdp'];

        /* Connection à la bdd */

        define('USER', 'root');
        define('PASSWORD', '');

        try {
            $co_db = 'mysql:host=localhost;dbname=ecommerce;charset=utf8';
            $db = new PDO($co_db, USER, PASSWORD);
        } catch (Exception $exp) {
            die('Erreur : ' . $exp->getMessage());
        }

        /* Requete pour recupérer les données concernant l'utilisateur voulant se connecter */

        $requete = "select * from utilisateur where email='$email' and mdp='$mdp'";
        $rs = $db->query($requete);
        $result = $rs->fetchAll();

        /* Vérification des données insérer par l'utilisateur et affiche un message d'erreur en cas de mauvaise(s) insertion(s) de données  */

        if(empty($result))
        {
            echo "<div class='container-fluid'><div class='col-lg-12 text-center mt-5'><div class='alert alert-danger'><p>Le compte '".$email."' et/ou le mot de passe sont incorrects !</p></div></div></div>";

        }
        else
        {
            $_SESSION['idUtilisateur'] = $result[0]['idUtilisateur'];
            $_SESSION['pseudo'] = $result[0]['pseudo'];
            $_SESSION['email'] = $result[0]['email'];
            $_SESSION['mdp'] = $result[0]['mdp'];

            /*echo "<div class='container-fluid'><div class='col-lg-12 text-center mt-2'><div class='alert alert-success'><p>Vous êtes à présent connecter '".$_SESSION['pseudo']."' !</p></div></div></div>";*/

            header('Location: e-commerce?page=home');
        }

        /* Bdd null */

        $db = null;

        break;


    /* Case permettant de se deconnecter de son compte */
    case 'logout' :

        $_SESSION = null;
        session_destroy();
        header('Location: e-commerce?page=login');

        break;

    case 'default':
        break;

}

/* Vue de la page Login */

include "/View/login.html";