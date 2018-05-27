<?php
/* classe modele pour faire les fonctions */
    class Modele
    {
        private $pdo;
        private $table;

        //config bdd serveur bdd user mdp
        public function __construct($serveur, $bdd, $user, $mdp)
        {
            $this->pdo = null;

            try{
                $this->pdo  = new PDO("mysql:host=".$serveur.";dbname=ecommerce".$bdd, $user, $mdp);
            }
            catch(Exception $exp)
            {
                echo "Erreur de connexion à la BDD";
            }
        }

        //renseignement de la table
        public function renseigner($table)
        {
            $this->table = $table;
        }


        //selection des données de la table en question
        public function selectAll()
        {
            if($this->pdo != null)
            {
                $requete ="select * from ".$this->table.";";
                $select = $this->pdo->prepare($requete);
                $select->execute();
                $resultats = $select->selectAll(PDO::FETCH_OBJ);

                return $resultats;
            }
            else return null;
        }

        //selection des données selon les champs, la table et la condition saisis
        public function selectWhere($tab, $where)
        {
            $champs = implode(",", $tab);
            $clause = array();

            foreach ($where as $cle=>$valeur)
            {
                $clause[] = $cle." = :".$cle;
                $donnees[":".$cle] = $valeur;
            }

            $chaine = implode(' and',$clause);
            $requete = "select ".$champs."from ".$this->table."where ".$chaine." ;";

            if($this->pdo != null)
            {
                $select = $this->pdo->prepare($requete);
                $select->execute($donnees);
                $resultats = $select->fetchAll();

                return $resultats;
            }
            else return null;
        }


        //selection des données selon la categorie voulue
        public function selectWhereCategorie($categorie)
        {
            $requete = "select * from  where ;";
            $donnees = array(":categorie"=>implode('', $categorie)); //implode permet de rassembler les élements d'un tableau en une chaine

            if($this->pdo != null)
            {
                $select = $this->pdo->prepare($requete);
                $select->execute($donnees);

                $resultats = $select->fetchAll();

                return $resultats;
            }
            else return null;
        }

        //insertion des données selon la table, les champs et les valeurs saisis de ces derniers
        public function insert($tab)
        {
            $champs = array();
            $valeurs = array();
            $donnees = array();

            foreach($tab as $cle => $valeur)
            {
                $champs[] = $cle;
                $valeurs[] = ":".$cle;
                $donnees[":".$cle] = $valeur;
            }

            $chaineChamps = implode(",", $champs);
            $chaineValeurs = implode(",", $valeurs);
            $requete = "insert into ".$this->table."(".$chaineChamps.") values (".$chaineValeurs.");";

            $insert = $this->pdo->prepare($requete);
            $insert->execute($donnees);
        }
    }
