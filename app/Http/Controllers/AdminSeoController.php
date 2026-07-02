<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Post;

class AdminSeoController extends Controller
{
    public function index()
    {
        return view('admin.seo.index');
    }

    public function indexUrls(Request $request)
    {
        $request->validate([
            'manual_urls.*' => 'nullable|url'
        ]);

        $keyFilePath = public_path('google-indexing-api.json');
        
        if (!file_exists($keyFilePath)) {
            return back()->with('error', 'Không tìm thấy tệp khóa Google API (google-indexing-api.json) trong thư mục public.');
        }

        try {
            $client = new \Google\Client();
            $client->setAuthConfig($keyFilePath);
            $client->addScope('https://www.googleapis.com/auth/indexing');
            $client->setUseBatch(true);

            $service = new \Google\Service\Indexing($client);
            $batch = $service->createBatch();

            $urlsToSubmit = [];

            // 1. Static Pages (Home & Categories)
            if ($request->has('index_static')) {
                $urlsToSubmit[] = url('/');
                $urlsToSubmit[] = url('/products');
                $urlsToSubmit[] = url('/posts');
            }

            // 2. All Products
            if ($request->has('index_products')) {
                $products = Product::all();
                foreach ($products as $product) {
                    if ($product->slug) {
                        $urlsToSubmit[] = url('/product/' . $product->slug);
                    }
                }
            }

            // 3. All Posts
            if ($request->has('index_posts')) {
                $posts = Post::all();
                foreach ($posts as $post) {
                    if ($post->slug) {
                        $urlsToSubmit[] = url('/post/' . $post->slug);
                    }
                }
            }

            // 4. Manual Custom URLs
            if ($request->has('manual_urls') && is_array($request->manual_urls)) {
                foreach ($request->manual_urls as $manualUrl) {
                    if (!empty($manualUrl) && filter_var($manualUrl, FILTER_VALIDATE_URL)) {
                        $urlsToSubmit[] = $manualUrl;
                    }
                }
            }

            // Deduplicate URLs
            $urlsToSubmit = array_unique($urlsToSubmit);

            if (count($urlsToSubmit) === 0) {
                return back()->with('error', 'Không có đường link hợp lệ nào được chọn để gửi.');
            }

            $urlCount = 0;
            foreach ($urlsToSubmit as $url) {
                $urlNotification = new \Google\Service\Indexing\UrlNotification();
                $urlNotification->setUrl($url);
                $urlNotification->setType('URL_UPDATED');
                
                $req = $service->urlNotifications->publish($urlNotification);
                $batch->add($req);
                $urlCount++;
                
                if ($urlCount % 100 == 0) {
                    $batch->execute();
                    $batch = $service->createBatch();
                }
            }

            if ($urlCount % 100 != 0) {
                $batch->execute();
            }

            return back()->with('success', "Đã gửi thành công {$urlCount} đường link đến Google Indexing API!");
            
        } catch (\Exception $e) {
            return back()->with('error', 'Lỗi API Google: ' . $e->getMessage());
        }
    }
}
