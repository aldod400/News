<?php

namespace App\Http\Controllers;

use App\Models\RobotsTxt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Requests\RobotsTxtRequest;

class RobotsTxtController extends Controller
{
    /**
     * Display robots.txt management page
     */
    public function index()
    {
        $robotsTxts = RobotsTxt::orderBy('created_at', 'desc')->get();
        $activeRobotsTxt = RobotsTxt::where('is_active', true)->first();
        
        return view('admin.robots-txt.index', compact('robotsTxts', 'activeRobotsTxt'));
    }

    /**
     * Store a new robots.txt
     */
    public function store(RobotsTxtRequest $request)
    {
        $robotsTxt = RobotsTxt::create([
            'content' => $request->content,
            'is_active' => false
        ]);

        return redirect()->route('admin.robots-txt.index')
            ->with('success', 'تم إنشاء robots.txt جديد بنجاح');
    }

    /**
     * Update an existing robots.txt
     */
    public function update(RobotsTxtRequest $request, RobotsTxt $robotsTxt)
    {
        $robotsTxt->update([
            'content' => $request->content
        ]);

        // Update the physical robots.txt file if this is the active one
        if ($robotsTxt->is_active) {
            $this->updatePhysicalFile($robotsTxt->content);
        }

        return redirect()->route('admin.robots-txt.index')
            ->with('success', 'تم تحديث robots.txt بنجاح');
    }

    /**
     * Set a robots.txt as active
     */
    public function setActive(RobotsTxt $robotsTxt)
    {
        $robotsTxt->setAsActive();
        
        // Update the physical robots.txt file
        $this->updatePhysicalFile($robotsTxt->content);

        return redirect()->route('admin.robots-txt.index')
            ->with('success', 'تم تفعيل robots.txt بنجاح');
    }

    /**
     * Delete a robots.txt
     */
    public function destroy(RobotsTxt $robotsTxt)
    {
        if ($robotsTxt->is_active) {
            return redirect()->route('admin.robots-txt.index')
                ->with('error', 'لا يمكن حذف robots.txt النشط');
        }

        $robotsTxt->delete();

        return redirect()->route('admin.robots-txt.index')
            ->with('success', 'تم حذف robots.txt بنجاح');
    }

    /**
     * Serve robots.txt content
     */
    public function serve()
    {
        $content = RobotsTxt::getActiveContent();
        
        return response($content)
            ->header('Content-Type', 'text/plain');
    }

    /**
     * Update the physical robots.txt file
     */
    private function updatePhysicalFile($content)
    {
        // Add sitemap URL to robots.txt if not present
        $sitemapUrl = get_sitemap_url();
        
        if (strpos($content, 'Sitemap:') === false) {
            $content .= "\n\n# Sitemap\nSitemap: " . $sitemapUrl;
        } else {
            // Update existing sitemap URL
            $content = preg_replace(
                '/Sitemap:\s*https?:\/\/[^\s]+/i',
                'Sitemap: ' . $sitemapUrl,
                $content
            );
        }
        
        $robotsPath = public_path('robots.txt');
        File::put($robotsPath, $content);
    }
}
