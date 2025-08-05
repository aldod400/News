<?php

namespace App\Http\Controllers;

use App\Models\PrivacyPolicy;
use Illuminate\Http\Request;

class PrivacyPolicyController extends Controller
{
    /**
     * Display the privacy policy page
     */
    public function index()
    {
        try {
            $policy = PrivacyPolicy::getActivePolicy();
            return view('privacy-policy', compact('policy'));
        } catch (\Exception $e) {
            // Fallback if table doesn't exist
            $policy = null;
            return view('privacy-policy', compact('policy'));
        }
    }

    /**
     * Display admin listing
     */
    public function admin()
    {
        try {
            $policies = PrivacyPolicy::orderBy('created_at', 'desc')->get();
            return view('admin.privacy-policy.index', compact('policies'));
        } catch (\Exception $e) {
            // Fallback if table doesn't exist
            $policies = collect([]);
            return view('admin.privacy-policy.index', compact('policies'));
        }
    }

    /**
     * Show the form for creating a new policy
     */
    public function create()
    {
        return view('admin.privacy-policy.create');
    }

    /**
     * Store a newly created policy
     */
    public function store(Request $request)
    {
        $request->validate([
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'content_en' => 'required|string',
            'content_ar' => 'required|string',
            'is_active' => 'boolean'
        ]);

        $data = [
            'title' => [
                'en' => $request->title_en,
                'ar' => $request->title_ar
            ],
            'content' => [
                'en' => $request->content_en,
                'ar' => $request->content_ar
            ],
            'last_updated' => now(),
            'is_active' => $request->has('is_active')
        ];

        $policy = PrivacyPolicy::create($data);

        // If this policy is set as active, deactivate others
        if ($policy->is_active) {
            $policy->setAsActive();
        }

        return redirect()->route('admin.privacy-policy.index')
                        ->with('success', __('general.privacy_policy_created'));
    }

    /**
     * Show the form for editing a policy
     */
    public function edit($id)
    {
        $policy = PrivacyPolicy::findOrFail($id);
        return view('admin.privacy-policy.edit', compact('policy'));
    }

    /**
     * Update the specified policy
     */
    public function update(Request $request, $id)
    {
        $policy = PrivacyPolicy::findOrFail($id);

        $request->validate([
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'content_en' => 'required|string',
            'content_ar' => 'required|string',
            'is_active' => 'boolean'
        ]);

        $data = [
            'title' => [
                'en' => $request->title_en,
                'ar' => $request->title_ar
            ],
            'content' => [
                'en' => $request->content_en,
                'ar' => $request->content_ar
            ],
            'last_updated' => now(),
            'is_active' => $request->has('is_active')
        ];

        $policy->update($data);

        // If this policy is set as active, deactivate others
        if ($policy->is_active) {
            $policy->setAsActive();
        }

        return redirect()->route('admin.privacy-policy.index')
                        ->with('success', __('general.privacy_policy_updated'));
    }

    /**
     * Remove the specified policy
     */
    public function destroy($id)
    {
        $policy = PrivacyPolicy::findOrFail($id);
        
        // Check if this is the only active policy
        if ($policy->is_active && PrivacyPolicy::where('is_active', true)->count() <= 1) {
            return redirect()->route('admin.privacy-policy.index')
                            ->with('error', __('general.cannot_delete_only_active_policy'));
        }

        $policy->delete();

        return redirect()->route('admin.privacy-policy.index')
                        ->with('success', __('general.privacy_policy_deleted'));
    }

    /**
     * Set policy as active
     */
    public function setActive($id)
    {
        $policy = PrivacyPolicy::findOrFail($id);
        $policy->setAsActive();

        return redirect()->route('admin.privacy-policy.index')
                        ->with('success', __('general.privacy_policy_activated'));
    }
}
