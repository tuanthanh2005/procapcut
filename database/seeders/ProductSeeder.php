<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Truncate existing data to prevent duplicates
        Product::truncate();

        Product::create([
            'slug' => 'capcut',
            'name' => 'Tài Khoản CapCut Pro Gói Chính Chủ',
            'category' => 'capcut',
            'category_label' => 'Video Editor',
            'icon' => 'fa-video color-capcut',
            'rating' => 4.9,
            'review_count' => 142,
            'sold' => '2.4k',
            'tag' => '-58%',
            'description' => '<p><strong>CapCut Pro chính chủ</strong> là phần mềm biên tập video chuyên nghiệp đỉnh cao nhất hiện nay, được nâng cấp trực tiếp trên chính Email cá nhân của bạn. Không còn bị giới hạn bởi các mẫu cơ bản, CapCut Pro mở khóa kho tài nguyên khổng lồ giúp bạn tự do sáng tạo nội dung triệu view.</p>

<h4><i class="fa-solid fa-circle-check"></i> Tại sao nên chọn nâng cấp CapCut Pro tại CapcutStore?</h4>
<ul>
    <li><strong>Chính chủ 100%:</strong> Tài khoản nâng cấp dựa trên chính Email cá nhân của bạn, không dùng chung, an toàn tuyệt đối và bảo mật mọi dự án thiết kế.</li>
    <li><strong>Đa nền tảng:</strong> Sử dụng đồng bộ và mượt mà trên cả App Mobile (iOS, Android), App PC/Mac và cả phiên bản Web trực tuyến.</li>
    <li><strong>Không giới hạn tài nguyên:</strong> Truy cập không giới hạn hàng triệu hiệu ứng Pro, âm thanh độc quyền, nhãn dán, font chữ VIP và các bộ lọc màu chuẩn điện ảnh.</li>
    <li><strong>Tính năng AI thông minh:</strong> Sử dụng các công cụ tối tân như tự động xóa vật thể thừa, phụ đề tự động chính xác, dịch thuật video, và nâng cấp chất lượng hình ảnh AI.</li>
</ul>

<h4><i class="fa-solid fa-scale-balanced"></i> Bảng so sánh tính năng CapCut Free và CapCut Pro</h4>
<table class="desc-table">
    <thead>
        <tr>
            <th>Tính năng</th>
            <th>CapCut Bản Thường (Free)</th>
            <th>CapCut Bản Pro (Tại Cửa Hàng)</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><strong>Hiệu ứng & Chuyển cảnh</strong></td>
            <td>Chỉ dùng được các hiệu ứng cơ bản</td>
            <td>Mở khóa toàn bộ hiệu ứng VIP Pro đỉnh cao</td>
        </tr>
        <tr>
            <td><strong>Xuất Video (Render)</strong></td>
            <td>Bị giới hạn chất lượng, đôi khi dính watermark</td>
            <td>Xuất video lên tới 4K 60FPS sắc nét, không watermark</td>
        </tr>
        <tr>
            <td><strong>Dung lượng Lưu trữ Cloud</strong></td>
            <td>Chỉ có 512MB bộ nhớ tạm</td>
            <td>Tặng thêm 100GB dung lượng lưu trữ Cloud an toàn</td>
        </tr>
        <tr>
            <td><strong>Công cụ AI</strong></td>
            <td>Không sử dụng được hoặc giới hạn số lần</td>
            <td>Sử dụng không giới hạn Auto Caption, AI Beauty, Auto Reframe</td>
        </tr>
    </tbody>
</table>',
            'default_price' => 250000,
            'default_slashed' => 600000,
            'seo_title' => 'Mua Tài Khoản CapCut Pro Giá Rẻ 1 Năm Chính Chủ | CapcutStore',
            'seo_desc' => 'Nâng cấp tài khoản CapCut Pro 1 năm chính chủ giá rẻ nhất Việt Nam. Sử dụng song song cả máy tính và điện thoại, mở khóa mọi tính năng VIP, bảo hành trọn đời.',
            'seo_keywords' => 'mua tài khoản capcut pro, tài khoản capcut pro giá rẻ, nâng cấp capcut pro chính chủ, capcut vip',
            'features' => [
                'Mở khóa toàn bộ hiệu ứng, bộ lọc & nhãn dán Pro VIP',
                'Sử dụng các công cụ AI thông minh (Smart AI Cutout, Auto Caption Pro)',
                'Xuất video chất lượng cao 4K 60FPS không có watermark',
                'Không gian lưu trữ đám mây CapCut Cloud rộng lớn'
            ],
            'options' => [
                [
                    'id' => 'capcut-1m',
                    'name' => 'Gói 1 Tháng (Thử Nghiệm)',
                    'price' => 49000,
                    'slashed' => 120000,
                    'description' => 'Phù hợp cho nhu cầu làm video ngắn hạn, mở khóa mọi tính năng Pro trên Email chính chủ.'
                ],
                [
                    'id' => 'capcut-6m',
                    'name' => 'Gói 6 Tháng (Tiết Kiệm)',
                    'price' => 149000,
                    'slashed' => 350000,
                    'description' => 'Lựa chọn tiết kiệm cho Creator, nâng cấp chính chủ, bảo hành 1 đổi 1.'
                ],
                [
                    'id' => 'capcut-1y',
                    'name' => 'Gói 1 Năm (Khuyên Dùng)',
                    'price' => 250000,
                    'slashed' => 600000,
                    'description' => 'Gói tối ưu nhất, nâng cấp chính chủ email cá nhân. Dùng song song PC & Mobile.'
                ],
                [
                    'id' => 'capcut-life',
                    'name' => 'Gói Vĩnh Viễn (Trọn Đời)',
                    'price' => 490000,
                    'slashed' => 1200000,
                    'description' => 'Sở hữu vĩnh viễn không lo gia hạn hàng năm, bảo hành trọn đời dịch vụ.'
                ]
            ]
        ]);

        Product::create([
            'slug' => 'chatgpt',
            'name' => 'Tài Khoản ChatGPT Plus (GPT-4) Premium',
            'category' => 'gpt',
            'category_label' => 'AI Chatbot',
            'icon' => 'fa-brain color-gpt',
            'rating' => 4.8,
            'review_count' => 98,
            'sold' => '1.8k',
            'tag' => '-39%',
            'description' => '<p><strong>Tài Khoản ChatGPT Plus (GPT-4)</strong> là trợ lý AI thông minh nhất thế giới của OpenAI, giúp bạn tăng tốc hiệu suất công việc gấp 10 lần từ viết lách, học tập cho tới lập trình chuyên sâu.</p>

<h4><i class="fa-solid fa-circle-check"></i> Các đặc quyền vượt trội của ChatGPT Plus</h4>
<ul>
    <li><strong>Truy cập GPT-4 và GPT-4o:</strong> Phản hồi nhanh hơn, thông minh hơn và xử lý logic phức tạp tốt hơn phiên bản GPT-3.5 miễn phí.</li>
    <li><strong>Vẽ ảnh AI DALL-E 3:</strong> Tạo ra những bức ảnh nghệ thuật, minh họa cực kỳ sắc nét và đúng mô tả chỉ bằng vài câu lệnh tiếng Việt.</li>
    <li><strong>Custom GPTs Store:</strong> Khám phá và sử dụng hàng ngàn trợ lý chuyên dụng (viết content, dịch thuật, phân tích dữ liệu, viết code) được tối ưu hóa sẵn.</li>
    <li><strong>Advanced Voice Mode:</strong> Trò chuyện đàm thoại trực tiếp với AI bằng giọng nói tự nhiên, phản hồi cảm xúc siêu thực.</li>
</ul>',
            'default_price' => 299000,
            'default_slashed' => 490000,
            'seo_title' => 'Mua Tài Khoản ChatGPT Plus (GPT-4) Giá Rẻ Chính Chủ | CapcutStore',
            'seo_desc' => 'Nâng cấp tài khoản ChatGPT Plus chính chủ giá rẻ nhất. Truy cập GPT-4, DALL-E 3 tạo ảnh, tạo Custom GPTs riêng, bảo hành lỗi đổi mới trong 30 ngày.',
            'seo_keywords' => 'mua tài khoản chatgpt plus, tài khoản chatgpt plus giá rẻ, nâng cấp gpt 4, mua chatgpt plus uy tín',
            'features' => [
                'Truy cập GPT-4 mượt mà không bị giới hạn hàng đợi',
                'Tích hợp trình tạo ảnh nghệ thuật AI DALL-E 3 siêu đẹp',
                'Hỗ trợ chế độ Advanced Voice Mode (Trò chuyện giọng nói siêu thực)',
                'Tự do cài đặt và sử dụng hàng ngàn Custom GPTs trên Store'
            ],
            'options' => [
                [
                    'id' => 'chatgpt-1m',
                    'name' => 'Gói 1 Tháng (Ổn Định)',
                    'price' => 299000,
                    'slashed' => 490000,
                    'description' => 'Tài khoản dùng riêng tư đầy đủ tính năng Plus, bảo hành trọn vẹn 1 tháng.'
                ],
                [
                    'id' => 'chatgpt-3m',
                    'name' => 'Gói 3 Tháng (Tiện Lợi)',
                    'price' => 849000,
                    'slashed' => 1470000,
                    'description' => 'Gia hạn trực tiếp trên tài khoản cá nhân, tiết kiệm thời gian.'
                ]
            ]
        ]);

        Product::create([
            'slug' => 'gemini',
            'name' => 'Google Gemini Advanced + 5TB Google One',
            'category' => 'gemini',
            'category_label' => 'Google AI Suite',
            'icon' => 'fa-brands fa-google color-gemini',
            'rating' => 4.8,
            'review_count' => 60,
            'sold' => '1k',
            'tag' => '-43%',
            'description' => '<p><strong>Google Gemini Advanced</strong> là gói dịch vụ AI cao cấp nhất của Google, mang đến trải nghiệm mô hình AI thế hệ mới nhất cùng không gian lưu trữ đám mây khổng lồ 5TB Google One.</p>

<h4><i class="fa-solid fa-circle-check"></i> Lợi ích khi sở hữu Gemini Advanced + 5TB Google One</h4>
<ul>
    <li><strong>Mô hình Gemini 1.5 Pro:</strong> Xử lý dữ liệu lớn, phân tích tài liệu dài hàng ngàn trang một cách nhanh chóng và chính xác.</li>
    <li><strong>5TB Google One siêu khủng:</strong> Lưu trữ thoải mái ảnh chất lượng cao trên Google Photos, tệp tin trên Drive và Email mà không lo hết bộ nhớ.</li>
    <li><strong>Tích hợp Google Workspace:</strong> Sử dụng Gemini trực tiếp trong Docs (viết nháp), Gmail (soạn thư), Sheets (tạo bảng biểu) và Slides (thiết kế slide).</li>
</ul>',
            'default_price' => 199000,
            'default_slashed' => 350000,
            'seo_title' => 'Nâng Cấp Google Gemini Advanced + 5TB Google One Giá Rẻ | CapcutStore',
            'seo_desc' => 'Dịch vụ nâng cấp Google Gemini Advanced chính chủ trên Gmail. Tặng kèm dung lượng lưu trữ khổng lồ 5TB Google One siêu tiết kiệm, kích hoạt tự động 30s.',
            'seo_keywords' => 'nâng cấp gemini advanced, mua google gemini advanced, gemini advanced 5tb google one',
            'features' => [
                'Trải nghiệm mô hình AI mạnh mẽ nhất Gemini 1.5 Pro',
                'Tích hợp sâu AI vào các ứng dụng Google Docs, Sheets, Gmail',
                'Nhận dung lượng lưu trữ 5TB Google One tốc độ cao',
                'Được chia sẻ dung lượng bộ nhớ cho tối đa 5 thành viên gia đình'
            ],
            'options' => [
                [
                    'id' => 'gemini-1m',
                    'name' => 'Gói 1 Tháng (Kích Hoạt Gmail)',
                    'price' => 199000,
                    'slashed' => 350000,
                    'description' => 'Nâng cấp trực tiếp trên Gmail của bạn, có ngay 5TB dung lượng và Gemini Advanced.'
                ],
                [
                    'id' => 'gemini-6m',
                    'name' => 'Gói 6 Tháng (Siêu Tiết Kiệm)',
                    'price' => 990000,
                    'slashed' => 2100000,
                    'description' => 'Sử dụng liên tục trong 6 tháng, bảo hành uy tín chính chủ email.'
                ]
            ]
        ]);

        Product::create([
            'slug' => 'canva',
            'name' => 'Canva Pro Nâng Cấp Email Chính Chủ',
            'category' => 'canva',
            'category_label' => 'Graphic Design',
            'icon' => 'fa-paintbrush color-canva',
            'rating' => 4.9,
            'review_count' => 210,
            'sold' => '3.2k',
            'tag' => '-65%',
            'description' => '<p><strong>Canva Pro Nâng Cấp Chính Chủ</strong> giúp bạn trở thành nhà thiết kế chuyên nghiệp trong tích tắc. Mở khóa toàn bộ kho tài nguyên bản quyền khổng lồ của Canva trực tiếp trên tài khoản email cá nhân của bạn.</p>

<h4><i class="fa-solid fa-circle-check"></i> Khám phá kho tính năng Canva Pro VIP</h4>
<ul>
    <li><strong>Hơn 100 triệu tài nguyên:</strong> Thỏa sức sử dụng kho ảnh, video, nhạc, đồ họa và font chữ VIP không giới hạn.</li>
    <li><strong>Xóa nền thông minh:</strong> Tách nền hình ảnh hoặc video chỉ với 1 click chuột chuẩn xác tuyệt đối.</li>
    <li><strong>Magic Studio AI:</strong> Sử dụng các công cụ trí tuệ nhân tạo đột phá như Magic Expand, Magic Grab, Magic Write để tối ưu hóa thiết kế.</li>
    <li><strong>Bộ nhận diện thương hiệu (Brand Kit):</strong> Thiết lập logo, màu sắc, font chữ thương hiệu riêng để đồng bộ thiết kế nhanh chóng.</li>
</ul>',
            'default_price' => 99000,
            'default_slashed' => 290000,
            'seo_title' => 'Nâng Cấp Canva Pro Email Chính Chủ Giá Rẻ Nhất | CapcutStore',
            'seo_desc' => 'Nâng cấp Canva Pro chính chủ trên chính Email của bạn. Mở khóa toàn bộ tính năng Canva VIP, thiết kế không giới hạn, Magic Studio AI, bảo hành dài hạn.',
            'seo_keywords' => 'nâng cấp canva pro chính chủ, mua tài khoản canva pro giá rẻ, canva pro email chính chủ',
            'features' => [
                'Không giới hạn kho hơn 100 triệu ảnh, video, đồ họa cao cấp',
                'Xóa nền ảnh bằng một nút bấm (Background Remover) chuẩn xác',
                'Sử dụng công cụ đổi kích cỡ thiết kế thông minh (Magic Resize)',
                'Sở hữu toàn bộ tính năng AI thiết kế Magic Studio mới nhất'
            ],
            'options' => [
                [
                    'id' => 'canva-1m',
                    'name' => 'Gói 1 Tháng (Dùng Thử)',
                    'price' => 29000,
                    'slashed' => 90000,
                    'description' => 'Mở khóa toàn bộ tính năng Canva Pro trong 30 ngày trên email chính chủ.'
                ],
                [
                    'id' => 'canva-1y',
                    'name' => 'Gói 1 Năm (Giá Rẻ)',
                    'price' => 99000,
                    'slashed' => 290000,
                    'description' => 'Gia hạn chính chủ 1 năm, ổn định không lo mất thiết kế.'
                ],
                [
                    'id' => 'canva-life',
                    'name' => 'Gói Vĩnh Viễn (Trọn Đời)',
                    'price' => 199000,
                    'slashed' => 590000,
                    'description' => 'Sử dụng trọn đời, bảo hành vĩnh viễn suốt quá trình sử dụng.'
                ]
            ]
        ]);

        Product::create([
            'slug' => 'claude',
            'name' => 'Tài Khoản Claude Pro (Sonnet 3.5)',
            'category' => 'other',
            'category_label' => 'AI Assistant',
            'icon' => 'fa-microchip color-claude',
            'rating' => 4.8,
            'review_count' => 76,
            'sold' => '950',
            'tag' => '-33%',
            'description' => '<p><strong>Claude Pro (Sonnet 3.5)</strong> là trợ lý AI hàng đầu thế giới về khả năng lập trình (coding), phân tích thuật toán, viết bài học thuật sâu sắc và xử lý dữ liệu phức tạp.</p>

<h4><i class="fa-solid fa-circle-check"></i> Ư thế vượt trội của Claude Pro</h4>
<ul>
    <li><strong>Claude 3.5 Sonnet Đỉnh Cao:</strong> Khả năng viết code, debug lỗi phần mềm chuẩn xác vượt trội hơn hẳn các đối thủ cùng phân khúc.</li>
    <li><strong>Claude Projects:</strong> Gom nhóm nhiều file mã nguồn, tài liệu PDF lớn vào một dự án để AI hiểu sâu bối cảnh và trả lời chính xác nhất.</li>
    <li><strong>Giới hạn tin nhắn cao:</strong> Nhắn tin gấp 5 lần so với phiên bản miễn phí, không lo bị gián đoạn khi làm việc cường độ cao.</li>
</ul>',
            'default_price' => 349000,
            'default_slashed' => 520000,
            'seo_title' => 'Mua Tài Khoản Claude Pro (Sonnet 3.5) Giá Rẻ Uy Tín | CapcutStore',
            'seo_desc' => 'Nâng cấp tài khoản Claude Pro (Sonnet 3.5) giá rẻ, ổn định nhất. Đỉnh cao viết code và phân tích dữ liệu chuyên sâu, bảo hành lỗi 1 đổi 1 suốt chu kỳ.',
            'seo_keywords' => 'mua tài khoản claude pro, tài khoản claude sonnet 3.5, mua claude pro uy tín',
            'features' => [
                'Truy cập mô hình Claude 3.5 Sonnet đỉnh cao nhất',
                'Giới hạn tin nhắn cao gấp 5 lần so với tài khoản Free',
                'Tính năng Claude Projects giúp quản lý mã nguồn và tài liệu',
                'Hỗ trợ viết code, phân tích dữ liệu chuyên sâu tuyệt vời'
            ],
            'options' => [
                [
                    'id' => 'claude-1m',
                    'name' => 'Gói 1 Tháng Claude Pro',
                    'price' => 349000,
                    'slashed' => 520000,
                    'description' => 'Tài khoản Claude Pro 1 tháng sử dụng riêng tư, bảo hành đổi mới.'
                ]
            ]
        ]);

        Product::create([
            'slug' => 'office-365',
            'name' => 'Tài Khoản Microsoft Office 365 + 1TB OneDrive',
            'category' => 'other',
            'category_label' => 'Office Tools',
            'icon' => 'fa-briefcase color-office',
            'rating' => 4.9,
            'review_count' => 110,
            'sold' => '1.1k',
            'tag' => '-62%',
            'description' => '<p><strong>Tài Khoản Microsoft Office 365 bản quyền chính hãng</strong> đi kèm dung lượng lưu trữ 1TB OneDrive tốc độ cao, hỗ trợ cài đặt và sử dụng trọn bộ công cụ văn phòng trên mọi thiết bị.</p>

<h4><i class="fa-solid fa-circle-check"></i> Các tính năng nổi bật</h4>
<ul>
    <li><strong>Trọn bộ Office cao cấp:</strong> Sử dụng đầy đủ các ứng dụng Word, Excel, PowerPoint, Outlook bản quyền mới nhất.</li>
    <li><strong>1TB OneDrive:</strong> Đồng bộ dữ liệu tự động, sao lưu an toàn đám mây và chia sẻ tệp tin nhanh chóng.</li>
    <li><strong>Sử dụng 5 thiết bị:</strong> Cài đặt đồng thời trên tối đa 5 thiết bị song song (PC, Mac, Điện thoại, Máy tính bảng).</li>
</ul>',
            'default_price' => 149000,
            'default_slashed' => 399000,
            'seo_title' => 'Mua Tài Khoản Microsoft Office 365 Kèm 1TB OneDrive Giá Rẻ | CapcutStore',
            'seo_desc' => 'Mua tài khoản Microsoft Office 365 chính hãng giá rẻ. Cài đặt trên 5 thiết bị song song, tặng kèm 1TB đám mây OneDrive, bảo hành dài hạn.',
            'seo_keywords' => 'mua tài khoản office 365, office 365 giá rẻ, tài khoản office 365 plus, onedrive 1tb',
            'features' => [
                'Cài đặt đầy đủ Word, Excel, PowerPoint, Outlook, Access',
                'Sử dụng tối đa trên 5 thiết bị song song (PC, Mac, Tablet, Phone)',
                'Lưu trữ 1TB dữ liệu an toàn đám mây trên OneDrive',
                'Cập nhật phiên bản tính năng mới nhất từ Microsoft miễn phí'
            ],
            'options' => [
                [
                    'id' => 'office-365-1y',
                    'name' => 'Gói 1 Năm Office 365 + 1TB OneDrive',
                    'price' => 149000,
                    'slashed' => 399000,
                    'description' => 'Gói bản quyền Office 365 sử dụng 1 năm, dung lượng 1TB OneDrive tốc độ cao.'
                ]
            ]
        ]);
    }
}
