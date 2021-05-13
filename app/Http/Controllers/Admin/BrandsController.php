<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Validation\Rule;
use App\Models\Product;

class BrandsController extends Controller {

    public function index(Request $request) {
        $brands = Brand::all();

        return view('admin.brands.index', [
            'brands' => $brands
        ]);
    }

    public function add(Request $request) {
        return view('admin.brands.add', [
        ]);
    }

    public function insert(Request $request) {
        $formData = $request->validate([
            'name' => ['required', 'string', 'min:3', 'unique:brands,name'],
            'website' => ['nullable', 'string', 'max:255', 'url'],
            'photo' => ['nullable', 'file', 'image', 'max:65000']
        ]);

        $brand = new Brand();

        $brand->fill($formData);

        $brand->save();

        if ($request->hasFile('photo')) {
            //fajl photo je poslat
            $photoFile = $request->file('photo'); //vraca objekat UploadedFile klase

            //novi naziv fajla, dodaje se id brenda na pocetak
            $photoFileName = $brand->id . '_' . $photoFile->getClientOriginalName();

            $photoFile->move(public_path('/storage/brands/'), $photoFileName);

            $brand->photo = $photoFileName;
            $brand->save();

            //kropovanje slike na 300x141
            \Image::make(public_path('/storage/brands/' . $brand->photo))
                    ->fit(300, 141)
                    ->save();

            //dd($photoFile);
        }

        session()->flash('system_message', __('New brand has been saved'));

        return redirect()->route('admin.brands.index');
    }

    public function edit(Request $request, Brand $brand) {
        return view('admin.brands.edit', [
            'brand' => $brand
        ]);
    }

    public function update(Request $request, Brand $brand) {
        $formData = $request->validate([
            'name' => ['required', 'string', 'min:3', Rule::unique('brands')->ignore($brand->id)],
            'website' => ['nullable', 'string', 'url', 'max:255'],
            'photo' => ['nullable', 'file', 'image', 'max:65000']
        ]);

        $brand->fill($formData);

        $brand->save(); //update query nad bazom

        if ($request->hasFile('photo')) {

            //brisanje stare slike
            $brand->deletePhoto();

            //fajl photo je poslat
            $photoFile = $request->file('photo');

            //novi naziv fajla, dodaje se id brenda na pocetak
            $photoFileName = $brand->id . '_' . $photoFile->getClientOriginalName();

            $photoFile->move(public_path('/storage/brands/'), $photoFileName);

            $brand->photo = $photoFileName;
            $brand->save();

            \Image::make(public_path('/storage/brands/' . $brand->photo))
                    ->fit(300, 141)
                    ->save();

            //dd($photoFile);
        }

        session()->flash('system_message', __('Brand has been updated'));

        return redirect()->route('admin.brands.index');
    }

    public function delete(Request $request) {
        $formData = $request->validate([
            'id' => ['required', 'numeric', 'exists:brands,id']
        ]);

        $brand = Brand::findOrFail($formData['id']);

        //$brand->products; //relacija kao property - vraca kolekciju iz baze
        //$brand->products(); //relacija kao funkcija, vraca query builder
        //Product::query()->where('brand_id', $brand->id); //kao prethodni izraz

        //AKO BREND IMA PROIZVODE BACI EXCEPTION
        if($brand->products()->count() > 0) {
            
            session()->flash('system_error', __('There are products with brand :brand_name', ['brand_name' => $brand->name]));
            
            return redirect()->back();
        }

        $brand->delete();

        //brisanje pratecih fajlova
        $brand->deletePhoto();

        session()->flash('system_message', __('Brand has been deleted'));

        return redirect()->route('admin.brands.index');
    }
    
    public function deletePhoto(Brand $brand)
    {
        $brand->deletePhoto();//brisanje slike sa fajl sistema
        
        $brand->photo = null; //postavi polje photo da bude prazna
        $brand->save(); //sacuvaj
        
        //session()->flash('system_message', __('Photo has been deleted'));
        
        //return redirect()->route('admin.brands.edit', ['brand' => $brand->id]);
        
        return response()->json([
            "system_message" => __('Photo has been deleted'),
            "photo_url" => $brand->getPhotoUrl() //vratice defaultnu sliku, funkcija iz modela
        ]);
    }

}
