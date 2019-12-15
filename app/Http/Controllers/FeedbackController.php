<?php

namespace App\Http\Controllers;

use App\Feedback;
use App\Jobs\SendMail;
use App\Mail;
use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Throwable;

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
                $feedbacks = Feedback::all();

                return view(
                    'feedback.list',
                    [
                        'feedbacks' => $feedbacks,
                        'feedback_ids' => implode(',', $this->getIds($feedbacks))
                    ]
                );
            }
            return view('feedback.new');
        }

        return redirect('/login');
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Redirector
     * @throws ValidationException
     * @throws Throwable
     */
    public function post(Request $request)
    {
        if ($user = Auth::user()) {
            /** @var User $user */
            if ($user->role === 'manager') {
                return $this->updateMultiple($request);
            }

            return $this->store($request, $user);
        }

        return redirect('/login');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @param User $user
     * @return RedirectResponse|Redirector
     * @throws ValidationException
     * @throws Throwable
     */
    private function store(Request $request, User $user)
    {
        $this->validate(
            $request,
            [
                'subject' => 'required',
                'message' => 'required',
            ]
        );

        $feedbacks = Feedback::where(['client_id' => $user->id])
            ->orderBy('created_at', 'desc')
            ->limit(1)
            ->get();
        if ($feedbacks) {
            $delay = $feedbacks[0]->created_at->timestamp - (now()->timestamp - 10);
            if ($delay > 0) {
                throw ValidationException::withMessages([
                    'client_id' => ["Too often, relax. Wait for {$delay} sec"],
                ]);
            }
        }

        $feedback = new Feedback([
            'subject'   => $request->get('subject'),
            'message'   => $request->get('message'),
            'client_id' => $user->getAuthIdentifier(),
        ]);
        $feedback->saveOrFail();
        if ($file = $request->file('file')) {
            $filename = "feedback/{$feedback->id}.{$file->extension()}";
            Storage::put($filename, file_get_contents($file));
            $feedback->file = $filename;
            $feedback->saveOrFail();
        }

        $mail = new Mail(['message' => "New feedback #{$feedback->id}"]);
        $mail->saveOrFail();
        SendMail::dispatch($mail)->onConnection('database');

        return redirect('/');
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Redirector
     * @throws Throwable
     */
    private function updateMultiple(Request $request)
    {
        $feedbackIds = explode(',', $request->get('feedback_ids'));
        $processed = $request->get('processed');
        foreach ($feedbackIds as $feedbackId) {
            /** @var Feedback $feedback */
            $feedback = Feedback::find($feedbackId);
            $feedback->processed = in_array($feedbackId, $processed);
            $feedback->saveOrFail();
        }

        return redirect('/feedback');
    }

    private function getIds(Collection $feedbacks): array
    {
        return array_map(
            static function (Feedback $feedback): int {
                return $feedback->id;
            },
            $feedbacks->all()
        );
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
