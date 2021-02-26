<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentImage extends Model
{
    use HasFactory;
    protected $table = 'tb_document_images';
    protected $primaryKey = 'nIdx';
    public $timestamps = false;
    protected $fillable = ['nUserId', 'strImageType', 'strImageURL', 'strImageName', 'strFileName', 'bIsDel'];
    
}
