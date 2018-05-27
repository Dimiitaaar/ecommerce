<?php

include "View/product.html";

/* Connexion bdd */

    define ('USER', 'root');
    define('PASSWORD', '');

    try{
        $co_db = 'mysql:host=localhost;dbname=ecommerce;charset=utf8';
        $db = new PDO($co_db, USER, PASSWORD);
    }catch (Exception $exp) {
        die('Erreur : '.$exp->getMessage());
    }

/* recupération de tous les produits */

    $reqProd = "select * from produit";
    $rs = $db->query($reqProd);
    $result = $rs->fetchAll();

/* S'il n'y a aucun produit, affiche un message sinon affiche les produits */

    if(!empty($result))
    {
        echo "<div class='row justify-content-center'>
                <div class='col-lg-6 text-center'>
                    <div class='alert alert-success mt-5 col-12' role='alert'>
                        <p>Tableau des produits</p>
                   </div>
                </div>    
              </div>";

    }
    else
    {
        echo "<div class='row justify-content-center'>
                    <div class='col-lg-6 text-center'>
                        <div class='alert alert-danger mt-5 col-12' role='alert'>
                            <p>Aucun produit disponible actuellement !</p>
                        </div>
                    </div>
                </div>";
    }



