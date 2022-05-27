<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Models\categorie;
use App\Models\article;
use Illuminate\Support\Facades\Redirect;
class controllerbackend extends Controller
{
    //
   public function __construct(){

        $this->middleware(['auth','isAdmin']);
    }
    public function ajoutercategorie(){
     
         return view('ajoutercateg');
    }
    public function ajouterarticle(){
     
        return view('ajouterarticle');
   }
    public function savecategorie(Request $request){
 $nom= $request['nom'];
 $userid= $request['userid'];
 $ctg = new categorie();
 $ctg->nom=$nom;
 $ctg->user_id=$userid;
$ctg->save();
return Redirect::route('affichercategorie');
}
public function savearticle(Request $request){
   $file_extension= $request->file('image')->getClientOriginalExtension();
    $file_name=time().'.'.$file_extension;
    $path='imagesbd';
    $request->file('image')->move($path,$file_name);
    $nom= $request['nom'];
    $pu= $request['pu'];
    $desc= $request['description'];
    $q= $request['quantite'];
    $ctgid= $request['ctgid'];
    $panierid= $request['panierid'];
    $art = new article();
    $art->nom=$nom;
    $art->pu=$pu;
    $art->description=$desc;
    $art->image=$file_name;
    $art->quantite=$q;
    $art->categorie_id=$ctgid;
    $art->panier_id=$panierid;
   $art->save();
   return Redirect::route('afficherarticle');
   }
   public function deletearticle(Request $request){
    $id =  $request['id'];
    $article = new article();
    $article->find($id)->delete();
    return Redirect::route('afficherarticle');
   
      
}
    public function deletecategorie(Request $request){
        //$id =  $request['id'];
        $ctg = new categorie();
        $id =$request['id'];
        $ctg->find($id)->delete();
        return Redirect::route('affichercategorie');
    }
    public function afficherarticle(){
       
        $art=new article();
        $arts=$art::all();

      return view("afficherarticle", ['articles'=>$arts] );
     

}
    public function affichercategorie(){
       
        $ctg=new categorie();
        $ctgs=$ctg::all();

      return view("affichercategorie", ['categories'=>$ctgs] );
     

}
public function afficherarticleofcategorie(Request $request){ 
    $art=new article();
    $arts=$art::where('categorie_id',$request['id'])->get();
  return view("afficherarticleofcategorie", ['articles'=>$arts,'ID'=>$request['id']] );
}
public function modifiercategorie(Request $request){
      $id=$request['id'];
       //return $id;
        return view('modifierctg',['id'=>$id]);
    }
public function savemodifiercategorie(Request $request){
    $nom= $request['nom'];
    $userid= $request['userid'];
    $ctg = new categorie();
    $ct=$ctg::find($request['id']);
    $ct->nom=$nom;
    $ct->user_id=$userid;
    $ct->save();
    return Redirect::route('affichercategorie');
   }
   public function modifierarticle(Request $request){
    $id=$request['id'];
     //return $id;
      return view('modifierart',['id'=>$id]);
  }
  public function savemodifierarticle(Request $request){
    $file_extension= $request->file('image')->getClientOriginalExtension();
    $file_name=time().'.'.$file_extension;
    $path='imagesbd';
    $request->file('image')->move($path,$file_name);
    $nom= $request['nom'];
    $pu= $request['pu'];
    $desc= $request['description'];
    $q= $request['quantite'];
    $ctgid= $request['ctgid'];
    $panierid= $request['panierid'];
    $ar = new article();
    $art=$ar::find($request['id']);
    $art->nom=$nom;
    $art->pu=$pu;
    $art->description=$desc;
    $art->image=$file_name;
    $art->quantite=$q;
    $art->categorie_id=$ctgid;
    $art->panier_id=$panierid;
   $art->save();
   return Redirect::route('afficherarticle');
 
}
public function page(){
    return view('page');
}
}