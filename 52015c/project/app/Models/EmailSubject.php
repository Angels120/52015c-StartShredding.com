<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailSubject extends Model
{
    protected $connection = 'mailserver';
    protected $table = 'email_subjects';
}
