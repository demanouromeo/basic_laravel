<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = ['note', 'user_id'];/*this indicate what field to take from associative
                    array when creating the note - in our case, this is used in the method store of NoteController*/
}
