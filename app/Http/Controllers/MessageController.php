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
                'to'      => 'required|integer',
                'content' => 'required',
            ],
            [
                'required' => 'Le champ :attribute est requis',
                'integer' => ':attribute invalide',
            ]
        );

        $errors = $validator->errors();

        if (count($errors) != 0) {
            return response()->json([
                'success' => false,
                'message' => $errors->first()
            ]);
        }

        $toUser    = $validator->validated()['to'];
        $content   = $validator->validated()['content'];

        Message::create([
            'from'    => Auth::id(),
            'to'      => $toUser,
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
        $user   = Auth::user();
        $userId = $user->id;
        $messages = Message::where(['from' => $userId])->get();
        return MessageResource::collection($messages);
    }
}
