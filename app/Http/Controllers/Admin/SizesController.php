<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Size;
use Illuminate\Validation\Rule;

class SizesController extends Controller
{
    public function index(Request $request)
    {
        //$systemMessage = session()->pull('system_message');
        $sizes = Size::all();
        
        return view('admin.sizes.index', [
            'sizes' => $sizes,
            //'systemMessage' => $systemMessage
        ]);
    }
    
    public function add(Request $request)
    {
        return view('admin.sizes.add', [
            
        ]);
    }
    
    public function insert(Request $request)
    {
        $formData = $request->validate([
            'name' => ['required', 'string', 'max:10', 'unique:sizes,name']
        ]);
        
        //novi model u memoriji, jos nije sacuvan u bazi
        $newSize = new Size();
        //setovanje kolone, setuj name kao sto je u formData
        
        //PRVI NACIN CUVANJA - JEDNA PO JEDNA KOLONA
        // $newSize->name = $formData['name'];
        
        //DRUGI NACIN - MASS ASINGMENT - VISE KOLONA ODJEDNOM
        $newSize->fill($formData);
        //objekat pre snimanja u bazu
        //dump($newSize);
        //cuva promene nad redom u bazi
        $newSize->save();
        //objekat posle snimanja u bazu
        //dd($newSize);
        
        session()->flash('system_message', __('New size has been saved!'));
        
        return redirect()->route('admin.sizes.index');
    }
    
    public function edit(Request $request, Size $size)
    {
         return view('admin.sizes.edit', [
            'size' => $size
        ]);
    }
    
    public function update(Request $request, Size $size)
    {
        $formData = $request->validate([
            'name' =>['required', 'string', 'max:10', Rule::unique('sizes')->ignore($size->id)]
        ]);
        
        $size->fill($formData);
        
        $size->save();
        
        session()->flash('system_message', __('Size has been updated!'));
        
        return redirect()->route('admin.sizes.index');
    }
    
    public function delete(Request $request)
    {
        $formData = $request->validate([
            'id' => ['required', 'numeric', 'exists:sizes,id']
        ]);
        
        $size = Size::findOrFail($formData['id']); //nadji red sa tim id-em
        
        //obrisi red iz baze preko objekta
        $size->delete();
        
        //ODRZAVANJE RELACIJA
        //Imamo preneseni kljuc size_id u tabeli product_sizes
        \DB::table('product_sizes')
                ->where('size_id', '=', $size->id)
                ->delete();
        //brisanje redova pomovu QueryBuilder-a
        //Size::query()->where('id', $formData['id']->delete());
        //Size::query()->where('created_at', '<', date('Y-m-d H:i:s', strtotime('-1 year')))->delete();
    
        session()->flash('system_message', __('Size has been deleted!'));
        return redirect()->route('admin.sizes.index');
    }
}
