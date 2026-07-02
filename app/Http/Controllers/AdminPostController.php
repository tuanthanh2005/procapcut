<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;

class AdminPostController extends Controller
{
    // List all posts in admin panel
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    // Show create post form
    public function create()
    {
        return view('admin.posts.create');
    }

    // Store new post in database
    public function store(Request $request)
    {
        $data = $request->validate([
            'slug' => 'required|string|unique:posts,slug|max:255',
            'title' => 'required|string|max:255',
            'summary' => 'nullable|string',
            'content' => 'nullable|string',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:2048',
            'meta_title' => 'nullable|string|max:255',
            'meta_desc' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'is_published' => 'nullable|boolean',
        ], [
            'slug.unique' => 'Slug bài viết đã tồn tại.',
            'slug.required' => 'Đường dẫn slug là bắt buộc.',
            'title.required' => 'Tiêu đề bài viết không được để trống.',
        ]);

        // Handle is_published
        $data['is_published'] = $request->has('is_published') ? (bool)$request->is_published : true;

        // Handle Image Upload
        if ($request->hasFile('image_path')) {
            $file = $request->file('image_path');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/posts'), $filename);
            $data['image_path'] = 'uploads/posts/' . $filename;
        }

        Post::create($data);

        return redirect()->route('admin.posts.index')->with('success_message', 'Thêm bài viết mới thành công!');
    }

