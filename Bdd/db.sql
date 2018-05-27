  create database ecommerce;
  use ecommerce;

  CREATE TABLE Utilisateur(
          idUtilisateur int (11) Auto_increment  NOT NULL ,
          pseudo Varchar (50) ,
          email Varchar (80) ,
          mdp Varchar (25) NOT NULL ,
          PRIMARY KEY (idUtilisateur )
  )ENGINE=InnoDB;

  CREATE TABLE Produit(
          idProduit int (11) Auto_increment  NOT NULL ,
          nom Varchar (50) ,
          description VARCHAR (50),
          prix Float ,
          stock Int ,
          PRIMARY KEY (idProduit )
  )ENGINE=InnoDB;

  insert into Produit VALUES (1, "test", 1.11, 100);


  CREATE TABLE Categorie(
    idCategorie INT (5) auto_increment not null,
    nom VARCHAR (100) NOT NULL,
    PRIMARY KEY (idCategorie)
  )ENGINE=InnoDB;

  CREATE TABLE Categorie_produit(
    produit_id INT ,
    categorie_id INT ,
    PRIMARY KEY (produit_id, categorie_id)
  )ENGINE=InnoDB;

  CREATE TABLE Commande(
          idCommande int (11) Auto_increment  NOT NULL ,
          dateCommande  Date ,
          totalCommande Float ,
          idUtilisateur Int NOT NULL ,
          PRIMARY KEY (idCommande )
  )ENGINE=InnoDB;

  CREATE TABLE acheter(
          idAcheter int (11) Auto_increment  NOT NULL ,
          idUtilisateur Int NOT NULL ,
          idProduit Int NOT NULL ,
          PRIMARY KEY (idAcheter, idUtilisateur ,idProduit )
  )ENGINE=InnoDB;


  ALTER TABLE Categorie_produit
  ADD CONSTRAINT fk_produit_cat FOREIGN KEY (produit_id) REFERENCES Produit(idProduit);
  ALTER TABLE Categorie_produit
  ADD CONSTRAINT fk_categorie_cat FOREIGN KEY (categorie_id) REFERENCES Categorie(idCategorie);

  ALTER TABLE Commande
  ADD CONSTRAINT FK_Commande_idUtilisateur FOREIGN KEY (idUtilisateur) REFERENCES Utilisateur(idUtilisateur);

  ALTER TABLE acheter
  ADD CONSTRAINT FK_acheter_idUtilisateur FOREIGN KEY (idUtilisateur) REFERENCES Utilisateur(idUtilisateur);
  ALTER TABLE acheter
  ADD CONSTRAINT FK_acheter_idProduit FOREIGN KEY (idProduit) REFERENCES Produit(idProduit);

/* un pseudo peut être utiliser que par un seul utilisateur */
  CREATE UNIQUE INDEX unique_pseudo
  ON Utilisateur(pseudo);

/* un mail peut être utiliser que par un seul utilisateur */
  CREATE UNIQUE INDEX unique_email
  ON Utilisateur(email);

  CREATE INDEX index_date_commande
  ON Commande(dateCommande);