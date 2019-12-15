<?php

namespace App\Jobs;

use App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Throwable;

class SendMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** @var Mail */
    private $mail;

    /**
     * Create a new job instance.
     * @param Mail $mail
     */
    public function __construct(Mail $mail)
    {
//        (new Mail(['message' => 'Creating a SendMail instance']))->saveOrFail(); // TODO: remove
        $this->mail = $mail;
    }

    /**
     * @throws Throwable
     */
    public function handle(): void
    {
//        (new Mail(['message' => 'Handling a SendMail']))->saveOrFail(); // TODO: remove
        $this->mail->sent = true;
        $this->mail->saveOrFail();
    }
}
