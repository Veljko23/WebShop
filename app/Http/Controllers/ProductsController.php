<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Brand;
class ProductsController extends Controller
{
    
    public function index(Request $request)
    {
        
        //$request = request();
        
        //dd($request);
        
        $formData = $request->validate([
            'product_category_id' =>['nullable', 'array', 'exists:product_categories,id'],
            'brand_id' =>['nullable', 'array', 'exists:brands,id'],
            'sort_by'=>['nullable', 'string', 'in:G,W,X,Q']
        ]);
        
        //dd($formData);
        
        $productCategories = ProductCategory::query()
                ->orderBy('priority')
                ->withCount(['products']) //daje property products_count
                ->get();
        
        $brands = Brand::query()
                ->orderBy('name', 'ASC')
                ->withCount(['products'])
                ->get();
        
  
        $productsQuery = Product::query()
                ->with(['productCategory', 'brand']); //vraca query builder u varijablu
        
        if(isset($formData['product_category_id'])){
            $productsQuery->whereIn('product_category_id', $formData['product_category_id']);
            
        }
        if(isset($formData['brand_id'])){
            $productsQuery->whereIn('brand_id', $formData['brand_id']);
            
        }
        
        if(isset($formData['sort_by'])){
            switch ($formData['sort_by']){
            case 'W':
                $productsQuery->orderBy('created_at', 'ASC');
                break;
            
            case 'X':
                $productsQuery->orderBy('price', 'ASC');
                break;
            
            case 'Q':
                $productsQuery->orderBy('price', 'DESC');
                break;
            
            default:
                $productsQuery->orderBy('created_at', 'DESC');
                break;
            }
        } else{
            //ako nije prosledjen sort_by, po defaultu ce biti najnoviji
            $productsQuery->orderBy('created_at', 'DESC');
        }
        
        
        
        $products = $productsQuery->paginate(10); // ovo je kolekcija (paginacija je vrsta kolekcije)
        
        
        $products->appends($formData);
        
        
//        $products = Product::query()
//                ->orderBy('created_at', 'DESC')
//                //->limit(10)
//                //->get()
//                ->whereIn('product_category_id', $formData['product_category_id'])
//                ->with(['productCategory', 'brand']) // ucitaj kategorije pre upita za proizvoda
//                ->paginate(30);
        $counter = 0;
        return view('front.products.index',[
            'products' => $products,
            'productCategories' => $productCategories,
            'brands' => $brands,
            'formData' => $formData,
            'counter' => $counter
        ]);
    }
    
    public function single(Request $request, Product $product, $seoSlug = null)
    {
        //ako se stari slug ne slaze sa trenutnim, redirectuj na proizvod koji trenutno vazi
        if($seoSlug != \Str::slug($product->name)){
            return redirect()->away($product->getFrontUrl());
        }
        //dd($request, $product);
        //dd($id);
        
        //$product = Product::find($id); // ModelNotFound exception se baca i treba da prikaze 404 stranu ako ne pronadje
        //dd($product);
        
        //$product = Product::findOrFail($id);
        //dd($product->productCategory->name, $product);
        
        //dd($product->sizes);
        
        //$response = response();
        
        //$response->withHeaders(['TestHeader' => 'Cubes']);
        
        //return $response->json(['test' => 'Cubes']);
        
        //return redirect()->away('http://cubes.edu.rs');
        
        $relatedProducts = Product::query()
                ->where('product_category_id', $product->product_category_id)
                ->whereNotIn('id', [$product->id])
                ->limit(10)
                ->get();
        
//        $productCategory = $product->productCategory; dohvati povezanu kategoriju
//        $relatedProducts = $productCategory->products() iz povezane kategorije dohvati relaciju kao QB
//                ->where('id', '!=', $product->id)
//                ->latest()                            DRUGI NACIN!!! napredno!
//                ->take(10)
//                ->get();
        
        return view('front.products.single', [
            'product' => $product,
            'relatedProducts' => $relatedProducts,
        ]);
    }
    
    
}
