<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTodoRequest;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $todo = Response::api(['todos' => Todo::all()]);
        return view('pages.todo.index', compact('todo'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateTodoRequest $request)
    {
        $todo = Todo::create($request->all());

        return Response::api(['todo' => $todo], Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     */
    public function show(Todo $todo)
    {
        return Response::api(['todo' => $todo], Response::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Todo $todo)
    {
        return view('todos.edit', compact('todo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreateTodoRequest $request, Todo $todo)
    {
        $todo->update($request->validated());

        return Response::api('todo updated successfully!', Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();

        return Response::api('todo deleted successfully!', Response::HTTP_NO_CONTENT);
    }
}
