<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\QuestionOption;
use App\Question;


class QuestionOptionController extends Controller
{
    /**
     * Store/Update Options
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Question Id $id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $options = $request->options;
        $question = Question::findOrFail($id);
        $question->options()->delete(); //First delete old options
        $new_options = array();
        foreach ($options as $key => $option) {
            $is_correct = ( $request->is_correct == $key ) ? '1' : '0';
            $new_options[] = ['question_id' => $id, 'option' => $option, 'is_correct' => $is_correct ]; 
        }

        // Insert new options
        $question->options()->createMany($new_options);
        $new_options = QuestionOption::where('question_id', $id)->get();

        return redirect()->route('admin.questions.edit',$id)->with('success' , 'Options updated successfully');
    }
}
