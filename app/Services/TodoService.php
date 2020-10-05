<?php

namespace App\Services;

use App\Models\Todo;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TodoService {

    public function userTodos($userId)
    {
        return Todo::where('user_id', $userId)->get();
    }

    public function get($id) {
        return Todo::where('id', $id)->first();
    }

    public function create($user, $data)
    {
        $todo = Todo::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'priority' => $data['priority'],
            'completed' => $data['completed'],
            'user_id' => $user->id
        ]);

        return $todo;
    }

    public function update($id, $data)
    {
        $todo = Todo::where('id', $id)->first();

        if($todo === null) throw new ModelNotFoundException("Model with id:{$id} does not exist.");

        $todo->title = $data['title'];
        $todo->description = $data['description'];
        $todo->priority = $data['priority'];
        $todo->completed = $data['completed'];
        $todo->save();

        return $todo;
    }

    public function delete($id)
    {
        $todo = Todo::where('id', $id)->first();

        if($todo === null) throw new ModelNotFoundException("Model with id:{$id} does not exist.");

        $todo->delete();
    }
}
