<?php

namespace App\Http\Controllers;

use App\Http\Resources\MessageResource;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    /**
     * Store messages in database.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $validator = Validator::make(
            $request->all(),
            [
                'content' => 'required',
            ],
            [
                'required' => 'Le champ :attribute est requis',
            ]
        );

        $errors = $validator->errors();

        if (count($errors) != 0) {
            return response()->json([
                'success' => false,
                'message' => $errors->first()
            ]);
        }

        $content   = $validator->validated()['content'];

        Message::create([
            'from'    => Auth::id(),
            'content' => $content
        ]);

        return response()->json([
            'success' => true,
            'message' => "Message envoyer"
        ]);
    }


    /**
     * Retrieve messages from database.
     *
     * @return \Illuminate\Http\Response
     */
    public function retrieve() {
        $messages = Message::all();
        return MessageResource::collection($messages);
    }
}
