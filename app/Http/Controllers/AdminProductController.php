<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminProductController extends Controller
{
    // List all products in admin panel
    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    // Show create product form
    public function create()
    {
        // Provide a default options JSON template for ease of use
        $defaultOptionsJson = json_encode([
            [
                'id' => 'sample-1m',
                'name' => 'Gói 1 Tháng',
                'price' => 99000,
                'slashed' => 150000,
                'description' => 'Mô tả ngắn gọn đặc quyền của gói cước này.',
                'require_email' => false,
                'stock' => 0
            ]
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        return view('admin.products.create', compact('defaultOptionsJson'));
    }

    // Store new product in database
    public function store(Request $request)
    {
        $data = $request->validate([
            'slug' => 'required|string|unique:products,slug|max:255',
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'category_label' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:2048',
            'rating' => 'required|numeric|min:1|max:5',
            'review_count' => 'required|integer|min:0',
            'sold' => 'required|string|max:255',
            'description' => 'nullable|string',
            'default_price' => 'required|integer|min:0',
            'default_slashed' => 'required|integer|min:0',
            'seo_title' => 'nullable|string|max:255',
            'seo_desc' => 'nullable|string',
            'seo_keywords' => 'nullable|string',
            'features' => 'nullable|string',
            'options' => 'nullable|string', // JSON string
        ], [
            'slug.unique' => 'Slug sản phẩm đã tồn tại.',
            'name.required' => 'Tên sản phẩm không được để trống.',
        ]);

        // Process features (convert line-by-line to array)
        if ($request->filled('features')) {
            $featuresArr = array_filter(array_map('trim', explode("\n", str_replace("\r", "", $request->features))));
            $data['features'] = array_values($featuresArr);
        } else {
            $data['features'] = [];
        }

        // Process options JSON
        if ($request->filled('options')) {
            $optionsArr = json_decode($request->options, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                return back()->withErrors(['options' => 'Định dạng JSON cấu hình Gói cước không hợp lệ. Hãy kiểm tra dấu ngoặc, dấu phẩy.'])->withInput();
            }
            $data['options'] = $optionsArr;
        } else {
            $data['options'] = [];
        }

        // Handle Image Upload
        if ($request->hasFile('image_path')) {
            $file = $request->file('image_path');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/products'), $filename);
            $data['image_path'] = 'uploads/products/' . $filename;
        }

        // Auto calculate discount percentage tag
        if ($data['default_slashed'] > 0 && $data['default_slashed'] > $data['default_price']) {
            $discount = round((($data['default_slashed'] - $data['default_price']) / $data['default_slashed']) * 100);
            $data['tag'] = '-' . $discount . '%';
        } else {
            $data['tag'] = null;
        }

        Product::create($data);

        return redirect()->route('admin.products.index')->with('success_message', 'Thêm sản phẩm mới thành công!');
    }

    // Show edit product form
    public function edit(Product $product)
    {
        // Convert features array to string for textarea
        $featuresStr = is_array($product->features) ? implode("\n", $product->features) : '';

        // Format options array to formatted JSON string
        $optionsJson = json_encode($product->options, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        return view('admin.products.edit', compact('product', 'featuresStr', 'optionsJson'));
    }

    // Update product in database
    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'slug' => 'required|string|unique:products,slug,' . $product->id . '|max:255',
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'category_label' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:2048',
            'rating' => 'required|numeric|min:1|max:5',
            'review_count' => 'required|integer|min:0',
            'sold' => 'required|string|max:255',
            'description' => 'nullable|string',
            'default_price' => 'required|integer|min:0',
            'default_slashed' => 'required|integer|min:0',
            'seo_title' => 'nullable|string|max:255',
            'seo_desc' => 'nullable|string',
            'seo_keywords' => 'nullable|string',
            'features' => 'nullable|string',
            'options' => 'nullable|string',
        ], [
            'slug.unique' => 'Slug sản phẩm đã tồn tại.',
            'name.required' => 'Tên sản phẩm không được để trống.',
        ]);

        // Process features
        if ($request->filled('features')) {
            $featuresArr = array_filter(array_map('trim', explode("\n", str_replace("\r", "", $request->features))));
            $data['features'] = array_values($featuresArr);
        } else {
            $data['features'] = [];
        }

        // Process options
        if ($request->filled('options')) {
            $optionsArr = json_decode($request->options, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                return back()->withErrors(['options' => 'Định dạng JSON cấu hình Gói cước không hợp lệ. Hãy kiểm tra dấu ngoặc, dấu phẩy.'])->withInput();
            }
            $data['options'] = $optionsArr;
        } else {
            $data['options'] = [];
        }

        // Handle Image Upload
        if ($request->hasFile('image_path')) {
            // Delete old file if exists
            if ($product->image_path && file_exists(public_path($product->image_path))) {
                @unlink(public_path($product->image_path));
            }
            $file = $request->file('image_path');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/products'), $filename);
            $data['image_path'] = 'uploads/products/' . $filename;
        }

        // Auto calculate discount percentage tag
        if ($data['default_slashed'] > 0 && $data['default_slashed'] > $data['default_price']) {
            $discount = round((($data['default_slashed'] - $data['default_price']) / $data['default_slashed']) * 100);
            $data['tag'] = '-' . $discount . '%';
        } else {
            $data['tag'] = null;
        }

        $product->update($data);

        return redirect()->route('admin.products.index')->with('success_message', 'Cập nhật thông tin sản phẩm thành công!');
    }

    // Delete product from database
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success_message', 'Xóa sản phẩm thành công!');
    }
}
