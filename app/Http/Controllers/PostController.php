<?php


namespace App\Http\Controllers;


use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller{

    //Dohvati objave
    public function dohvatiObjave($cat_id)
    {
        if ($cat_id == "all"){
            return Post::all();
        }else{
            return Post::where("kategorija_id", "=", $cat_id)->get();
        }
    }

    //Dohvati objavu
    public function dohvatiObjavu($id)
    {
        return Post::where("id", "=", $id)->get();

    }

    //Dodaj novu objavu
    public function novaObjava(Request $request)
    {
        $objava = new Post();

        $objava->naslov = $request->naslov;
        $objava->autor = $request->autor;
        $objava->tekst = $request->tekst;
        $objava->kategorija_id = $request->kategorija_id;

        $objava->save();

        return "Uspješno dodana objava";

    }

    //Uredi objavu
    public function urediObjavu(Request $request)
    {
        $objava =Post::find($request->id);

        $objava->naslov = $request->naslov;
        $objava->autor = $request->autor;
        $objava->tekst = $request->tekst;
        $objava->kategorija_id = $request->kategorija_id;

        $objava->save();

        return "Objava uspješno ažurirana";

    }

    //Obriši objavu
    public function obrisiObjavu($id)
    {
        $objava = Post::find($id);
        $objava->forceDelete();

        return "Objava uspješno obrisana";
    }



}
