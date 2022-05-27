<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Models\categorie;
use App\Models\article;
use App\Models\panier;
use App\Models\User;
use auth;
use Illuminate\Support\Facades\Redirect;
class controllerfrontend extends Controller
{
public function mercedes(){
    $art=new article();
    $arts=$art::where('categorie_id',1)->get();
  return view("mercedes", ['articles'=>$arts]);

}
public function volkswagen(){
    $art=new article();
    $arts=$art::where('categorie_id',9)->get();
  return view("volkswagen", ['articles'=>$arts]);
}
public function audi(){
    $art=new article();
    $arts=$art::where('categorie_id',10)->get();
  return view("audi", ['articles'=>$arts]);
}
public function detail(Request $request){
    $art=new article();
    $id=$request['id'];
    $arts=$art::where('id',$id)->get();
  return view("detail", ['articles'=>$arts]);

}
    
    public function ajouteraupanier(Request $request){
      $panier=new panier();
      $user=auth::user();
       $panier->user_id=$user->id;
       $panier->save();
       $p = new panier();
       $pan=$p::where('user_id',$user->id)->get();
       foreach ($pan as $pa);
       $art=new article();
       $article=$art::find($request['idart']);
      $article->panier_id= $pa->id;
       $article->save();
    return view('test');
    }
    public function afficherpanier(){
     $user=auth::user();
     $panier=new panier();
     $pan=$panier::where('user_id',$user->id)->get();
     foreach ($pan as $p);
     $art=new article();
     $article=$art::where('panier_id',$p->id)->get();
     return view('afficherpanier',['articles'=>$article]);
    }
    public function deletepanier(Request $request){
     /* $user=auth::user();
      $panier=new panier();
      $pan=$panier::where('user_id',$user->id)->get();
      foreach ($pan as $p);*/
      $art=new article();
      $article=$art::find($request['id']);
     $article->panier_id=1;
     $article->save();
      return Redirect::route('afficherpanier');
     }
}
