<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class filetable extends Model
{
    Use HasFactory;
    protected $fillable=['file-name','file-type','file-path','file-size','userName'];
}
