<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use App\Models\EditorialBoard;
use App\Models\Office;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutUsController extends Controller
{
    /**
     * Display the About Us page
     */
    public function index()
    {
        try {
            $aboutUs = AboutUs::first();
            $editorialBoard = EditorialBoard::active()->get();
            $offices = Office::active()->get();
        } catch (\Exception $e) {
            // If tables don't exist, return empty collections
            $aboutUs = null;
            $editorialBoard = collect();
            $offices = collect();
        }

        return view('about-us', compact('aboutUs', 'editorialBoard', 'offices'));
    }

    /**
     * Display admin management page
     */
    public function admin()
    {
        try {
            $aboutUs = AboutUs::first();
            $editorialBoard = EditorialBoard::orderBy('order')->get();
            $offices = Office::orderBy('order')->get();
        } catch (\Exception $e) {
            // If tables don't exist, return empty collections
            $aboutUs = null;
            $editorialBoard = collect();
            $offices = collect();
        }

        return view('admin.about-us.index', compact('aboutUs', 'editorialBoard', 'offices'));
    }

    /**
     * Update About Us description
     */
    public function updateDescription(Request $request)
    {
        $request->validate([
            'description_en' => 'required|string',
            'description_ar' => 'required|string',
        ]);

        $aboutUs = AboutUs::first();
        
        if (!$aboutUs) {
            $aboutUs = new AboutUs();
        }

        $aboutUs->description = [
            'en' => $request->description_en,
            'ar' => $request->description_ar,
        ];
        
        $aboutUs->save();

        return redirect()->back()->with('success', 'Description updated successfully.');
    }

    /**
     * Store Editorial Board member
     */
    public function storeEditorialMember(Request $request)
    {
        $request->validate([
            'name_en' => 'required|string',
            'name_ar' => 'required|string',
            'position_en' => 'required|string',
            'position_ar' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'required|integer|min:0',
        ]);

        $data = [
            'name' => [
                'en' => $request->name_en,
                'ar' => $request->name_ar,
            ],
            'position' => [
                'en' => $request->position_en,
                'ar' => $request->position_ar,
            ],
            'order' => $request->order,
            'is_active' => $request->has('is_active'),
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('editorial-board', 'public');
        }

        EditorialBoard::create($data);

        return redirect()->back()->with('success', 'Editorial Board member added successfully.');
    }

    /**
     * Update Editorial Board member
     */
    public function updateEditorialMember(Request $request, EditorialBoard $member)
    {
        $request->validate([
            'name_en' => 'required|string',
            'name_ar' => 'required|string',
            'position_en' => 'required|string',
            'position_ar' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'required|integer|min:0',
        ]);

        $data = [
            'name' => [
                'en' => $request->name_en,
                'ar' => $request->name_ar,
            ],
            'position' => [
                'en' => $request->position_en,
                'ar' => $request->position_ar,
            ],
            'order' => $request->order,
            'is_active' => $request->has('is_active'),
        ];

        if ($request->hasFile('image')) {
            // Delete old image
            if ($member->image) {
                Storage::disk('public')->delete($member->image);
            }
            $data['image'] = $request->file('image')->store('editorial-board', 'public');
        }

        $member->update($data);

        return redirect()->back()->with('success', 'Editorial Board member updated successfully.');
    }

    /**
     * Delete Editorial Board member
     */
    public function deleteEditorialMember(EditorialBoard $member)
    {
        if ($member->image) {
            Storage::disk('public')->delete($member->image);
        }
        
        $member->delete();

        return redirect()->back()->with('success', 'Editorial Board member deleted successfully.');
    }

    /**
     * Store Office
     */
    public function storeOffice(Request $request)
    {
        $request->validate([
            'name_en' => 'required|string',
            'name_ar' => 'required|string',
            'address_en' => 'required|string',
            'address_ar' => 'required|string',
            'phone' => 'nullable|string',
            'email' => 'nullable|email',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'required|integer|min:0',
        ]);

        $data = [
            'name' => [
                'en' => $request->name_en,
                'ar' => $request->name_ar,
            ],
            'address' => [
                'en' => $request->address_en,
                'ar' => $request->address_ar,
            ],
            'phone' => $request->phone,
            'email' => $request->email,
            'order' => $request->order,
            'is_active' => $request->has('is_active'),
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('offices', 'public');
        }

        Office::create($data);

        return redirect()->back()->with('success', 'Office added successfully.');
    }

    /**
     * Update Office
     */
    public function updateOffice(Request $request, Office $office)
    {
        $request->validate([
            'name_en' => 'required|string',
            'name_ar' => 'required|string',
            'address_en' => 'required|string',
            'address_ar' => 'required|string',
            'phone' => 'nullable|string',
            'email' => 'nullable|email',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'required|integer|min:0',
        ]);

        $data = [
            'name' => [
                'en' => $request->name_en,
                'ar' => $request->name_ar,
            ],
            'address' => [
                'en' => $request->address_en,
                'ar' => $request->address_ar,
            ],
            'phone' => $request->phone,
            'email' => $request->email,
            'order' => $request->order,
            'is_active' => $request->has('is_active'),
        ];

        if ($request->hasFile('image')) {
            // Delete old image
            if ($office->image) {
                Storage::disk('public')->delete($office->image);
            }
            $data['image'] = $request->file('image')->store('offices', 'public');
        }

        $office->update($data);

        return redirect()->back()->with('success', 'Office updated successfully.');
    }

    /**
     * Delete Office
     */
    public function deleteOffice(Office $office)
    {
        if ($office->image) {
            Storage::disk('public')->delete($office->image);
        }
        
        $office->delete();

        return redirect()->back()->with('success', 'Office deleted successfully.');
    }
}
