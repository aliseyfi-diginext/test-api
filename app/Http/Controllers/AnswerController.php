<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Answer;

class AnswerController extends Controller
{
    public function get(Request $request)
    {
        $request->validate(['phone' => 'required']);
        $answer = Answer::wherePhone($request->phone)->first();
        if ($answer) {
            return $answer->answers ?? [];
        }else {
            Answer::create(['phone' => $request->phone]);
            return [];
        }
    }

    public function save(Request $request)
    {
        $request->validate([
            'phone' => 'required|exists:answers,phone',
            'number' => 'required|integer',
            'answer' => 'required|string|size:1',
        ]);
        $answer = Answer::wherePhone($request->phone)->firstOrFail();
        $newAnswers = $answer->answers ?? [];
        $newAnswers[$request->number] = $request->answer;
        $answer->answers = json_encode($newAnswers);
        $answer->save();
        return ['success' => true];
    }
}
