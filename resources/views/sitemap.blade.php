{!! '<?xml version="1.0" encoding="UTF-8"?>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
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
        </url>
    @endforeach

    <!-- Bài viết chi tiết -->
    @foreach ($posts as $post)
        <url>
            <loc>{{ url('/post/' . $post->slug) }}</loc>
            <lastmod>{{ $post->updated_at ? $post->updated_at->toAtomString() : now()->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.7</priority>
        </url>
    @endforeach
</urlset>
