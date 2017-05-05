<?php

namespace FlexCMS\BasicCMS\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Directory extends Model
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'directories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'name',
    	'hash',
    	'short_description',
    	'description',
    	'category_id',
    	'logo_id',
    	'phones',
    	'websites',
    	'address',
    	'emails',
    	'latitude',
    	'longitude',
    	'is_active',
    	'created_by',
    	'updated_by',
    	'deleted_by',
        'social_issues',
        'main_activities',
        'impact',
        'solutions',

        'appreviation',
        'background',
        'vision',
        'mission',
        'goal'
    ];

    protected $dates = ['deleted_at'];

    /**
     * Get the user's first name.
     *
     * @param  string  $value
     * @return string
     */
    public function getLocaleAttribute($value)
    {
        if ($value && is_string($value)){
            try{
                return json_decode($value);    
            }
            catch(\Exception $e){
                return $value;
            }
            
        }
        else{
            return $value;
        }
    }

    // public function photos(){
    //     return $this->morphMany('FlexCMS\BasicCMS\Models\Media', 'imagable');
    // }

    public function photos(){
        return $this->hasMany('FlexCMS\BasicCMS\Models\Media', 'imagable_id')->where('imagable_type', '=', 'Directory')->where('type', '=', 'gallery');
    }

    public function category(){
        return $this->belongsTo('FlexCMS\BasicCMS\Models\Item','category_id');
    }

    public function logo(){
        return $this->belongsTo('FlexCMS\BasicCMS\Models\Media','logo_id');
    }

    /**
     * The roles that belong to the user.
     */
    public function categories()
    {
        return $this->belongsToMany('FlexCMS\BasicCMS\Models\Item', 'directory_categories', 'directory_id', 'category_id');
    }

    public function users()
    {
        return $this->belongsToMany('FlexCMS\BasicCMS\Models\User', 'directory_users', 'directory_id', 'user_id');
    }
}   
