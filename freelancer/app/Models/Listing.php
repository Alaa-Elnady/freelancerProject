<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


// All() and find() functions are exist in Model class that this model extends from it
class Listing extends Model
{
    use HasFactory;

    // protected $fillable = ['title' , 'company' , 'location' , 'email' , 'website' , 'description' , 'tags'];

    public function scopeFilter($query , array $Filters) {

        // If condition if we press any tag button to filter the listings by tags
        if($Filters['tag'] ?? false) {
            $query->where('tags' , 'like' , '%' . request('tag') . '%');
        }

        // If condition to filter the listings by the search value (titile , description , tag , ...)
        if($Filters['search'] ?? false) {
            $query->where('title' , 'like' , '%' . request('search') . '%')             // If condition if we search by title
                  ->orWhere('description' , 'like' , '%' . request('search') . '%')     // If condition if we search by description
                  ->orWhere('tags' , 'like' , '%' . request('search') . '%')            // If condition if we search by tags 
                  ->orWhere('company' , 'like' , '%' . request('search') . '%');        // If condition if we search by company 

        }
    }
}
