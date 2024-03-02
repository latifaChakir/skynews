<?php

namespace App\Jobs;

use App\Mail\SendEmailQueueDemo;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailQueueJob implements ShouldQueue
{
   use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
  
    protected $send_mail;
    protected $content;
    protected $subject;
  
    /**
     * Create a new job instance.
     */
    public function __construct($send_mail , $content , $subject)
    {
        $this->send_mail = $send_mail;
        $this->content = $content;
        $this->subject = $subject;
    }
  
    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $email = new SendEmailQueueDemo($this->content,$this->subject);
        Mail::to($this->send_mail)->send($email);
    }
}
