<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubjectController extends Controller
{
    public function __construct()
    {
    }
    public function index(Request $request)
    {
        $subjects = Subject::where('program_id','=',$request->program_id)->get();
        return response()->json(["subjects" => $subjects], 200);
    }

    public function store(Request $request)
    {
        $rules = array(
            'name' => 'required|unique:subjects'
        );

        $messages = array();

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {

            $messages = $validator->messages();

            return response()->json(["messages" => $messages], 500);
        }

        $subject = new Subject();
        $subject->name = $request->name;
            $subject->semester = $request->semester;
            $subject->credits = $request->credits;
            $subject->prerequisite_subject = $request->prerequisite_subject;
            $subject->autonomous_work = $request->autonomous_work;
            $subject->directed_work = $request->directed_work;
            $subject->teacher = $request->teacher;
            $subject->program_id = $request->program_id;
        $subject->save();

        return response()->json(["subject" => $subject, "message" => "Subject has been created successfully"], 200);
    }

    public function show($id)
    {
        $subject = Subject::find($id);

        if ($subject != '') {

            return response()->json(["subject" => $subject], 200);
        } else {
            return response()->json(["messages" => "Subject not found"], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $rules = array(
            'name' => 'required|unique:subjects,name,' . $id
        );

        $messages = array();

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {

            $messages = $validator->messages();

            return response()->json(["messages" => $messages], 500);
        }

        $subject = Subject::find($id);

        if ($subject != '') {
            $subject->name = $request->name;
            $subject->semester = $request->semester;
            $subject->credits = $request->credits;
            $subject->prerequisite_subject = $request->prerequisite_subject;
            $subject->autonomous_work = $request->autonomous_work;
            $subject->directed_work = $request->directed_work;
            $subject->teacher = $request->teacher;
            $subject->program_id = $request->program_id;
            $subject->update();

            return response()->json(["subject" => $subject, "message" => "Subject has been updated successfully"], 200);
        } else {
            return response()->json(["messages" => "Subject not found"], 500);
        }
    }

    public function destroy($id)
    {
        $subject = Subject::find($id);

        if ($subject != '') {
            Subject::destroy($id);

            return response()->json(["message" => "Subject has been deleted successfully"], 200);
        } else {
            return response()->json(["messages" => "Subject not found"], 500);
        }
    }
}
