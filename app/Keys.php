<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Keys extends Model
{
 	protected $table = 'api_keys';

  protected $fillable = [
    'api_key',
    'status'
  ];

}
