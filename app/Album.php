<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'albums';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'name', 'publication_time', 'place', 'description', 'category', 'privacy_public', 'cover_photo',
    ];

    public function scopeNames($query, $name)
    {
        if ($name) {
            return $query->orWhere('name', 'like', "%$name%");
        }
    }

    public function scopeDescriptions($query, $description)
    {
        if ($description) {
            return $query->orWhere('description', 'like', "%$description%");
        }
    }

    public function scopePublicationTime($query)
    {
        return $query->where('publication_time', '>=', date('Y-m-d'));
    }
}
