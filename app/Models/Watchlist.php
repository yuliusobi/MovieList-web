<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Watchlist extends Model
{
    use HasFactory;

    protected $guarded =['id'];

    protected $with =['movie','user'];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['status'] ?? false, function($query, $status) {
            if ($status == 'All') {
                return;
            }else{
                return $query->where('status',$status);
            }
        });

        $query->when($filters['search'] ?? false, function($query, $movie) {
            return $query->whereHas('movie',function($query) use ($movie){
                $query->where('title', 'like', '%' . $movie . '%');
            });
        });
    }


    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
