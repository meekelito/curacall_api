<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cases extends Model
{
 	
  protected $fillable = [
    'case_id',
    'case_message',
    'created_by',
    'updated_by'
  ];

}
