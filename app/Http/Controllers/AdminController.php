<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function view_category()
    {
        $category = Category::all();
        return view('admin.category', compact('category'));
    }
    public function add_category(Request $request)
    {
        $data = new Category;
        $data->category_name = $request->category;
        $data->save();
        toastr()
            ->timeOut(1000)
            ->addSuccess('Category Added Successfullly.');
        return redirect()->back();
    }
    public function delete_category($id)
    {
        $category = Category::find($id);
        $category->delete();
        toastr()->timeOut(1000)->addSuccess('Category Deleted Successfully');
        return redirect()->back();
    }
    public function edit_category($id)
    {
        $category = Category::find($id);
        return view('admin.edit_category', compact('category'));
    }
    public function update_category(Request $request, $id)
    {
        $category = Category::find($id);
        $category->category_name = $request->category;
        $category->save();
        toastr()->timeOut(1000)->addSuccess('Category Updated Successfully');
        return redirect('/view_category');
    }

    public function add_product()
    {
        $category = Category::all();

        return view('admin.add_product', compact('category'));
    }
    public function store_product(Request $request)
    {
        $data = new Product;
        $data->title = $request->title;
        $data->description = $request->description;
        $data->price = $request->price;
        $data->quantity = $request->quantity;
        $data->category = $request->category;
        $file = $request->image;
        $image_name = $file->getClientOriginalName();
        $file->move(public_path('product_images'), $image_name);
        $data->image = $image_name;
        $data->save();
        toastr()
            ->timeOut(1000)
            ->addSuccess('Product Added Successfullly.');
        return redirect('/view_product');
    }
    public function view_product()
    {

        $product = Product::paginate(3);
        return view('admin.view_product', compact('product'));
    }
    public function delete_product($id)
    {
        $data = Product::find($id);
        // $image_path = public_path('product_images' . $data->image);
        // if (Storage::disk('public')->exists($image_path)) {
        //     Storage::disk('public')->delete($image_path);
        // }
        $data->delete();
        toastr()->timeOut(1000)->addSuccess('Product Deleted Successfully');
        return redirect()->back();
    }
    public function edit_product($id)
    {
        $product = Product::find($id);
        $category = Category::all();

        return view('admin.edit_product', compact('product', 'category'));
    }
    public function update_product(Request $request, $id)
    {
        $data = Product::find($id);
        $data->title = $request->title;
        $data->description = $request->description;
        $data->price = $request->price;
        $data->category = $request->category;
        $data->quantity = $request->quantity;
        $file = $request->image;
        $image_name = $file->getClientOriginalName();
        $file->move(public_path('product_images'), $image_name);
        $data->image = $image_name;
        $data->save();
        toastr()
            ->timeOut(1000)
            ->addSuccess('Product Edited Successfullly.');
        return redirect('/view_product');
    }
    public function product_search(Request $request)
    {
        $searchProduct = $request->search;

        $product = Product::where('title', 'LIKE', '%' . $searchProduct . '%')->orWhere('category', 'LIKE', '%' . $searchProduct . '%')->paginate(3);

        return view('admin.view_product', compact('product'));
    }
    public function view_orders()
    {
        $order = Order::all();
        return view('admin.view_orders', compact('order'));
    }
    public function ontheway($id)
    {
        $data = Order::find($id);

        $data->status = 'on the way';
        $data->save();

        return redirect('/view_orders');
    }
    public function delivered($id)
    {
        $data = Order::find($id);

        $data->status = 'delivered';
        $data->save();

        return redirect('/view_orders');
    }
    public function print_pdf($id)
    {
        $order = Order::find($id);
        $pdf = Pdf::loadView('admin.invoice', compact('order'));

        return $pdf->download('invoice.pdf');
    }
}
