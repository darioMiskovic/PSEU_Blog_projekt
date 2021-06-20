<?php


namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{

    public function dohvatiKategorije()
    {
        return Category::all();

    }

    public function spremiKategoriju(Request $request)
    {
        $kat = new Category();
        $kat->kategorija = $request->kategorija_naziv;
        $kat->save();

        return $request->kategorija_naziv;

    }

    //Uredi kategoriju
    public function urediKategoriju(Request $request)
    {
        $kat =Category::find($request->kategorija_id);
        $kat->kategorija = $request->kategorija_naziv;
        $kat->save();

        return "Kategorija uspješno ažurirana";


    }


    //Obriši kategoriju
    public function obrisiKategoriju($id)
    {
        $kat = Category::find($id);
        $kat->forceDelete();

        return "Kategorija uspješno obrisana";
    }


}
