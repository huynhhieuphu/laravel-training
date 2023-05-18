<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $comment = Comment::findorfail(2);

        // allows
        // if (Gate::allows('edit-comment', $comment)) {
        //     return 'Co quyen';
        // } else {
        //     return 'Khong co quyen';
        // }

        //denies : ngược lại với allows
        // if (Gate::denies('edit-comment', $comment)) {
        //     return 'Khong co quyen';
        // } else {
        //     return 'Co quyen';
        // }

        // policy
        $user = Auth()->user();
        // if ($user->can('update', $comment)) {
        //     return 'Co quyen';
        // } else {
        //     return 'Khong co quyen';
        // }

        // if ($user->cant('update', $comment)) {
        //     return 'Khong co quyen';
        // } else {
        //     return 'Co quyen';
        // }

        // if ($user->can('create', Comment::class)) {
        //     return 'Co quyen';
        // } else {
        //     return 'Khong co quyen';
        // }


        $this->authorize('update', $comment); //nếu không có quyền sẽ trả về 403
    }

    public function getAllComments()
    {
        $comments = Comment::all();
        return view('comments.index', compact('comments'));
    }
}
