<?php

namespace App\Http\Controllers;

use App\Models\SubTask;
use App\Models\TaskModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    //methode untuk menampilkan data task
    public function ShowTask(){
        $task = TaskModel::with('subTasks')->get();
        $sub_task = SubTask::latest()->get();
        return view('dashboard', compact('task', 'sub_task'));
    }


    //methode function untuk melakukan aksi insert
    public function TaskStore(Request $request){
        $sub_task=SubTask::where('id_category',$request->category)->first();
        TaskModel::insert([
            'id_category'=>$sub_task->id_category,
            'user_id'=>Auth::id(),
            'name'=>$request->deskripsi,
            'tgl_mulai'=>$request->tanggal_mulai,
            'tgl_selesai'=>$request->tanggal_berakhir,
        ]);
        $notification = array(
            'message'=>'Tugas Berhasil ditambahkan',
            'alert-type'=>'success',
        );
        return redirect()->route('dashboard')->with($notification);
    }

    //methode function untuk melakukan aksi update data tugas
    public function UpdateTask(Request $request){
        $id=$request->id;
        $sub_task=SubTask::where('id_category',$request->category)->first();

        TaskModel::findOrFail($id)->update([
            'id_category'=>$sub_task->id_category,
            'user_id'=>Auth::id(),
            'name'=>$request->deskripsi,
            'tgl_mulai'=>$request->tanggal_mulai,
            'tgl_selesai'=>$request->tanggal_berakhir,
        ]);

        $notification = array(
            'messsage'=>'Data Tugas berhasil di Ubah',
            'alert-type'=>'success',
        );
        return redirect()->route('dashboard')->with($notification);
    }

    //methode function untuk melakukan aksi hapus data
    public function DeleteTask($id) {
        $task= TaskModel::findOrFail($id);
        TaskModel::findOrFail($id)->delete();

        $notification = array(
            'message'=>'Data berhasil dihapus',
            'alert-type'=>'success',
        );
        return redirect()->back()->with($notification);
    }

    public function Destroy(Request $request){
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }


    /*Endpoint API */


}
