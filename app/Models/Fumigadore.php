<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fumigadore extends Model
{
    use HasFactory;
    protected $fillable=[
        "nombrecompleto",
        "fechanacimiento",
        "certificacion",];
}
