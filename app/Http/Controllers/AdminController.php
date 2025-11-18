<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;

class AdminController extends Controller
{
public function index()
    {
        $products = Product::latest()->paginate(10);
        return view('admin.dashboard', compact('products'));
    }

    public function create()
    {
        return view('admin.create');
    }

        public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'code' => 'required|unique:products',
            'price' => 'required',
            'stock' => 'required',
        ]);

        Product::create([
            'name' => $request->name,
            'code' => $request->code,
            'price' => $request->price,
            'stock' => $request->stock,
        ]);

        return redirect()->route('admin.dashboard')
            ->with('success','Product created successfully.');
    }

        public function show(Product $product)
    {
        return view('admin.show',compact('product'));
    }

       public function edit(Product $product)
    {
        return view('admin.edit',compact('product'));
    }

        public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'stock' => 'required',
        ]);
        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
        ]);

        return redirect()->route('admin.dashboard')
            ->with('success','Product updated successfully');
    }

        public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.dashboard')
            ->with('success','Product deleted successfully');
    }

}
