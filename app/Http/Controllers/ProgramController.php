<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProgramController extends Controller
{
    public function __construct()
    {
    }
    public function index()
    {
        $programs = Program::all();
        return response()->json(["programs" => $programs], 200);
    }

    public function store(Request $request)
    {
        $rules = array(
            'name' => 'required|unique:programs'
        );

        $messages = array();

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {

            $messages = $validator->messages();

            return response()->json(["messages" => $messages], 500);
        }

        $program = new Program();
        $program->name = $request->name;
        $program->save();

        return response()->json(["program" => $program, "message" => "Program has been created successfully"], 200);
    }

    public function show($id)
    {
        $program = Program::find($id);

        if ($program != '') {

            return response()->json(["program" => $program], 200);
        } else {
            return response()->json(["messages" => "Program not found"], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $rules = array(
            'name' => 'required|unique:programs,name,' . $id
        );

        $messages = array();

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {

            $messages = $validator->messages();

            return response()->json(["messages" => $messages], 500);
        }

        $program = Program::find($id);

        if ($program != '') {
            $program->name = $request->name;
            $program->update();

            return response()->json(["program" => $program, "message" => "Program has been updated successfully"], 200);
        } else {
            return response()->json(["messages" => "Program not found"], 500);
        }
    }

    public function destroy($id)
    {
        $program = Program::find($id);

        if ($program != '') {
            Program::destroy($id);

            return response()->json(["message" => "Program has been deleted successfully"], 200);
        } else {
            return response()->json(["messages" => "Program not found"], 500);
        }
    }
}
