<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSubscriptionDetail extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'race', 'is_first_time_mother', 'child_dobs', 'date_of_birth', 'is_currently_pregnant', 'expected_due_date', 'number_of_children'];

    public function isFormCompleted()
    {
        return !is_null($this->race) &&
            !is_null($this->is_first_time_mother) &&
            !is_null($this->child_dobs) &&
            !is_null($this->date_of_birth) &&
            !is_null($this->is_currently_pregnant) &&
            !is_null($this->expected_due_date) &&
            !is_null($this->number_of_children);
    }
}
