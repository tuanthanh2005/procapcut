<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use App\Models\Post;

class GoogleIndexUrls extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seo:index-urls';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Submit all product and post URLs to Google Indexing API';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting Google Indexing API Submission...');

        $keyFilePath = public_path('google-indexing-api.json');
        
        if (!file_exists($keyFilePath)) {
            $this->error("Google Service Account JSON key not found at: {$keyFilePath}");
            return Command::FAILURE;
        }

        try {
            $client = new \Google\Client();
            $client->setAuthConfig($keyFilePath);
            $client->addScope('https://www.googleapis.com/auth/indexing');
            $client->setUseBatch(true);

            $service = new \Google\Service\Indexing($client);
            $batch = $service->createBatch();

            $urlsToSubmit = [];
            
            // Add static pages
            $urlsToSubmit[] = url('/');
            $urlsToSubmit[] = url('/products');
            $urlsToSubmit[] = url('/posts');

            // Add dynamic products
            $products = Product::all();
            foreach ($products as $product) {
                if ($product->slug) {
                    $urlsToSubmit[] = url('/product/' . $product->slug);
                }
            }

            // Add dynamic posts
            $posts = Post::all();
            foreach ($posts as $post) {
                if ($post->slug) {
                    $urlsToSubmit[] = url('/post/' . $post->slug);
                }
            }

            $this->info('Found ' . count($urlsToSubmit) . ' URLs to submit.');
            
            $urlCount = 0;
            foreach ($urlsToSubmit as $url) {
                $urlNotification = new \Google\Service\Indexing\UrlNotification();
                $urlNotification->setUrl($url);
                $urlNotification->setType('URL_UPDATED');
                
                $request = $service->urlNotifications->publish($urlNotification);
                $batch->add($request);
                $urlCount++;
                
                // Google Indexing API limits batch sizes to 100
                if ($urlCount % 100 == 0) {
                    $results = $batch->execute();
                    $this->info("Submitted batch of 100 URLs...");
                    $batch = $service->createBatch();
                }
            }

            // Execute remaining
            if ($urlCount % 100 != 0) {
                $results = $batch->execute();
                $this->info("Submitted final batch.");
            }

            $this->info("Successfully pushed {$urlCount} URLs to Google Indexing API!");
            return Command::SUCCESS;
            
        } catch (\Exception $e) {
            $this->error("Failed to submit to Google Indexing API: " . $e->getMessage());
            return Command::FAILURE;
        }
    }
}
