<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Rule extends Model {
    protected $fillable = ['penyakit_id','gejala_id','mb','md'];
}
