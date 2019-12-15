<?php

namespace App\Http\Controllers;

use App\Feedback;
use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if ($user = Auth::user()) {
            /** @var User $user */
            if ($user->getAttribute('role') === 'manager') {
                return view('feedback.list', ['feedbacks' => Feedback::all()]);
            }
            return view('feedback.new');
        }

        return redirect('/login');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return RedirectResponse|Redirector
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'subject' => 'required',
                'message' => 'required',
            ]
        );
        if ($user = Auth::user()) {
            (new Feedback([
                'subject' => $request->get('subject'),
                'message' => $request->get('message'),
                'client_id' => $user->getAuthIdentifier(),
            ]))->save();
        }

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function show(Feedback $feedback)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function edit(Feedback $feedback)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Feedback $feedback)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function destroy(Feedback $feedback)
    {
        //
    }
}
