<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductCategory;

class ProductCategoriesController extends Controller {

    public function index(Request $request) {
        $productCategories = ProductCategory::query()
                ->orderBy('priority')
                ->get();

        return view('admin.product_categories.index', [
            'productCategories' => $productCategories
        ]);
    }

    public function add(Request $request) {
        return view('admin.product_categories.add', [
        ]);
    }

    public function insert(Request $request) {
        $formData = $request->validate([
            'name' => ['required', 'string', 'min:2', 'unique:product_categories,name'],
            'description' => ['nullable', 'string', 'min:10', 'max:255']
        ]);

        $newProductCategory = new ProductCategory();

        $newProductCategory->fill($formData);

        $productCategoryWithHighestPriority = ProductCategory::query()
                ->orderBy('priority', 'DESC')
                ->first();

        if ($productCategoryWithHighestPriority !== null) {
            //ako postoji kategorija u bazi, daj novoj prioritet za 1 veci
            $newProductCategory->priority = $productCategoryWithHighestPriority->priority + 1;
        } else {
            //dodajemo prvu kategoriju u tabeli, ranije nije bilo nijedne kategorije
            $newProductCategory->priority = 1;
        }


        $newProductCategory->save();

        session()->flash('system_message', __('New product category has been saved'));

        return redirect()->route('admin.product_categories.index');
    }

    public function edit(Request $request, ProductCategory $productCategory) {
        return view('admin.product_categories.edit', [
            'productCategory' => $productCategory
        ]);
    }

    public function update(Request $request, ProductCategory $productCategory) {
        
    }

    public function delete(Request $request) {
        $formData = $request->validate([
            'id' => ['required', 'numeric', 'exists:product_categories,id']
        ]);

        $productCategory = ProductCategory::findOrFail($formData['id']);

        $productCategory->delete();

        ProductCategory::query()
                ->where('priority', '>', $productCategory->priority)
                ->decrement('priority')
//                ->update([
//                    'priority' => \DB::raw('priority - 1')
//                ])
        ;

        session()->flash('system_message', __('Product Category has been deleted'));

        return redirect()->route('admin.product_categories.index');
    }

    public function changePriorities(Request $request) {
        $formData = $request->validate([
            'priorities' => ['required', 'string']
        ]);

        $priorities = explode(',', $formData['priorities']);

        // vrednosti u stringu su razdvojene zarezom i explode pretvara u niz
        //dd(explode(',', $formData['priorities']));

        foreach ($priorities as $key => $id) {
            $productCategory = ProductCategory::findOrFail($id);
            $productCategory->priority = $key + 1;

            $productCategory->save();
        }

        session()->flash('system_message', __('Product categories have been reordered!'));

        return redirect()->route('admin.product_categories.index');
    }

}
