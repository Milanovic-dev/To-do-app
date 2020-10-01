<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoFormRequest;
use Illuminate\Http\Request;
use App\Models\Todo;
use App\Services\TodoService;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TodoController extends Controller
{
    protected $todoService;

    public function __construct(TodoService $todoService)
    {
        $this->todoService = $todoService;
    }

    public function getUserTodos($id)
    {
        return $this->todoService->userTodos($id);
    }

    public function get($id) {
        return $this->todoService->get($id);
    }

    public function create(TodoFormRequest $request)
    {
        $user = auth()->user();
        $data = $request->validated();

        try {
            $todo = $this->todoService->create($user, $data);
            return response()->json($todo, 201);
        } catch (Exception $e) {
            return response(500)->json(['error' => $e->getMessage()]);
        }
    }

    public function update($id, TodoFormRequest $request)
    {
        $data = $request->validated();

        try {
            $todo = $this->todoService->update($id, $data);
            return response()->json($todo, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function delete($id)
    {
        try {
            $this->todoService->delete($id);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }
}
