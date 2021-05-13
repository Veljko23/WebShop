<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Size;
use Illuminate\Validation\Rule;

class ProductsController extends Controller {

    public function index(Request $request) {
        //$systemMessage = session()->pull('system_message');




        return view('admin.products.index', [
                //'products' => $products,
                //'systemMessage' => $systemMessage
        ]);
    }

    public function datatable(Request $request) {
        $searchFilters = $request->validate([
            'name' => ['nullable', 'string', 'max:255'],
            'brand_id' => ['nullable', 'numeric', 'exists:brands,id'],
            'product_category_id' => ['nullable', 'numeric', 'exists:product_categories,id'],
            'index_page' => ['nullable', 'in:0,1'],
            'size_ids' => ['nullable', 'array', 'exists:sizes,id'],
        ]);

        $query = Product::query()
                ->with(['brand', 'productCategory', 'sizes'])
                ->join('brands', 'products.brand_id', '=', 'brands.id')
                ->join('product_categories', 'products.product_category_id', '=', 'product_categories.id')
                ->select(['products.*', 'brands.name AS brand_name', 'product_categories.name AS product_category_name']);


//        if (isset($searchFilters['name'])) {
//            $query->where('products.name', 'LIKE', '%' . $searchFilters['name'] . '%');
//        }
//        if (isset($searchFilters['brand_id'])) {
//            $query->where('products.brand_id', '=', $searchFilters['brand_id']);
//        }
//
//        if (isset($searchFilters['product_category_id'])) {
//            $query->where('products.product_category_id', '=', $searchFilters['product_category_id']);
//        }
//
//        if (isset($searchFilters['index_page'])) {
//            $query->where('products.index_page', '=', $searchFilters['index_page']);
//        }
//
//        if (isset($searchFilters['size_ids'])) {
//            $query->whereHas('sizes', function($subQuery) use($searchFilters) {
//                $subQuery->whereIn('size_id', $searchFilters['size_ids']);
//            });
//        }


        $dataTable = \DataTables::of($query);

        $dataTable->addColumn('sizes', function($product) {
                    return $product->sizes->pluck('name')->join(', ');
                })
                ->editColumn('id', function($product) {
                    return '#' . $product->id;
                })
                ->editColumn('photo1', function($product) {
                    return view('admin.products.partials.product_photo', ['product' => $product]);
                })
//                ->addColumn('brand_name', function($products){
//                    return optional($products->brand)->name;
//                })
//                ->addColumn('product_category_name', function($product){
//                    return optional($product->productCategory)->name;
//                })
                ->editColumn('name', function($product) {
                    return '<strong>' . e($product->name) . '</strong>';
                })
                ->addColumn('actions', function($product) {
                    return view('admin.products.partials.actions', ['product' => $product]);
                })
                ->editColumn('created_at', function($product) {
                    return $product->created_at;
                });

        $dataTable->rawColumns(['name', 'photo1', 'actions']);

        $dataTable->filter(function($query) use ($request, $searchFilters) {
            if (
                    $request->has('search') && is_array($request->get('search')) && isset($request->get('search')['value'])
            ) {
                $searchTerm = $request->get('search')['value'];

                $query->where(function($query) use($searchTerm) {

                    $query->orWhere('products.name', 'LIKE', '%' . $searchTerm . '%')
                            ->orWhere('products.description', 'LIKE', '%' . $searchTerm . '%')
                            ->orWhere('brands.name', 'LIKE', '%' . $searchTerm . '%')
                            ->orWhere('product_categories.name', 'LIKE', '%' . $searchTerm . '%')
                            ->orWhere('products.id', '=', $searchTerm);
                });
            }

            if (isset($searchFilters['name'])) {
                $query->where('products.name', 'LIKE', '%' . $searchFilters['name'] . '%');
            }
            if (isset($searchFilters['brand_id'])) {
                $query->where('products.brand_id', '=', $searchFilters['brand_id']);
            }

            if (isset($searchFilters['product_category_id'])) {
                $query->where('products.product_category_id', '=', $searchFilters['product_category_id']);
            }

            if (isset($searchFilters['index_page'])) {
                $query->where('products.index_page', '=', $searchFilters['index_page']);
            }

            if (isset($searchFilters['size_ids'])) {
                $query->whereHas('sizes', function($subQuery) use($searchFilters) {
                    $subQuery->whereIn('size_id', $searchFilters['size_ids']);
                });
            }
        });

        return $dataTable->make(true);
    }

