<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestClass extends Model
{
    use HasFactory;
    protected $table = 'request_classes';
    protected $primaryKey = 'id';
    protected $timestamp = true;
    protected $guarded = [];
}
