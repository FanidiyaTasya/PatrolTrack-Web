<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model {
    use HasFactory;

    protected $guarded = ['id'];
    public $timestamps = false;

    public function report() {
        return $this->hasMany(Report::class);
    }
}
    