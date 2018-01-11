<!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8" />

    <title>Installation bdd</title>
    <link rel="stylesheet" href="../public/assets/css/bootstrap.css">
    <link rel="stylesheet" href="../public/assets/css/bootstrap.min.css">

</head>

<body>

<h1>INSTALLATION DE LA BASE DE DONNEES MYSTARRELARIA</h1>



<button type="submit" class="btn btn-primary mb-2">Installer</button>

<p>

<?php

include '../ressources/config/database.connexion.php';

$script_path = '';
$command = 'mysql'
    . ' --host=' . DBHOST
    . ' --user=' . DBUSERNAME
    . ' --password=' . DBPASSWORD
    . ' --database=' . DBNAME
    . ' --execute="SOURCE ' . $script_path
;
$output1 = shell_exec($command . './database.sql');

var_dump($output1);

###########################################################


/*$connexion = '../ressources/config/database.connexion.php';


function executeSqlFile(){
       $req = file_get_contents('./database.sql'); # Requete du fichier SQL
       $array = explode(PHP_EOL, $req); #
       foreach ($array as $sql) {
              if ($sql != '') {
                       Sql($sql);
                  }
          }
}*/

#############################################################

#include '../ressources/config/database.connexion.php'; # Parametres BDD

#$bdd = mysql_connect(DBHOST,DBUSERNAME,DBPASSWORD);
#mysql_connect_db(DBNAME, $bdd);


#$requetes = "";

#$sql=file("fichier.sql"); # On charge le fichier SQL
#foreach ($sql as $l){ # On le lit
    #   if (substr(trim($l), 0,2)!="--"){ # Supprime les commentaires
#        $requetes .= $l;
#    }
#}

#$reqs = split(";", $requetes); # Separation des requetes
#foreach ($reqs as $requ){ # On les execute
#    if (!mysql_query($requ,$bdd) && trim($requ) != "") {
#        die("ERROR : " . $requ); # Stop si Erreur
#    }
#}
echo "Base installé";