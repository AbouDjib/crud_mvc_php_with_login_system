<?php

abstract class Model {
    public $id=0;
    // declaration d'une variable qui va contenir des objets PDO
    private static $pdo=null;

    public function __construct(){
        $chemin= substr($_SERVER['SCRIPT_FILENAME'],0,-9) ;
        $info_cnx=file(ROOT.".env");
        // var_dump($info_cnx);
        $server=trim(explode("=",$info_cnx[1])[1]);
        $dbname=trim(explode("=",$info_cnx[3])[1]);
        $user=trim(explode("=",$info_cnx[4])[1]);
        $password=trim(explode("=",$info_cnx[5])[1]);
        self::$pdo=new PDO('mysql:host='.$server.';dbname='.$dbname,$user,$password);

    }
    public function save(){
        $data=(array) $this;
        if($this->id==0){
            $req="insert into ".get_class($this)."(";
            $fields=$values="";
            foreach($data as $key=>$value)
            {   if($key!="id")
                {
                $fields.=$key.",";
                $values.="'".$value."',";
                }
            }
            $fields=substr($fields,0,-1);
            $values=substr($values,0,-1);
            $req.=$fields.") values (".$values.")";
        }
        else{
            $req="update ".get_class($this)." set ";
            foreach($data as $key=>$value)
                if($key!="id")
                $req.=$key."='".$value."',";
                $req= substr($req,0, -1);
                $req.=" where id=".$this->id;
        }
        self::$pdo->exec($req);

    }
    public function delete(){
        $req="delete from ".get_class($this)." where id=".$this->id;
        self::$pdo->exec($req);

    }
    public static function find($id){
        $class=get_called_class();
        $req="select * from ".get_called_class()." where id=".$id;
        $o=new $class();
        $res=self::$pdo->query($req);
        $T=$res->fetch(PDO::FETCH_ASSOC);
        foreach($T as $key=>$value)
                $o->$key=$value;
            return $o;

    }
    public static function All(){
        $class=get_called_class();
        $req="select * from $class";
        new $class();
        $res=self::$pdo->query($req);
        return $res->fetchAll(PDO::FETCH_ASSOC);

    }
}

?>