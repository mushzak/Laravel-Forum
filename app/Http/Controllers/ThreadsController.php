<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreThread;
use App\Thread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ThreadsController extends Controller
{
    /**
     * ThreadsController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('threads.create');
    }


    public function store(StoreThread $request)
    {
        $data = $request->all();
        $count = Auth::user()->threads->count();
        if($count >= 3){
            Thread::orderBy('id', 'desc')->limit(3)->first()->delete();
        }
        Thread::create([
            "title" => $data['title'],
            "content" => $data['content'],
            "user_id" => Auth::user()->id
        ]);

        return redirect()->route('home');
    }
}
