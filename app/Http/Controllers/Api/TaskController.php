<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SubTask;
use App\Models\TaskModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:sanctum');
    // }
    public function index()
    {
        $tasks = TaskModel::with('subTasks')->get();
        return response()->json($tasks);
    }

    public function store(Request $request)
    {
        $sub_task = SubTask::where('id_category', $request->category)->first();
        $task = TaskModel::create([
            'id_category' => $sub_task->id_category,
            'user_id' => Auth::id(),
            'name' => $request->deskripsi,
            'tgl_mulai' => $request->tanggal_mulai,
            'tgl_selesai' => $request->tanggal_berakhir,
        ]);
        return response()->json($task);
    }

    public function show($id)
    {
        $task = TaskModel::with('subTasks')->findOrFail($id);
        return response()->json($task);
    }

    public function update(Request $request, $id)
    {
        $sub_task = SubTask::where('id_category', $request->category)->first();
        $task = TaskModel::findOrFail($id);
        $task->update([
            'id_category' => $sub_task->id_category,
            'user_id' => Auth::id(),
            'name' => $request->deskripsi,
            'tgl_mulai' => $request->tanggal_mulai,
            'tgl_selesai' => $request->tanggal_berakhir,
        ]);
        return response()->json($task);
    }

    public function destroy($id)
    {
        $task = TaskModel::findOrFail($id);
        $task->delete();
        return response()->json(['message' => 'Tugas Berhasil Dihapus']);
    }
}
