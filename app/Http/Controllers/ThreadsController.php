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

    public function index()
    {
        $threads = Thread::all();

        return view('threads.index', compact('threads'));
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
        if ($count >= 5) {
            Thread::orderBy('id', 'desc')->limit(3)->first()->delete();
        }
        Thread::create([
            "title" => $data['title'],
            "content" => $data['content'],
            "user_id" => Auth::user()->id
        ]);

        return redirect()->route('home');
    }

    /**
     * @param Thread $thread
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Thread $thread)
    {
        $thread->delete();

        return redirect()->back();
    }

    /**
     * @param Thread $thread
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function edit(Thread $thread)
    {
        return view('threads.update', compact('thread'));
    }

    /**
     * @param StoreThread $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StoreThread $request)
    {
        $data = $request->all();
        $thread = Thread::find($data['id']);
        $thread->title = $data['title'];
        $thread->content = $data['content'];
        $thread->save();

        return redirect()->route('home');
    }

}
