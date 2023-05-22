<?php

namespace App\Http\Controllers;

use App\Models\MessageBoard;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
class MessageBoardController extends Controller
{
    public function insertData(Request $request)
    {
        $user_id = $request->input("user_id");
        $content = $request->input("content");
        $data = [
            'user_id' => $user_id,
            'content' => htmlspecialchars($content),
            'created_at' => Carbon::now(),
        ];
        MessageBoard::create($data);
        return redirect()->route('index');
    }

    public function getData()
    {
        // $data = MessageBoard::with('user')->select('id', 'user_id', 'content', 'users.name')->get();
        $data = MessageBoard::with('user')->get();
        return view('index',['data' => $data]);
    }

    public function updateData(Request $request)
    {
        $update = MessageBoard::findOrFail($request->input("id"));

        $update->content = htmlspecialchars($request->input('content'));
        $update->save();
    
        return redirect()->route('index');
    }

    public function deleteData(Request $request)
    {
        $delete = MessageBoard::find($request->input("id"));
        $delete->delete();
        return redirect()->route('index');
    }
}
