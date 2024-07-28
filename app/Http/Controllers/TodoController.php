<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class TodoController extends Controller
{
     public function create(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'days' => 'required',
        ],);

        
          $uncompletedCount = Todo::where('days', $request->input('days'))
                                  ->where('task_completed', 'no')
                                  ->count();

          if ($uncompletedCount >= 2) {
              return response()->json(['message' => 'You can only have two uncompleted tasks for this day.'],400);
          }
      

      $todolist = new Todo();  
      $todolist->name = $request->input('name');
      $todolist->description = $request->input('description');
      $todolist->days = $request->input('days');
      $todolist->save();
      
      return response()->json(['message' => 'Task created successfully']);
    }


    public function display()
    {
      $lists = Todo::all();
      return $lists;
       
    }

    public function edit($id)
    {
      $list = Todo::findOrFail($id);
     return $list;
       
    }

    public function update(Request $request,$id)
    {

        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'days' => 'required',
        ],);

      $todo = Todo:: findOrFail($id);
      $todo->name = $request->input('name');
      $todo->description = $request->input('description');
      $todo->days = $request->input('days');
      $todo->save();
      
      return response()->json(['message' => 'Task updated successfully']);
   
    }



    
    public function checkComplete(Request $request,$id)
    {
      
      $task = $request->input('completed');
      $todo = Todo:: findOrFail($id);
      $todo->task_completed = $task;
      $todo->save();
      
      return $task;
    }


    
    public function destroy($id)
    {
      $task = Todo::findOrFail($id);
      $task->delete();
      return response()->json(['message' => 'Task deleted successfully.']);
      
    }
}
