<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;

class PageApiController extends Controller
{
    public function index()
    {
        $pages = Page::all();

        return response()->json([
            'status' => 'success',
            'pages' => $pages
        ]);
    }

    public function show($id)
    {
        $page = Page::findOrFail($id);

        return response()->json([
            'status' => 'success',
            'page' => $page
        ]);
    }
}
