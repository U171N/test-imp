<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskModel extends Model
{
    use HasFactory;
    protected $guarded=[];

    //relasi dengan kategori tugas
    public function subTasks() {
        return $this->hasMany(SubTask::class,'id_category','id_category');
    }

}
