<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrescriptionDetail extends Model
{
    use HasFactory;

    protected $table = 'prescription_details';
    protected $primaryKey = 'detail_id';

    public $timestamps = false;

    protected $fillable = [
        'medical_record_id',
        'medicine_name',
        'dosage',
        'quantity',
        'usage_instructions'
    ];
}