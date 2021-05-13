<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Brand;
use App\Models\Product;

class IndexController extends Controller
{
    public function index()
    {

        
       // $query = \DB::table('brands'); //jednako je select all from brands
        
        //dd($query->first());
        
//        $query->orderBy('name', 'DESC')
//                    ->orderBy('created_at')
//                    ->where('name', 'LIKE', '%7')
//                    ->where('id', '>', 6)
//                    ->whereIn('id', [4,6,9])
//                ; //sortiraj po imenu opadajuce
//        
//        dd($query->toSql()); // daje sql kod koji se izvrsava
//        
//        $brands = $query->get()->toArray(); // daj sve kao niz
//        dd($brands);
        
//        $brands = \DB::table('brands')
//                ->orderBy('name', 'ASC')
//                ->get()->toArray();
        
        //$brands = Brand::all(); //dobijanje kolekcije svih redova iz tabele
        $brands = Brand::query() // dobijanje query buildera koji je automatski vezan za tabelu
                ->orderBy('name')
                ->get();
        //dd($brands);
        
        
        //$brand = Brand::first(); //prvi red iz tabele
        //dd($brand->id); //pristu jednoj koloni iz reda, npr id
        //dd($brand['id']);
        
        //$brand = Brand::query()->where('id', 3)->first(); //dobijanje reda po id
        //$brand = Brand::find(3); // dobijanje reda po id SKRACENO!
        //dd($brand->name);
        
        
        
        $newArrivals = Product::query()
                ->newArrivals() //upotreba local scope-a
                ->limit(10)
                ->with(['brand'])
                ->get();
        
        //dd($newArrivals);
        
        return view('front.index.index', [
            'newArrivalProducts' => $newArrivals,
            'brands' => $brands,
        ]);
        
        
        
    }
}
