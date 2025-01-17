<?php
namespace App;

use Illuminate\Database\Eloquent\Builder;

class Story extends Post
{
    public $table = 'posts';
    public static function boot()
    {
        static::creating(function($model){
            $model->primary_term_id = 2;
            $model->type = 'post:story';
        });
        static::updating(function ($model) {
            if(!$model->getAttribute('order'))
            {
                $model->order = $model->getOriginal('order');
            }
        });
        static::addGlobalScope('exclude_deleted', function (Builder $builder) {
            $builder->where('type', 'post:story');
        });
        parent::boot();
    }
}
