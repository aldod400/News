<?php

namespace App\Console\Commands;

use App\Models\RobotsTxt;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class UpdateRobotsTxt extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'robots:update {--force : Force update even if file exists}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the physical robots.txt file with the active database content';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $robotsPath = public_path('robots.txt');
        
        // Check if robots.txt exists and --force is not used
        if (File::exists($robotsPath) && !$this->option('force')) {
            $this->warn('robots.txt file already exists. Use --force to overwrite.');
            return 1;
        }

        // Get active robots.txt content from database
        $activeRobotsTxt = RobotsTxt::where('is_active', true)->first();
        
        if (!$activeRobotsTxt) {
            $this->error('No active robots.txt found in database.');
            return 1;
        }

        // Write content to file
        try {
            File::put($robotsPath, $activeRobotsTxt->content);
            $this->info('robots.txt file updated successfully.');
            $this->line('Path: ' . $robotsPath);
            $this->line('Content length: ' . strlen($activeRobotsTxt->content) . ' characters');
        } catch (\Exception $e) {
            $this->error('Failed to update robots.txt file: ' . $e->getMessage());
            return 1;
        }

        return 0;
    }
}
