<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Display the manage page for sub categories
     */
    public function manage()
    {
        $allSubCategories = SubCategory::with('parentCategory')->get();
        return view('admin.subcategory.manage', compact('allSubCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $allCategories = Category::all();
        return view('admin.subcategory.create', compact('allCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|min:3',
                'parent_category_id' => 'required|exists:category,id',
            ]);

            SubCategory::create([
                'name' => $request->name,
                'parent_category_id' => $request->parent_category_id,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'تم حفظ التصنيف الفرعي بنجاح',
                'redirect_url' => route('admin.subcategory.manage')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(SubCategory $subCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubCategory $subCategory)
    {
        $allCategories = Category::all();
        return view('admin.subcategory.edit', compact('subCategory', 'allCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubCategory $subCategory)
    {
        try {
            $request->validate([
                'name' => 'required|min:3',
                'parent_category_id' => 'required|exists:category,id',
            ]);

            $subCategory->update([
                'name' => $request->name,
                'parent_category_id' => $request->parent_category_id,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'تم تحديث التصنيف الفرعي بنجاح',
                'redirect_url' => route('admin.subcategory.manage')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubCategory $subCategory)
    {
        try {
            $subCategory->delete();

            return response()->json([
                'success' => true,
                'message' => 'تم حذف التصنيف الفرعي بنجاح',
                'redirect_url' => route('admin.subcategory.manage')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Get sub categories by parent category ID (AJAX)
     */
    public function getSubCategoriesByParent($categoryId)
    {
        $subCategories = SubCategory::where('parent_category_id', $categoryId)->get();
        return response()->json($subCategories);
    }
}
