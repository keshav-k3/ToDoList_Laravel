<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::all();
        return view('welcome',[
            'todos' => $todos
        ]);
    }
    public function store()
    {
        $attributes = request()->validate([
            'title' => 'required',
            'description' => 'nullable',
            'priority' => 'required|in:low,medium,high',
        ]);
        Todo::create($attributes);
        
        return redirect('/');
    }

    public function update(Todo $todo)
    {
        $todo->update(['isDone' =>true]);

        return redirect('/');
    }

    public function destroy(Todo $todo)
    {
        $todo->delete();

        return redirect('/');
    }

}
