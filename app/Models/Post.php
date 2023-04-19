<?php

namespace App\Models;

use App\Traits\DateTrait;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class Post extends Model
{
    use HasFactory;
    use Sluggable;
    use DateTrait;
    use \Encore\Admin\Traits\Resizable;

    protected $guarded = [];
    protected $casts = [
        'tags'=>'array',
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function scopeRubric($query){
        if(request('rubric')){
            $posts = DB::table('post_rubric')
                ->where('rubric_id',request('rubric'))
                ->get()
                ->pluck('post_id')
                ->toArray();

            return $query->whereIn('id',$posts);
        }
        return $query;

    }

    public function scopeSearch($query){
        if(request('search')){
            $search = request('search');

            return $query->where('title','LIKE',"%{$search}%");
        }
        return $query;
    }

    public function rubrics()
    {
        return $this->belongsToMany(Rubric::class,'post_rubric');
    }

    public function getDatePublicationAttribute(){
        $day = Carbon::parse($this->created_at)->format('j');
        $mounth = $this->getRUSMounts((integer)Carbon::parse($this->created_at)->format('n'));
        $years = Carbon::parse($this->created_at)->format('Y');
        return $day.' '.$mounth.' '.$years;
    }

    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }

}
