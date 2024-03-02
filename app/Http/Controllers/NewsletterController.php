<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Newsletter;
use App\Models\NewsletterCategory;
use Illuminate\Support\Facades\DB;

class NewsletterController extends Controller
{
    public function index()
    {
        $newsletters = Newsletter::simplePaginate(2);
        $categories = \App\Models\Category::all();
        return view('user.news.index', compact('newsletters', 'categories'));
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $category_id = $request->input('category_id') ?? '';

        if ($category_id) {
            $newsletters = DB::table('newsletter_categories')
                ->join('newsletters', 'newsletter_categories.newsletter_id', '=', 'newsletters.id')
                ->where('newsletter_categories.category_id', $category_id)
                ->where('newsletters.name', 'like', '%' . $search . '%')
                ->select('newsletters.*')
                ->simplePaginate(2)->appends(['search' => $search]);
        } else {
            $newsletters = Newsletter::where('name', 'like', '%' . $search . '%')
                ->simplePaginate(2)->appends(['search' => $search]);
        }

        $categories = \App\Models\Category::all();
        return view('user.news.index', compact('newsletters', 'categories'));
    }

    /**
     * Create a new resource.
     */
    public function create()
    {
        $categories = \App\Models\Category::all();
        return view('user.news.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string|min:10',
            'category_id' => 'required',
            'content' => 'required|string|min:10',
        ]);

        $user_id = auth()->user()->id;

        Newsletter::create([
            'name' => $request->name,
            'description' => $request->description,
            'content' => $request->content,
            'user_id' => $user_id,
        ]);

        NewsletterCategory::create([
            'category_id' => $request->category_id,
            'newsletter_id' => Newsletter::latest()->first()->id,
        ]);

        return redirect()->route('newsletters.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $newsletter = Newsletter::find($id);
        $categories = \App\Models\Category::all();
        return view('user.news.edit', compact('newsletter', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|min:10',
            'description' => 'required|string|min:10',
            'content' => 'required|string|min:10',
        ]);

        $newsletter = Newsletter::find($id);
        $newsletter->update($validatedData);

        return redirect()->route('newsletters.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $newsletter = Newsletter::find($id);
        $newsletter->delete();

        return redirect()->route('newsletters.index');
    }
}
