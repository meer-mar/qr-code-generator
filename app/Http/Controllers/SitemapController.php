<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use App\Models\BlogArticle;

class SitemapController extends Controller
{
    public function generate()
    {
        $baseUrl = url('/');
        $currentDate = Carbon::now()->toW3cString();
        $batchSize = 7000;

        // Initialize the sitemap index
        $sitemapIndexXml = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"></sitemapindex>');

        // Generate sitemaps for dynamic models
        // $this->generateDynamicSitemap(BlogArticle::class, 'blogshow', 'sitemap_blogs', $sitemapIndexXml, $batchSize, $baseUrl, $currentDate, 'daily', '0.8');

        // Generate sitemap for static pages
        $this->generateStaticSitemap([
            '',
            '/aboutus',
            '/contactus',
        ], $baseUrl, $currentDate, 'monthly', '0.5');

        // Save the sitemap index
        $this->saveSitemapIndex($sitemapIndexXml);

        return redirect()->back()->with('success', 'Sitemap generated successfully!');
    }

    private function generateDynamicSitemap($model, $route, $filenamePrefix, $sitemapIndexXml, $batchSize, $baseUrl, $currentDate, $changefreq, $priority)
    {
        $totalItems = $model::count();
        $currentBatch = 0;

        while ($currentBatch * $batchSize < $totalItems) {
            $sitemapXml = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"></urlset>');

            $items = $model::select('slug')
                ->offset($currentBatch * $batchSize)
                ->limit($batchSize)
                ->get();

            foreach ($items as $item) {
                $url = $baseUrl . route($route, $item->slug, false);
                $this->addUrlToSitemap($sitemapXml, $url, $currentDate, $changefreq, $priority);
            }

            $this->saveSitemapFile($sitemapXml, "{$filenamePrefix}_{$currentBatch}.xml", $sitemapIndexXml, $currentDate);
            $currentBatch++;
        }
    }

    private function generateStaticSitemap(array $staticPages, $baseUrl, $currentDate, $changefreq, $priority)
    {
        $staticSitemapXml = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"></urlset>');

        foreach ($staticPages as $staticPage) {
            $url = $baseUrl . $staticPage;
            $this->addUrlToSitemap($staticSitemapXml, $url, $currentDate, $changefreq, $priority);
        }

        Storage::disk('local')->put('sitemap_static.xml', $staticSitemapXml->asXML());
        File::move(storage_path('app/sitemap_static.xml'), public_path('sitemap_static.xml'));
    }

    private function addUrlToSitemap($sitemapXml, $url, $lastmod, $changefreq, $priority)
    {
        $urlXml = $sitemapXml->addChild('url');
        $urlXml->addChild('loc', $url);
        $urlXml->addChild('lastmod', $lastmod);
        $urlXml->addChild('changefreq', $changefreq);
        $urlXml->addChild('priority', $priority);
    }

    private function saveSitemapFile($sitemapXml, $filename, $sitemapIndexXml, $lastmod)
    {
        Storage::disk('local')->put($filename, $sitemapXml->asXML());
        File::move(storage_path("app/{$filename}"), public_path($filename));

        $sitemapIndexEntry = $sitemapIndexXml->addChild('sitemap');
        $sitemapIndexEntry->addChild('loc', url($filename));
        $sitemapIndexEntry->addChild('lastmod', $lastmod);
    }

    private function saveSitemapIndex($sitemapIndexXml)
    {
        Storage::disk('local')->put('sitemap.xml', $sitemapIndexXml->asXML());
        File::move(storage_path('app/sitemap.xml'), public_path('sitemap.xml'));
    }
}