    // Generate blog post using Groq AI
    public function generateAI(Request $request)
    {
        $request->validate([
            'prompt' => 'required|string|max:1000',
            'model' => 'nullable|string|in:llama-3.3-70b-specdec,llama-3.1-8b-instant,mixtral-8x7b-32768',
        ]);

        $apiKey = \App\Models\Setting::getValue('groq_api_key', env('GROQ_API_KEY'));
        if (empty($apiKey)) {
            return response()->json([
                'success' => false,
                'message' => 'Vui lòng cấu hình Khóa API Groq trong mục Cài đặt hệ thống Admin.'
            ], 400);
        }

        $prompt = $request->input('prompt');
        $model = $request->input('model', 'llama-3.1-8b-instant');

        $systemPrompt = "Bạn là chuyên gia tối ưu hóa tìm kiếm SEO (SEO Specialist) kiêm Copywriter bán hàng chuyên nghiệp, có kinh nghiệm thực chiến trong việc viết bài viết bán hàng (Sales Copy) và seeding (redding) điều hướng khách hàng. Nhiệm vụ của bạn là viết một bài viết chuẩn SEO On-Page xuất sắc, có tính chuyển đổi bán hàng cực cao dựa trên chủ đề/yêu cầu của người dùng.\n\n" .
                        "HƯỚNG DẪN VIẾT BÀI CHUẨN SEO BÁN HÀNG & SEEDING (REDDING):\n" .
                        "1. PHONG CÁCH BÁN HÀNG & SEEDING (REDDING):\n" .
                        "   - Nội dung phải chuyên sâu về giới thiệu sản phẩm/dịch vụ, nêu bật các lợi ích, tính năng vượt trội, giải quyết triệt để nỗi đau (pain points) của khách hàng để thúc đẩy hành vi chốt đơn.\n" .
                        "   - Hãy áp dụng nghệ thuật seeding (redding) một cách khéo léo và tự nhiên trong bài viết: Lồng ghép các câu chuyện thành công của khách hàng trước đó, các feedback tích cực, các bình luận trải nghiệm thực tế (dưới dạng trích dẫn hoặc câu chuyện) để tạo lòng tin vững chắc cho độc giả.\n" .
                        "   - Sử dụng các từ ngữ kích thích chuyển đổi (Call to Action - CTA) mạnh mẽ xuyên suốt bài viết như: 'Sở hữu ngay', 'Nâng cấp nhanh chóng', 'Kích hoạt tự động', 'Tiết kiệm chi phí', 'Cam kết chính chủ', 'Liên hệ ngay'.\n" .
                        "2. TIÊU ĐỀ & SLUG:\n" .
                        "   - 'title': Tiêu đề chính thu hút khách hàng mục tiêu, kích thích ham muốn mua sắm, có chứa từ khóa chính (khoảng 55-65 ký tự).\n" .
                        "   - 'slug': Đường dẫn URL ngắn gọn, viết liền không dấu ngăn cách bằng dấu '-', chỉ chứa từ khóa chính.\n" .
                        "3. TÓM TẮT (SUMMARY):\n" .
                        "   - 'summary': Bản tóm tắt dài 150-200 ký tự lôi cuốn, tập trung vào ưu đãi hoặc lợi ích cốt lõi nhất của sản phẩm để thu hút người đọc click ngay.\n" .
                        "4. NỘI DUNG CHI TIẾT (CONTENT) - ĐỊNH DẠNG HTML:\n" .
                        "   - Độ dài từ 800 đến 1500 từ, định dạng bằng HTML sạch (KHÔNG dùng Markdown, KHÔNG bọc block code ```html hay ```json).\n" .
                        "   - Sử dụng các thẻ tiêu đề con <h2> (các phần lớn) và <h3> (các ý phụ của <h2>). Các thẻ này PHẢI chứa từ khóa hoặc lợi ích sản phẩm.\n" .
                        "   - Đưa từ khóa chính xuất hiện tự nhiên trong đoạn văn mở đầu và kết bài.\n" .
                        "   - Sử dụng thẻ <strong> cho các điểm nhấn bán hàng/ưu đãi đặc biệt, dùng thẻ <ul>/<li> hoặc <ol>/<li> cho hướng dẫn mua hàng/tính năng sản phẩm.\n" .
                        "   - Tạo các trích dẫn feedback khách hàng hoặc lưu ý quan trọng bằng thẻ <blockquote style=\"border-left: 4px solid #4f46e5; padding-left: 1rem; margin: 1.5rem 0; color: #475569;\">.\n" .
                        "5. QUY ĐỊNH VỀ CẤU TRÚC ĐƯỜNG DẪN (LINKS) - ĐỂ TRÁNH LỖI 404:\n" .
                        "   - BẮT BUỘC sử dụng các đường dẫn chính thức sau đây, TUYỆT ĐỐI không tự bịa hoặc viết sai URL:\n" .
                        "     + Đăng ký tài khoản mới: '/register'\n" .
                        "     + Đăng nhập tài khoản: '/login'\n" .
                        "     + Trang sản phẩm/Cửa hàng: '/products'\n" .
                        "     + Trang chủ: '/'\n" .
                        "     + Trang sản phẩm chi tiết: '/product/capcut' (cho CapCut Pro), '/product/chatgpt' (cho ChatGPT Plus), '/product/canva' (cho Canva Pro), '/product/gemini' (cho Google Gemini Advanced).\n" .
                        "     + Hỗ trợ qua Zalo Admin: 'https://zalo.me/0569012134'\n" .
                        "     + Hỗ trợ qua Telegram Admin: 'https://t.me/specademy'\n" .
                        "   - Khi tạo các nút kêu gọi hành động (như Đăng Ký, Liên hệ hỗ trợ), hãy dùng thẻ <a> bọc ngoài có gắn thuộc tính href chính xác ở trên và được trang trí bằng mã CSS inline để hiển thị thành một nút bấm đẹp mắt, ví dụ:\n" .
                        "     + Nút Đăng Ký: `<a href=\"/register\" style=\"display: inline-block; background: linear-gradient(135deg, #4f46e5, #0ea5e9); color: white; padding: 10px 22px; border-radius: 8px; text-decoration: none; font-weight: bold; margin: 10px 0; box-shadow: 0 4px 10px rgba(79, 70, 229, 0.2);\">Đăng Ký Tài Khoản Ngay</a>`\n" .
                        "     + Nút Liên Hệ Zalo: `<a href=\"https://zalo.me/0569012134\" target=\"_blank\" style=\"display: inline-block; background: #0068ff; color: white; padding: 10px 22px; border-radius: 8px; text-decoration: none; font-weight: bold; margin: 10px 0; margin-left: 10px; box-shadow: 0 4px 10px rgba(0, 104, 255, 0.2);\">Liên Hệ Qua Zalo</a>`\n" .
                        "     + Nút Liên Hệ Telegram: `<a href=\"https://t.me/specademy\" target=\"_blank\" style=\"display: inline-block; background: #229ED9; color: white; padding: 10px 22px; border-radius: 8px; text-decoration: none; font-weight: bold; margin: 10px 0; margin-left: 10px; box-shadow: 0 4px 10px rgba(34, 158, 217, 0.2);\">Liên Hệ Telegram</a>`\n" .
                        "   - TUYỆT ĐỐI KHÔNG sử dụng thẻ <button> thô không có link hoặc tự tạo ra các URL khác ngoài danh sách trên.\n" .
                        "6. TỐI ƯU CÁC THẺ META SEO:\n" .
                        "   - 'meta_title': Tiêu đề SEO hiển thị trên Google. Cần chứa từ khóa chính bán hàng đặt ở đầu câu, độ dài từ 50-60 ký tự.\n" .
                        "   - 'meta_desc': Mô tả SEO hiển thị trên Google. Giới thiệu ngắn gọn sản phẩm, cam kết dịch vụ/giá cả và kèm theo CTA mua hàng, dài 150-160 ký tự.\n" .
                        "   - 'meta_keywords': Danh sách các từ khóa mua bán liên quan chặt chẽ, cách nhau bằng dấu phẩy (từ 5-8 từ khóa, ví dụ: 'capcut pro, mua capcut pro gia re, cach nang cap capcut pro, ban tai khoan capcut pro').\n\n" .
                        "QUY TẮC PHẢN HỒI:\n" .
                        "- Bạn BẮT BUỘC phải phản hồi bằng một đối tượng JSON hợp lệ (không chứa bất cứ văn bản thừa nào bên ngoài JSON).\n" .
                        "- Tất cả nội dung viết bằng tiếng Việt tự nhiên, chuẩn chính tả, cuốn hút, mang đậm tính thuyết phục bán hàng.";

        $url = 'https://api.groq.com/openai/v1/chat/completions';
        
        try {
            $response = Http::withToken($apiKey)
                ->timeout(60)
                ->post($url, [
                    'model' => $model,
                    'messages' => [
                        ['role' => 'system', 'content' => $systemPrompt],
                        ['role' => 'user', 'content' => $prompt]
                    ],
                    'temperature' => 0.7,
                    'max_tokens' => 4000,
                    'response_format' => ['type' => 'json_object']
                ]);

            if ($response->failed() && $model !== 'llama-3.1-8b-instant') {
                // Fallback to llama-3.1-8b-instant if the chosen model fails
                $response = Http::withToken($apiKey)
                    ->timeout(60)
                    ->post($url, [
                        'model' => 'llama-3.1-8b-instant',
                        'messages' => [
                            ['role' => 'system', 'content' => $systemPrompt],
                            ['role' => 'user', 'content' => $prompt]
                        ],
                        'temperature' => 0.7,
                        'max_tokens' => 4000,
                        'response_format' => ['type' => 'json_object']
                    ]);
            }

            if ($response->failed()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Lỗi kết nối API Groq: ' . $response->status() . ' - ' . $response->reason()
                ], 500);
            }

