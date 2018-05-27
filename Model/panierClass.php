<?php
/**
 * Created by PhpStorm.
 * User: 898810
 * Date: 02/02/2018
 * Time: 17:15
 */

/*
 * creation panier function createPanier
 * ajout produit function insertproduit
 * suppression produit DeleteProduit
 * modif nb produit update modifNbProduit
 * suppression panier deletePanier
 * montant global function montantTotal
 * verrouiller (a voir) isVerouille
 * compter nb articles nbproduit
 */

//creation du panier avec les infos dont on aura besoin
    function createPanier()
    {
        if(!isset($_SESSION['panier']))
        {
            $_SESSION['panier'] = array();
            $_SESSION['panier']['nom'] = array();
            $_SESSION['panier']['qte'] = array();
            $_SESSION['panier']['prix'] = array();
            $_SESSION['panier']['verrou'] = false;//voir fonction isVerrouille
        }
        return true;
    }

    //ajout du produit selectionné dans le panier avec le libelle, la quantite et le prix
    function ajoutProduit($libelle, $qte, $prix)
    {
        if(creationPanier() && !isVerrouille())
        {
            $posproduit = array_search($libelle, $_SESSION['panier']['libelle']);

            if($posproduit !== false)
            {
                $_SESSION['panier']['qte'][$posproduit] += $qte;
            }
            else{
                array_push($_SESSION['panier']['libelle'], $libelle);
                array_push($_SESSION['panier']['qte'], $qte);
                array_push($_SESSION['panier']['prix'], $prix);
            }
        }
        else{
            echo "Problème !";
        }
    }

    //suppression du produit selectionné depuis le panier
    function supprimerProduit($libelle)
    {
        if(createPanier() && isVerrouille())
        {
            $tmp = array();
            $tmp ['libelle'] = array();
            $tmp ['qte'] = array();
            $tmp ['prix'] = array();
            $tmp['verrou'] = $_SESSION['panier']['verrou'];

            for($i = 0; $i < count($_SESSION['panier']['libelle']); $i++)
            {
                if($_SESSION['panier']['libelle'][$i] !== $libelle)
                {
                    array_push($tmp ['libelle'], $_SESSION['panier']['libelle'][$i]);
                    array_push($tmp ['qte'], $_SESSION['panier']['qte'][$i]);
                    array_push($tmp ['prix'], $_SESSION['panier']['prix'][$i]);

                }
            }

            $_SESSION['panier'] = $tmp;
            unset($tmp);
        }
        else
            echo "Problème !";
    }

    //permet de modifier la quantite d'un produit depuis le panier
    function modifierQteProduit($libelle, $qte)
    {
        if(createPanier() && isVerrouille())
        {
            if($qte > 0)
            {
                $posproduit = array_search($libelle, $_SESSION['panier']['libelle']);

                if($posproduit !== false)
                {
                    $_SESSION['panier']['qte'][$posproduit] = $qte;
                }
            }
            else
                supprimerProduit($libelle);
        }
        else
            echo "Problème !";
    }

    //calcul le montant global des produtis qui sont dans le panier
    function montantGlobal()
    {
        $total = 0;
        for($i = 0; $i < count($_SESSION['panier']['libelle']); $i++)
        {
            $total += $_SESSION['panier']['qte'][$i] * $_SESSION['panier']['prix'][$i];
        }
        return $total;
    }

    //a activer pour passer au paiement du panier - verrouille toute action sur le panier
    function isVerrouille()
    {
        if(isset($_SESSION['panier']) && $_SESSION['panier']['verrou'])
            return true;
        else
            return false;
    }

    function compterArticles()
    {
        if(isset($_SESSION['panier']))
            return count($_SESSION['panier']['libelle']);
        else
            return 0;
    }

    //suppression du panier en cours
    function supprimerPanier()
    {
        unset($_SESSION['panier']);
    }