    public function add(Request $request) {

        $productCategories = ProductCategory::query()
                ->orderBy('priority')
                ->get();

        $sizes = Size::all();

        return view('admin.products.add', [
            'productCategories' => $productCategories,
            'sizes' => $sizes
        ]);
    }

    public function insert(Request $request) {
        $formData = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:products,name'],
            'brand_id' => ['required', 'numeric', 'exists:brands,id'],
            'product_category_id' => ['required', 'numeric', 'exists:product_categories,id'],
            'description' => ['nullable', 'string', 'max:2000'],
            'price' => ['required', 'numeric', 'min:0.01'],
            'old_price' => ['nullable',
                'numeric',
                'min:0.01',
                function ($attribute, $value, $fail) use($request) { //koristi spoljnu varijablu $request u anonimnoj funkciji
                    if ($value <= $request->input('price')) {
                        $fail(__('Old price must be greater than price'));
                    }
                },
            ],
            'index_page' => ['required', 'numeric', 'in:0,1'],
            'size_id' => ['required', 'array', 'exists:sizes,id', 'min:2'], //niz i te vrednosti moraju postojati u tabeli sizes u koloni id
            'photo1' => ['nullable', 'file', 'image'],
            'photo2' => ['nullable', 'file', 'image'],
            'details' => ['nullable', 'string']
        ]);


        //novi model u memoriji, jos nije sacuvan u bazi
        $newProduct = new Product();
        //setovanje kolone, setuj name kao sto je u formData
        //PRVI NACIN CUVANJA - JEDNA PO JEDNA KOLONA
        // $newProduct->name = $formData['name'];
        //DRUGI NACIN - MASS ASINGMENT - VISE KOLONA ODJEDNOM
        $newProduct->fill($formData);
        //dd($newProduct);
        //objekat pre snimanja u bazu
        //dump($newProduct);
        //cuva promene nad redom u bazi
        $newProduct->save();
        //objekat posle snimanja u bazu
        //dd($newProduct);
        //sync metoda nad relacijom sluzi za odrzavanje vece vise na vise!!!!!!!
        $newProduct->sizes()->sync($formData['size_id']);

        $this->handlePhotoUpload('photo1', $request, $newProduct);
        $this->handlePhotoUpload('photo2', $request, $newProduct);

        session()->flash('system_message', __('New product has been saved!'));

        return redirect()->route('admin.products.index');
    }

    public function edit(Request $request, Product $product) {

        $productCategories = ProductCategory::query()
                ->orderBy('priority')
                ->get();

        $sizes = Size::all();

        return view('admin.products.edit', [
            'product' => $product,
            'productCategories' => $productCategories,
            'sizes' => $sizes
        ]);
    }

    public function update(Request $request, Product $product) {
        //$formData = $request->validate([
        //  'name' => ['required', 'string', 'max:10', Rule::unique('products')->ignore($product->id)]
        //]);

        $formData = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('products')->ignore($product->id)],
            'brand_id' => ['required', 'numeric', 'exists:brands,id'],
            'product_category_id' => ['required', 'numeric', 'exists:product_categories,id'],
            'description' => ['nullable', 'string', 'max:2000'],
            'price' => ['required', 'numeric', 'min:0.01'],
            'old_price' => ['nullable',
                'numeric',
                'min:0.01',
                function ($attribute, $value, $fail) use($request) { //koristi spoljnu varijablu $request u anonimnoj funkciji
                    if ($value <= $request->input('price')) {
                        $fail(__('Old price must be greater than price'));
                    }
                },
            ],
            'index_page' => ['required', 'numeric', 'in:0,1'],
            'size_id' => ['required', 'array', 'exists:sizes,id', 'min:2'], //niz i te vrednosti moraju postojati u tabeli sizes u koloni id
            'photo1' => ['nullable', 'file', 'image'],
            'photo2' => ['nullable', 'file', 'image'],
            'details' => ['nullable', 'string']
        ]);

        $product->fill($formData);

        $product->save();

        $product->sizes()->sync($formData['size_id']); //sync ce da poveze sve vezano za sizes, odrzavanje veze vise na vise

        $this->handlePhotoUpload('photo1', $request, $product);
        $this->handlePhotoUpload('photo2', $request, $product);

        session()->flash('system_message', __('Product has been updated!'));

        return redirect()->route('admin.products.index');
    }

    public function delete(Request $request) {
        $formData = $request->validate([
            'id' => ['required', 'numeric', 'exists:products,id']
        ]);

        $product = Product::findOrFail($formData['id']); //nadji red sa tim id-em
        //obrisi red iz baze preko objekta
        $product->delete();

        //ODRZAVANJE RELACIJA
        //Imamo preneseni kljuc product_id u tabeli product_sizes
        \DB::table('product_sizes')
                ->where('product_id', '=', $product->id)
                ->delete();

        //$product->sizes()->delete(); //DVE VARIJANTE ZA BRISANJE IZ PIVOT TABELE
        //$product->sizes()->sync([]); //sa sync([]) znaci nema vise povezanih velicina i brisi
        //
        //brisanje redova pomovu QueryBuilder-a
        //Product::query()->where('id', $formData['id']->delete());
        //Product::query()->where('created_at', '<', date('Y-m-d H:i:s', strtotime('-1 year')))->delete();
        //brisanje svih povezanih fajlova (slike)
        $product->deletePhotos();

//        if($request->wantsJson()){
//            return response()->json([
//                'system_message' => __('Product has been deleted')
//            ]);
//        }
        //session()->flash('system_message', __('Product has been deleted!'));
        //return redirect()->route('admin.products.index');

        return response()->json([
                    'system_message' => __('Product has been deleted')
        ]);
    }

    public function deletePhoto(Request $request, Product $product) {
        $formData = $request->validate([
            'photo' => ['required', 'string', 'in:photo1,photo2'],
        ]);

        $photoFieldName = $formData['photo'];

        $product->deletePhoto($photoFieldName);
        //reset kolone photo1 i photo2 na null da se izbrise podatak u bazi o povezanoj fotografiji
        $product->$photoFieldName = null;
        $product->save();

        return response()->json([
                    'system_message' => __('Photo has been deleted'),
                    'photo_url' => $product->getPhotoUrl($photoFieldName)
        ]);
    }

    protected function handlePhotoUpload(string $photoFieldName, Request $request, Product $product) {
        if ($request->hasFile($photoFieldName)) {

            $product->deletePhoto($photoFieldName);

            $photoFile = $request->file($photoFieldName);

            $newPhotoFileName = $product->id . '_' . $photoFieldName . '_' . $photoFile->getClientOriginalName();

            $photoFile->move(public_path('/storage/products/'), $newPhotoFileName);

            $product->$photoFieldName = $newPhotoFileName;

            $product->save();

            \Image::make(public_path('/storage/products/' . $product->$photoFieldName))
                    ->fit(600, 800)
                    ->save();

            \Image::make(public_path('/storage/products/' . $product->$photoFieldName))
                    ->fit(300, 300)
                    ->save(public_path('/storage/products/thumbs/' . $product->$photoFieldName));
        }
    }

}
