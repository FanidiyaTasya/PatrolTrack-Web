<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model {
    use HasFactory;

    protected $guarded = ['id'];
    public $timestamps = false;

    public function attendance_record() {
        return $this->hasMany(AttendanceRecord::class);
    }
}