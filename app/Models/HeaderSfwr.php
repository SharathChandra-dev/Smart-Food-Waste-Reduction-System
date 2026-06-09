<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeaderSfwr extends Model
{
    protected $table = 'headers_sfwr';

    protected $primaryKey = 'id_header_sfwr';

    protected $fillable = [
        'page_type_sfwr',
        'heading_sfwr'
    ];
}