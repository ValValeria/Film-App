<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use App\Models\Message;
use Illuminate\Http\Response;

class MessagesController extends Controller
{

    public function __invoke(User $user)
    {
        if (Gate::allows("view-messages", $user)) {
            $messages = Message::where('status','un_read');
            
            $messages->update(["status"=>"read"]);
            
            return response(json_encode(["data"=>$messages]),JSON_UNESCAPED_UNICODE);
        } else {
            return abort(403);
        }
    }
}
