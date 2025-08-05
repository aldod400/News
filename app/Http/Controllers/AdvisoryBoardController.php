<?php

namespace App\Http\Controllers;

use App\Models\AdvisoryBoard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdvisoryBoardController extends Controller
{
    /**
     * Display the advisory board page
     */
    public function index()
    {
        try {
            $members = AdvisoryBoard::getActiveMembers();
            return view('advisory-board', compact('members'));
        } catch (\Exception $e) {
            // Fallback if table doesn't exist
            $members = collect([]);
            return view('advisory-board', compact('members'));
        }
    }

    /**
     * Display admin listing
     */
    public function admin()
    {
        try {
            $members = AdvisoryBoard::orderBy('order')->orderBy('id')->get();
            return view('admin.advisory-board.index', compact('members'));
        } catch (\Exception $e) {
            // Fallback if table doesn't exist
            $members = collect([]);
            return view('admin.advisory-board.index', compact('members'));
        }
    }

    /**
     * Show the form for creating a new member
     */
    public function create()
    {
        return view('admin.advisory-board.create');
    }

    /**
     * Store a newly created member
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'job_title_en' => 'required|string|max:255',
            'job_title_ar' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean'
        ]);

        $data = [
            'name' => [
                'en' => $request->name_en,
                'ar' => $request->name_ar
            ],
            'job_title' => [
                'en' => $request->job_title_en,
                'ar' => $request->job_title_ar
            ],
            'order' => $request->order ?? 0,
            'is_active' => $request->has('is_active')
        ];

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/uploads', $imageName);
            $data['image'] = $imageName;
        }

        AdvisoryBoard::create($data);

        return redirect()->route('admin.advisory-board.index')
                        ->with('success', __('general.advisory_board_member_created'));
    }

    /**
     * Show the form for editing a member
     */
    public function edit($id)
    {
        $member = AdvisoryBoard::findOrFail($id);
        return view('admin.advisory-board.edit', compact('member'));
    }

    /**
     * Update the specified member
     */
    public function update(Request $request, $id)
    {
        $member = AdvisoryBoard::findOrFail($id);

        $request->validate([
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'job_title_en' => 'required|string|max:255',
            'job_title_ar' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean'
        ]);

        $data = [
            'name' => [
                'en' => $request->name_en,
                'ar' => $request->name_ar
            ],
            'job_title' => [
                'en' => $request->job_title_en,
                'ar' => $request->job_title_ar
            ],
            'order' => $request->order ?? 0,
            'is_active' => $request->has('is_active')
        ];

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($member->image) {
                Storage::delete('public/uploads/' . $member->image);
            }

            $image = $request->file('image');
            $imageName = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/uploads', $imageName);
            $data['image'] = $imageName;
        }

        $member->update($data);

        return redirect()->route('admin.advisory-board.index')
                        ->with('success', __('general.advisory_board_member_updated'));
    }

    /**
     * Remove the specified member
     */
    public function destroy($id)
    {
        $member = AdvisoryBoard::findOrFail($id);

        // Delete image
        if ($member->image) {
            Storage::delete('public/uploads/' . $member->image);
        }

        $member->delete();

        return redirect()->route('admin.advisory-board.index')
                        ->with('success', __('general.advisory_board_member_deleted'));
    }
}
