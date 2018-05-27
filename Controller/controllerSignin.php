<?php

    $action = null;

    if(isset($_REQUEST['action']))
    {
        $action = $_REQUEST['action'];
    }else{
        $action ='default';
    }

    //switch action
    switch($action)
    {
        //si l'user vuet s'enregistrer, on a besoin de 3 champs
        case 'signin' :
            $pseudo = $_REQUEST['pseudo'];
            $email = $_REQUEST['email'];
            $mdp = $_REQUEST['mdp'];

            //constante pour user et password de la bdd
            define('USER', 'root');
            define('PASSWORD', '');

            try{
                $co_db = 'mysql:host=localhost;dbname=ecommerce;charset=utf8';
                $db = new PDO($co_db, USER, PASSWORD);
            } catch (Exception $exc) {
                die('Erreur : '.$exc->getMessage());
            }

            //insertion de l'utilisateur dans la bdd avec ses infos
            $req = "insert into utilisateur (pseudo, email, mdp) values ('".$pseudo."', '".$email."', '".$mdp."')";
            $res = $db->exec($req);

            //Affichage d'un message en cas d'echec ou de succés de l'inscription
            if($res == false)
            {
                echo "<div class='container-fluid'><div class='col-lg-12 text-center'><div class='alert-danger'>Inscription impossible !</div></div></div>";
            } else {
                echo "<div class='container-fluid'><div class='col-lg-12 text-center'><div class='alert-success'>Inscription Réussie !</div></div></div>";
            }

            $db = null;

            break;

        default:
            break;

    }

    require "/View/signin.html";