<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SampleNotification extends Mailable
{
    use Queueable, SerializesModels;

    protected $title;
    protected $delivery_day;
    protected $delivery_place;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $delivery_day, $delivery_place)
    {
      $this->title = sprintf('%sさん、ご注文ありがとうございます。', $name);
      $this->delivery_day = $delivery_day;
      $this->delivery_place = $delivery_place;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.sample_notification')
                    ->subject($this->title)
                    ->with([
                      'delivery_day' => $this->delivery_day,
                      'delivery_place' => $this->delivery_place,
                    ]);
    }
}