            $data = $response->json();
            $contentStr = $data['choices'][0]['message']['content'] ?? null;

            // Log the raw response for diagnostics
            \Illuminate\Support\Facades\Log::info('AI Groq Response: ' . $contentStr);

            if (!$contentStr) {
                return response()->json([
                    'success' => false,
                    'message' => 'Không nhận được phản hồi từ AI.'
                ], 500);
            }

            $result = json_decode($contentStr, true);
            if (!$result) {
                return response()->json([
                    'success' => false,
                    'message' => 'AI trả về dữ liệu không phải là JSON hợp lệ.',
                    'raw' => $contentStr
                ], 500);
            }

            // Unnest if the response is wrapped under a single root key (e.g. "article" or "post")
            if (count($result) === 1 && is_array(reset($result))) {
                $result = reset($result);
            }

            // Normalize keys to prevent LLM key name variations from breaking form filling
            $normalizedData = [];
            
            // 1. Title
            $normalizedData['title'] = $result['title'] ?? $result['tieu_de'] ?? $result['post_title'] ?? $result['seo_title'] ?? '';
            
            // 2. Slug
            $normalizedData['slug'] = $result['slug'] ?? $result['duong_dan'] ?? $result['post_slug'] ?? '';
            
            // 3. Summary
            $normalizedData['summary'] = $result['summary'] ?? $result['tom_tat'] ?? $result['excerpt'] ?? $result['short_desc'] ?? '';
            
