<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreThread;
use App\Mail\ReplyNotification;
use App\Reply;
use App\Thread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

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

    /**
     * @param StoreThread $request
     * @return \Illuminate\Http\RedirectResponse
     */
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
        if ($thread->user_id == Auth::user()->id) {
            $thread->replies()->delete();
            $thread->delete();
        }

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

    /**
     * Show single thread
     *
     * @param Thread $thread
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function single(Thread $thread)
    {
        return view('threads.single', compact('thread'));
    }

    /**
     * Add Reply
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reply(Request $request)
    {
        if (is_null($request->text)) {
            return redirect()->back();
        }
        Reply::create([
            'user_id' => Auth::user()->id,
            'thread_id' => $request->id,
            'text' => $request->text,
        ]);
        $thread = Thread::find($request->id);

        $data['user'] = Auth::user();
        $data['thread'] = $thread;
        $data['text'] = $request->text;

        Mail::to($thread->user->email)->send(new ReplyNotification($data));

        return redirect()->back();
    }

    /**
     * @param Thread $thread
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function adminDestroy(Thread $thread)
    {
        $thread->replies()->delete();
        $thread->delete();
        return redirect()->back();
    }

}
