<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Questions;
use App\Http\Requests\QuestionsRequest;

class QuestionsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin/home');
    }

    // よくある質問
    public function question()
    {
        return view('admin.question');
    }
    // よくある質問作成
    public function create_question(QuestionsRequest $request)
    {
        Questions::insert([
            'admin_id' => Auth::id(),
            'title' => $request->title,
            'contents' => $request->contents,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return redirect()->route('admin.home');
    }
    // よくある質問一覧
    public function question_list()
    {
        $questions = Questions::where('admin_id', Auth::id())
            ->latest('updated_at')
            ->get();
        return view('admin.question_list', compact('questions'));
    }
    // よくある質問編集
    public function question_editForm($id)
    {
        $question = Questions::where('admin_id', Auth::id())
            ->where('id', $id)
            ->first();
        return view('admin.question_editForm', compact('question'));
    }
    public function edit_question(QuestionsRequest $request)
    {
        Questions::where('id', $request->id)
            ->update([
            'title' => $request->title,
            'contents' => $request->contents,
            'updated_at' => now(),
        ]);
        return redirect()->route('admin.question_list');
    }
    // よくある質問削除
    public function delete_question($id)
    {
        Questions::where('admin_id', Auth::id())
            ->where('id', $id)
            ->delete();
        return redirect()->route('admin.question_list');
    }
}