            // 4. Content
            $normalizedData['content'] = $result['content'] ?? $result['noi_dung'] ?? $result['body'] ?? $result['html_content'] ?? $result['content_html'] ?? $result['article'] ?? '';
            
            // 5. Meta Title
            $normalizedData['meta_title'] = $result['meta_title'] ?? $result['seo_title'] ?? $result['meta_title_seo'] ?? $result['title_seo'] ?? '';
            
            // 6. Meta Desc
            $normalizedData['meta_desc'] = $result['meta_desc'] ?? $result['meta_description'] ?? $result['seo_desc'] ?? $result['seo_description'] ?? $result['mo_ta_seo'] ?? '';
            
            // 7. Meta Keywords
            $normalizedData['meta_keywords'] = $result['meta_keywords'] ?? $result['keywords'] ?? $result['seo_keywords'] ?? $result['tu_khoa_seo'] ?? '';

            // Clean up any arrays or objects to strings
            foreach ($normalizedData as $key => $val) {
                if (is_array($val)) {
                    $normalizedData[$key] = json_encode($val, JSON_UNESCAPED_UNICODE);
                } else {
                    $normalizedData[$key] = trim((string)$val);
                }
            }

            // Fallback: If title is empty, we consider it invalid
            if (empty($normalizedData['title'])) {
                return response()->json([
                    'success' => false,
                    'message' => 'AI không tạo được tiêu đề bài viết hợp lệ.',
                    'raw' => $contentStr
                ], 500);
            }

            return response()->json([
                'success' => true,
                'data' => $normalizedData
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Đã xảy ra lỗi khi gọi AI: ' . $e->getMessage()
            ], 500);
        }
    }

    // Show edit post form
    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    // Update post in database
    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'slug' => 'required|string|unique:posts,slug,' . $post->id . '|max:255',
            'title' => 'required|string|max:255',
            'summary' => 'nullable|string',
            'content' => 'nullable|string',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:2048',
            'meta_title' => 'nullable|string|max:255',
            'meta_desc' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'is_published' => 'nullable|boolean',
        ], [
            'slug.unique' => 'Slug bài viết đã tồn tại.',
            'slug.required' => 'Đường dẫn slug là bắt buộc.',
            'title.required' => 'Tiêu đề bài viết không được để trống.',
        ]);

        // Handle is_published
        $data['is_published'] = $request->has('is_published') ? (bool)$request->is_published : false;

        // Handle Image Upload
        if ($request->hasFile('image_path')) {
            // Delete old image if exists
            if ($post->image_path && File::exists(public_path($post->image_path))) {
                File::delete(public_path($post->image_path));
            }

            $file = $request->file('image_path');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/posts'), $filename);
            $data['image_path'] = 'uploads/posts/' . $filename;
        }

        $post->update($data);

        return redirect()->route('admin.posts.index')->with('success_message', 'Cập nhật bài viết thành công!');
    }

    // Delete post
    public function destroy(Post $post)
    {
        // Delete image if exists
        if ($post->image_path && File::exists(public_path($post->image_path))) {
            File::delete(public_path($post->image_path));
        }

        $post->delete();

        return redirect()->route('admin.posts.index')->with('success_message', 'Xóa bài viết thành công!');
    }
}
