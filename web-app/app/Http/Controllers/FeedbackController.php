<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Feedback;
use App\Models\Tag;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index()
    {
        $feedbacks = Feedback::with(['category', 'tags'])->orderByDesc('created_at')->get();
        return view('pages.data', compact('feedbacks'));
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('pages.form', compact('categories', 'tags'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'array', // Массив ID тегов
            'tags.*' => 'exists:tags,id',
        ]);

        $feedback = Feedback::create($validated);
        if ($request->has('tags')) {
            $feedback->tags()->sync($request->tags);
        }

        return redirect()->route('feedback.index')->with('success', 'Отзыв добавлен в БД!');
    }

    public function show($id)
    {
        $feedback = Feedback::with('comments')->findOrFail($id);
        return view('pages.show', compact('feedback'));
    }

    public function edit($id)
    {
        $feedback = Feedback::findOrFail($id);
        $categories = Category::all();
        $tags = Tag::all();
        return view('pages.edit', compact('feedback', 'categories', 'tags'));
    }

    public function update(Request $request, $id)
    {
        $feedback = Feedback::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'array'
        ]);

        $feedback->update($validated);

        if ($request->has('tags')) {
            $feedback->tags()->sync($request->tags);
        } else {
            $feedback->tags()->detach();
        }

        return redirect()->route('feedback.index')->with('success', 'Отзыв обновлен!');
    }

    public function destroy($id)
    {
        $feedback = Feedback::findOrFail($id);
        $feedback->delete(); // Soft Delete

        return redirect()->route('feedback.index')->with('success', 'Отзыв удален (Soft Delete)!');
    }
    public function addComment(Request $request, $id)
    {
        $feedback = Feedback::findOrFail($id);
        $feedback->comments()->create([
            'body' => $request->input('body')
        ]);

        return back()->with('success', 'Комментарий добавлен');
    }
}
