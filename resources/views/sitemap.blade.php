{!! '<?xml version="1.0" encoding="UTF-8"?>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
    <!-- Trang chủ -->
    <url>
        <loc>{{ url('/') }}</loc>
        <lastmod>{{ now()->startOfDay()->toAtomString() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>
    <!-- Danh sách sản phẩm -->
    <url>
        <loc>{{ url('/products') }}</loc>
        <lastmod>{{ now()->startOfDay()->toAtomString() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.9</priority>
    </url>
    <!-- Trang Tin tức/Blog -->
    <url>
        <loc>{{ url('/posts') }}</loc>
        <lastmod>{{ now()->startOfDay()->toAtomString() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>

    <!-- Danh mục Sản phẩm chi tiết -->
    @foreach ($products as $product)
        <url>
            <loc>{{ url('/product/' . $product->slug) }}</loc>
            <lastmod>{{ $product->updated_at ? $product->updated_at->toAtomString() : now()->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.8</priority>
            @if($product->image_path)
                <image:image>
                    <image:loc>{{ asset($product->image_path) }}</image:loc>
                    <image:title>{{ htmlspecialchars(strip_tags($product->seo_title ?: $product->name), ENT_XML1, 'UTF-8') }}</image:title>
                    <image:caption>{{ htmlspecialchars(strip_tags($product->seo_desc ?: $product->description), ENT_XML1, 'UTF-8') }}</image:caption>
                </image:image>
            @endif
        </url>
    @endforeach

    <!-- Bài viết chi tiết -->
    @foreach ($posts as $post)
        <url>
            <loc>{{ url('/post/' . $post->slug) }}</loc>
            <lastmod>{{ $post->updated_at ? $post->updated_at->toAtomString() : now()->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.7</priority>
            @if($post->image_path)
                <image:image>
                    <image:loc>{{ asset($post->image_path) }}</image:loc>
                    <image:title>{{ htmlspecialchars(strip_tags($post->meta_title ?: $post->title), ENT_XML1, 'UTF-8') }}</image:title>
                    <image:caption>{{ htmlspecialchars(strip_tags($post->meta_desc ?: $post->summary), ENT_XML1, 'UTF-8') }}</image:caption>
                </image:image>
            @endif
        </url>
    @endforeach
</urlset>
