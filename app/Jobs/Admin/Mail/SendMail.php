<?php

namespace App\Jobs\Admin\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;

class SendMail implements ShouldQueue
{
  use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

  protected array $users;

  protected string $title;

  protected string $text;

  /**
   * Create a new job instance.
   *
   * @return void
   */
  public function __construct(array $users, $title, $text)
  {
    $this->users = $users;
    $this->title = strval($title);
    $this->text = strval($text);
  }

  /**
   * Execute the job.
   *
   * @return void
   */
  public function handle()
  {
    foreach ($this->users as $user) {
      $this->sendMail($user, $this->title, $this->text);
    }
  }

  public function sendMail(array $user, string $title, string $text)
  {
    Mail::send(
      'admin.emails-templates.mail', 
      ['user' => $user, 'title' => $title, 'text' => $text], 
      function ($message) use ($user, $title) {
        $message->to($user['email'], "{$user['first_name']} {$user['last_name']}");
        $message->subject($title);
      }
    );
  }
}
