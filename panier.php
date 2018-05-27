<?php
/* Panier ! */

session_start();

include_once ("Model/panierClass.php");
//include ("View/template.php");

$erreur = false;

$action = (isset($_POST['action'])? $_POST['action']: (isset($_GET['action'])? $_GET['action']:null ));

if($action !== null)
{
    if(!in_array($action, array('ajout', 'suppression', 'refresh')))
        $erreur = true;

    //récup des variables get and/or post
    $l = (isset($_POST['l'])? $_POST['l']:  (isset($_GET['l'])? $_GET['l']:null )) ;
    $p = (isset($_POST['p'])? $_POST['p']:  (isset($_GET['p'])? $_GET['p']:null )) ;
    $q = (isset($_POST['q'])? $_POST['q']:  (isset($_GET['q'])? $_GET['q']:null )) ;

    //Suppression des espaces verticaux
    $l = preg_replace('#\v#', '',$l);

    //On verifie que $p soit un float
    $p = floatval($p);


    //On traite $q qui peut etre un entier simple ou un tableau d'entier

    if (is_array($q)){
        $QteArticle = array();
        $i=0;
        foreach ($q as $contenu){
            $QteArticle[$i++] = intval($contenu);
        }
    }
    else
        $q = intval($q);
}

if (!$erreur){
    switch($action){
        Case "ajout":
            ajouterArticle($l,$q,$p);
            break;

        Case "suppression":
            supprimerArticle($l);
            break;

        Case "refresh" :
            for ($i = 0 ; $i < count($QteArticle) ; $i++)
            {
                modifierQTeArticle($_SESSION['panier']['libelleProduit'][$i],round($QteArticle[$i]));
            }
            break;

        Default:
            break;
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
<head>
    <meta charset="UTF-8">
<title>Votre panier</title>
</head>
<body>
    <form method="post" action="panier.php">
    <div class="intro-body">
                <div class="container2">
                                                                                                                                                                                                                                                                                                                                                        <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <h1 class="brand-heading"></h1>
                            <h2 class="intro-text">Panier</h2>
                            <section id="table" class="container1 content-section text-center">
                                <div class="row">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tr>
                                                <td>Libellé</td>
                                                <td>Quantité</td>
                                                <td>Prix Unitaire</td>
                                                <td>Action</td>
                                            </tr>


        <?php
        if (creationPanier())
        {
            $nbArticles=count($_SESSION['panier']['libelleProduit']);

            /* Si le nb article = 0 alors affiche le message panier vide */
            if ($nbArticles <= 0)
            echo "<tr><td>Votre panier est vide </td></tr>";
            else
            {
                for ($i=0 ;$i < $nbArticles ; $i++)
                {
                    echo "<tr>";
                    echo "<td>".htmlspecialchars($_SESSION['panier']['libelleProduit'][$i])."</td>";
                    echo "<td><input type=\"text\" size=\"4\" name=\"q[]\" value=\"".htmlspecialchars($_SESSION['panier']['qteProduit'][$i])."\"/></td>";
                    echo "<td>".htmlspecialchars($_SESSION['panier']['prixProduit'][$i])."</td>";
                    echo "<td><a href=\"".htmlspecialchars("panier.php?action=suppression&l=".rawurlencode($_SESSION['panier']['libelleProduit'][$i]))."\">Supprimer</a></td>";
                    echo "</tr>";
                }

                echo "<tr><td colspan=\"2\"> </td>";
                echo "<td colspan=\"2\">";
                echo "Total : ".MontantGlobal();
                echo "</td></tr>";

                echo "<tr><td colspan=\"4\">";
                echo "<input type=\"submit\" value=\"Rafraichir\"/>";
                echo "<input type=\"hidden\" name=\"action\" value=\"refresh\"/>";
                echo "<form method='post' action=''>";
                echo "<input type='submit' value='Valider' name='valider'>";
                echo "</form>";
                echo "</td></tr>";
            }
        }
        ?>
                                        </table>
    </form>
</body>
</html>