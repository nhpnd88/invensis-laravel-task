<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $pages = Page::all();
        return view('admin.pages.index', compact('pages'));
    }
    public function product()
    { 
        $pages = Page::where('type','Payment Page')->get();
        //print_r($pages);exit;
        return view('admin.pages.product', compact('pages'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $page = new Page($request->all());
       
    if($request->type == 'Normal Page'){
            $request->validate([
                'type' => 'required',
                'title' => 'nullable|string',
                'image' => 'nullable|image',
                'description' => 'nullable|string',
            ]);

            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('images', 'public');
                $page->image = $path;
            }
       }
         elseif($request->type == 'Payment Page'){
            $request->validate([
                'type' => 'required',
                'image1' => 'nullable|image',
                'description1' => 'nullable|string',
                'product' => 'nullable|string',
                'price' => 'nullable|numeric',
                'currency' => 'nullable|string',
            ]);
            if ($request->hasFile('image1')) {
                $path = $request->file('image1')->store('images', 'public');
                $page->image = $path;
            }
        }
        

        $page->save();

        return redirect()->route('pages.index')->with('success', 'Page created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Page $page)
    {
        return view('admin.pages.show', compact('page'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Page $page)
    {
        return view('admin.pages.create', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Page $page)
    {
        $page->fill($request->all());

        if($request->type == 'Normal Page'){
            $request->validate([
                'type' => 'required',
                'title' => 'nullable|string',
                'image' => 'nullable|image',
                'description' => 'nullable|string',
            ]);

            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('images', 'public');
                $page->image = $path;
            }
         }
         elseif($request->type == 'Payment Page'){
            $request->validate([
                'type' => 'required',
                'image1' => 'nullable|image',
                'description1' => 'nullable|string',
                'product' => 'nullable|string',
                'price' => 'nullable|numeric',
                'currency' => 'nullable|string',
            ]);
            if ($request->hasFile('image1')) {
                $path = $request->file('image1')->store('images', 'public');
                $page->image = $path;
            }
        }


        $page->save();

        return redirect()->route('pages.index')->with('success', 'Page updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Page $page)
    {
        $page->delete();
        return redirect()->route('pages.index')->with('success', 'Page deleted successfully.');
    }

    
}
