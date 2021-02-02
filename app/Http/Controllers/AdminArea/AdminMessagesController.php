<?php

namespace App\Http\Controllers\AdminArea;

use App\Http\Controllers\Controller;
use App\Models\Letter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminMessagesController extends Controller
{
    private $response = ["errors"=>[],"status"=>""];

    public function addLetter(Request $request)
    {
        $data = $request->only([
            'username','email','message'
        ]);

        $validator = Validator::make($data, [
            'username'=>'min:5|max:10|required',
            'email'=>'email|required',
            'message'=>'required|min:10|max:200'
        ]);

        if (!$validator->fails()) {
            $letter = new Letter();
            $letter->username = $request->username;
            $letter->email = $request->email;
            $letter->message = $request->message;
            $letter->created_at = $letter->updated_at =  date('Y-m-d');
            $letter->save();
            $this->response['status'] = "added";
        } else{
            $this->response['errors'] = $validator->errors();
        }
        
        return response()->json($this->response);
    }

    public function viewLetter(Letter $letter)
    {
        return view('admin.pages.letter')->with('letter', $letter);
    }

    public function viewLetters()
    {
        $letters = Letter::paginate(15);
        return view('admin.pages.letters')->with('letters', $letters);
    }

    public function deleteLetter(Letter $letter)
    {
        $letter->delete();
        return redirect()->route('letters')->with('status', 'deleted');
    }

    public function deleteLetters()
    {
        Letter::destroy(Letter::all()->pluck('id'));
        return redirect()->route('letters')->with('status', 'deleted');
    }
}
