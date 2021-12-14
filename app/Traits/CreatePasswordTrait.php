<?php
namespace App\Traits;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\CreatePasswordMail;

trait CreatePasswordTrait
{
    public function sendCreatePassLink($mail, $name) {
        $data = [
            'name'        => $name,
            'mail'        => $mail,
            'hashed-mail' => encrypt($mail)
        ];

        Mail::to($mail)->send(new CreatePasswordMail($data));
    }
}
