<?php 
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;

class NewsletterWelcomePromoMail extends Mailable implements ShouldQueue
{
    public function __construct(public $subscriber) {}

    public function build()
    {
        return $this->subject('Welcome 🎉')
            ->view('emails.newsletter.welcome');
    }
}
