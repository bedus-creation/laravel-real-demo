<?php

namespace App\Http\Controllers\Api;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Events\MesssageSent;
use App\User;


class MessageController extends Controller
{
    protected $repository;

    public function __construct(Message $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->merge(["from_id" => auth()->user()->id]);
        $message = $this->repository->create($request->all());
        broadcast(new MesssageSent($message))->toOthers();
        return response()->json(['message' => 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::where('id', '!=', auth()->user()->id)
            ->where('id', $id)
            ->firstOrFail();
        $messages = $this->repository
            ->whereRaw('(`to_id` = ' . auth()->user()->id . ' and `from_id` = ' . $id . ') or (`to_id` = ' . $id . ' and `from_id` = ' . auth()->user()->id . ')')->orderBy('id', 'desc')->limit(5)->get();
        $messages = $messages->keyBy('id')->reverse();
        return view('action.messenger.show', compact('user', 'messages'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        //
    }
}