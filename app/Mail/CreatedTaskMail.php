<?php

namespace App\Mail;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CreatedTaskMail extends Mailable
{
    use Queueable, SerializesModels;

    private $task;

    /**
     * Create a new message instance.
     */
    public function __construct($task)
    {
        $this->task = $task;
    }

    public function build(){
        $this->from(config('mail.from.address'), config('mail.from.name'))
            ->subject('New task created')
            ->view('mail.new-task', ['task' => $this->task]);
    }

}
