<?php

class Profs extends Controller {
    public function __construct(){
        parent::__construct('Prof');
    }
    public function index(){
        parent::view("index",Prof::All());

    }
    public function show($id){
        parent::view("show",Prof::find($id));

    }
    public function destroy($id){
        $P=Prof::find($id);
        $P->delete();
        $this->Redirect("../../Profs");

    }
    public function store($request){
        $P=new Prof();
        $P->nom=$request->nom;
        $P->prenom=$request->prenom;
        $P->specialite=$request->specialite;
        $P->save();
        $this->Redirect("../Profs");

    }
    public function edit($id){
        parent::view("form",Prof::find($id));
        
    }
    public function update($id,$request){
        $P=Prof::find($id);
        $P->nom=$request->nom;
        $P->prenom=$request->prenom;
        $P->specialite=$request->specialite;
        $P->save();
        $this->Redirect("../../Profs");
    }
    
    public function create(){
        parent::view("form");
    }

}
?>