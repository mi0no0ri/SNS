<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Noticies;
use App\Http\Requests\NoticiesRequest;

class NoticiesController extends Controller
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

    // お知らせ
    public function notice()
    {
        return view('admin/notice');
    }
    // お知らせ作成
    public function create_notice(NoticiesRequest $request)
    {
        DB::table('noticies')->insert([
            'admin_id' => Auth::id(),
            'title' => $request->title,
            'contents' => $request->contents,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return redirect()->route('admin.home');
    }
    //お知らせ一覧
    public function notice_list()
    {
        $noticies = Noticies::where('admin_id', Auth::id())
            ->latest('updated_at')
            ->get();
        return view('admin/notice_list', compact('noticies'));
    }
    // お知らせ編集
    public function notice_editForm($id)
    {
        $notice = Noticies::where('admin_id', Auth::id())
            ->where('id', $id)
            ->first();
        return view('admin/notice_editForm', compact('notice'));
    }
    public function edit_notice(NoticiesRequest $request)
    {
        Noticies::where('id', $request->id)
            ->update([
                'title' => $request->title,
                'contents' => $request->contents,
                'updated_at' => now(),
            ]);
        return redirect()->route('admin.notice_list');
    }
    // お知らせ削除
    public function delete_notice($id)
    {
        DB::table('noticies')
            ->where('id',$id)
            ->delete();
        return redirect('admin/notice_list');
    }
}
