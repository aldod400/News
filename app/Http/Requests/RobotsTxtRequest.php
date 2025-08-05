<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class RobotsTxtRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check() && Auth::user() && Auth::user()->hasRole('Super Admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'content' => [
                'required',
                'string',
                'max:10000', // Limit content to 10KB
                function ($attribute, $value, $fail) {
                    // Basic robots.txt validation
                    if (!$this->isValidRobotsTxt($value)) {
                        $fail('محتوى robots.txt غير صحيح. يجب أن يحتوي على User-agent و Disallow على الأقل.');
                    }
                },
            ],
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'content.required' => 'محتوى robots.txt مطلوب',
            'content.string' => 'محتوى robots.txt يجب أن يكون نص',
            'content.max' => 'محتوى robots.txt لا يجب أن يتجاوز 10000 حرف',
        ];
    }

    /**
     * Basic validation for robots.txt content
     */
    private function isValidRobotsTxt($content): bool
    {
        // Check if content contains User-agent
        if (!preg_match('/User-agent\s*:\s*.+/i', $content)) {
            return false;
        }

        // Check for common robots.txt directives
        $hasValidDirective = preg_match('/(Disallow|Allow|Crawl-delay|Sitemap)\s*:\s*.*/i', $content);
        
        return $hasValidDirective;
    }
}
