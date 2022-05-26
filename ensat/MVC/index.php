<?php
$chemin= substr($_SERVER['SCRIPT_FILENAME'],0,-9) ;
define("ROOT", $chemin);

//chargement du model et du controleur principal
include_once ROOT.'Models/Model.php';
include_once ROOT.'Controllers/Controller.php';
include_once ROOT.'views/public/header.php';

$url=$_GET['url'];
$id=0; 
$infos_url=explode("/",$url);
if($infos_url[0]!=""){
    if(file_exists(ROOT.'Controllers/'.$infos_url[0].".php"))
    {
        $action= "index";
        include_once ROOT.'Controllers/'.$infos_url[0].".php";
        $controleur=new $infos_url[0]();
        $action="index";
        if(isset($infos_url[1]))
        
            $action=$infos_url[1];
         if(method_exists($controleur,$action)){
            $request=null;
                if(isset($infos_url[2]))
                    $id=$infos_url[2];
                if(!empty($_POST))
                {
                     $request=new stdClass();
                     foreach($_POST as $key=>$value)
                        $request->$key=$value;
                }
            if($request != null)
                if($id!=0)
                    $controleur->$action($id,$request);
                else    
                    $controleur->$action($request);
    
                else
                if($id==0) $controleur->$action();
                else $controleur->$action($id);
            } 
            else   
            echo "url introuvable!!!";
    }


    else 
    echo "url introuvable !!!";
}
else
{
    ?>
    <center>
        <h1> <a href="Profs"> >> Gestion des profs</a></h1>
        <h1> <a href="Etudiants"> >> Gestion des Etudiants</a></h1>
    </center>
    <?php
}



//include_once ROOT.'views/public/footer.php';
?>