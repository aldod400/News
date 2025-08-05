<?php

if (!function_exists('get_active_robots_txt')) {
    /**
     * Get the active robots.txt content
     */
    function get_active_robots_txt(): ?string
    {
        return \App\Models\RobotsTxt::getActiveContent();
    }
}

if (!function_exists('format_robots_txt_preview')) {
    /**
     * Format robots.txt content for preview
     */
    function format_robots_txt_preview(string $content, int $maxLength = 100): string
    {
        $lines = explode("\n", $content);
        $preview = '';
        $length = 0;
        
        foreach ($lines as $line) {
            if ($length + strlen($line) > $maxLength) {
                $preview .= '...';
                break;
            }
            $preview .= $line . "\n";
            $length += strlen($line);
        }
        
        return trim($preview);
    }
}

if (!function_exists('validate_robots_txt')) {
    /**
     * Validate robots.txt content
     */
    function validate_robots_txt(string $content): array
    {
        $errors = [];
        $warnings = [];
        
        // Check for User-agent
        if (!preg_match('/User-agent\s*:\s*.+/i', $content)) {
            $errors[] = 'يجب وجود User-agent على الأقل';
        }
        
        // Check for at least one directive
        if (!preg_match('/(Disallow|Allow|Crawl-delay|Sitemap)\s*:\s*.*/i', $content)) {
            $warnings[] = 'يُنصح بوجود توجيه واحد على الأقل (Disallow, Allow, Crawl-delay, Sitemap)';
        }
        
        // Check for trailing spaces
        $lines = explode("\n", $content);
        foreach ($lines as $index => $line) {
            if (preg_match('/\s+$/', $line)) {
                $warnings[] = "السطر " . ($index + 1) . " يحتوي على مسافات في النهاية";
                break; // Only show first occurrence
            }
        }
        
        return [
            'errors' => $errors,
            'warnings' => $warnings,
            'is_valid' => empty($errors)
        ];
    }
}

if (!function_exists('format_robots_txt_preview')) {
    /**
     * Format robots.txt content for preview
     *
     * @param string $content
     * @param int $maxLength
     * @return string
     */
    function format_robots_txt_preview($content, $maxLength = 200)
    {
        if (strlen($content) <= $maxLength) {
            return $content;
        }
        
        return substr($content, 0, $maxLength) . '...';
    }
}
