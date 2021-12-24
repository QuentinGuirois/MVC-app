<?php

class ViewClients {

    //CONSTRUCTEUR
     //ATTRIBUT 
     private $page;

     //CONSTRUCTEUR
     public function __construct() {
         $this->page = $this->searchHTML('header');
         $this->page .= $this->searchHTML('nav');
         
     }     
        
    //**AFFICHAGE LISTE CLIENTS
    public function displayList($list) {
        $this->page .= "<h1 class=\"display-1\">Liste des Clients</h1>";
        
        //STOCKAGE LISTE <TABLE>
        //VAR
        $tableau = '<div class="container">'
        . '<table class="table table-dark" cellspacing="0">'
        . '<thead>'
        . '<th>Nom</th><th>Prénom</th><th>Adresse</th><th>CP</th><th>Ville</th><th>Com</th><th>Edit</th><th>Suppr</th>'
        . '</thead><tbody>';

        //RECUP ET INSERTION LISTE DANS TABLEAU
        foreach($list as $ligne) {
            $tableau .= "<tr><td>$ligne[1]</td>"
            ."<td>$ligne[2]</td>"
            ."<td>$ligne[3]</td>"
            ."<td>$ligne[4]</td>"
            ."<td>$ligne[5]</td>"
            ."<td>$ligne[6]</td>"
            ."<td><a href=\"index.php?controller=Clients&action=update&parm0=$ligne[0]&parm1=$ligne[1]&parm2=$ligne[2]&parm3=$ligne[3]&parm4=$ligne[4]&parm5=$ligne[5]&parm6=$ligne[6]\"><i class=\"fas fa-pen-nib\"></i></a></td>"
            ."<td><a href=\"index.php?controller=Clients&action=delete&parm0=$ligne[0]&parm1=$ligne[1]&parm2=$ligne[2]&parm3=$ligne[3]&parm4=$ligne[4]&parm5=$ligne[5]&parm6=$ligne[6]\"><i class=\"fas fa-trash-alt\"></i></a></td></tr>";
            

        }
        
        //AJOUT BALISES HTML
        $tableau .= "</tbody></table></div>";
        $this->page .= $tableau;
        $this->display();

    }

//**AFFICHAGE PAGE AJOUT CLIENT
public function displayAdd() {
    $this->page .= "<h1 class=\"display-1\">Bienvenue sur la page d'ajouts Clients</h1>";
    $paramaters = array(
        "readonly"=>"",
        "parm0"=>"",
        "parm1"=>"",
        "parm2"=>"",
        "parm3"=>"",
        "parm4"=>"",
        "parm5"=>"",
        "parm6"=>"",
        "action"=>"add",
        "lib_action"=>"Ajouter");
    
    $this->displayForm($paramaters);
}

//**AFFICHAGE PAGE MODIF CLIENTS
public function displayUpdate($paramGet) {
    $this->page .= "<h1 class=\"display-1\">Modification de Clients</h1>";
    $paramaters = array(
        "readonly"=>"",
        "parm0"=>$paramGet['parm0'],
        "parm1"=>$paramGet['parm1'],
        "parm2"=>$paramGet['parm2'],
        "parm3"=>$paramGet['parm3'],
        "parm4"=>$paramGet['parm4'],
        "parm5"=>$paramGet['parm5'],
        "parm6"=>$paramGet['parm6'],
        "action"=>"update",
        "lib_action"=>"Modifier"
    );
    $this->displayForm($paramaters);
}

//**AFFICHAGE PAGE SUPPRESSION CLIENTS
public function displayDelete($paramGet) {
    $this->page .= "<h1 class=\"display-1\">Suppression de Clients</h1>";
    $paramaters = array(
        "readonly"=>"readonly",
        "parm0"=>$paramGet['parm0'],
        "parm1"=>$paramGet['parm1'],
        "parm2"=>$paramGet['parm2'],
        "parm3"=>$paramGet['parm3'],
        "parm4"=>$paramGet['parm4'],
        "parm5"=>$paramGet['parm5'],
        "parm6"=>$paramGet['parm6'],
        "action"=>"delete",
        "lib_action"=>"Supprimer"
    );
    
    $this->displayForm($paramaters);
}

//*AFFICHAGE FORMULAIRE CLIENT
private function displayForm($paramaters) {
    $this->page .= $this->searchHTML('formClients');
    $this->page = str_replace("{readonly}", $paramaters["readonly"], $this->page);
    $this->page = str_replace("{parm0}", $paramaters["parm0"], $this->page);
    $this->page = str_replace("{parm1}", $paramaters["parm1"], $this->page);
    $this->page = str_replace("{parm2}", $paramaters["parm2"], $this->page);
    $this->page = str_replace("{parm3}", $paramaters["parm3"], $this->page);
    $this->page = str_replace("{parm4}", $paramaters["parm4"], $this->page);
    $this->page = str_replace("{parm5}", $paramaters["parm5"], $this->page);
    $this->page = str_replace("{parm6}", $paramaters["parm6"], $this->page);
    $this->page = str_replace("{action}", $paramaters["action"], $this->page);
    $this->page = str_replace("{lib_action}", $paramaters["lib_action"], $this->page);
    $this->display();
}
//AFFICHAGE PAGE GLOBAL
public function display(){
    $this->page .= $this->searchHTML('footer');
    echo $this->page;
}

//EXTRACTION DES DONNEES FICHIERS HTML
public function searchHTML($filename) {
    $content = file_get_contents('.\html\\'.$filename.'.html');
    return $content;
}
}