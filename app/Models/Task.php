<?php
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot(['status_id', 'due_date', 'remarks']);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
