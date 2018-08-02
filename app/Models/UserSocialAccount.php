<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserSocialAccount extends Model
{
    use SoftDeletes;

    protected $table = 'user_social_accounts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'provider_id',
        'provider_name',
        'name',
        'email',
        'agreed',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const AGREED_NG = 0;
    const AGREED_OK = 1;

    public static function forge()
    {
        return new static;
    }

    /**
     * リレーション
     *
     * @param
     * @return App\Models\User
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * データ取得
     *
     * @param Array 
     * @return Object
     */
    public static function find(array $attributes = [])
    {
        return static::where($attributes)->first();
    }

    /**
     * データ作成
     *
     * @param Array 
     * @return Object
     */
    public static function create(array $attributes = [])
    {
        $model = new static($attributes);
        $model->save();
        return $model;
    }

    /**
     * 作成 or 更新
     *
     * @param Array
     * @return Object
     */
    public function createOrUpdate(array $attributes = [])
    {
        if ($this->exists)
        {
            $this->fill($attributes)->save();
            $model = $this;
        }
        else
        {
            $model = new static($attributes);
            $model->save();
        }
        return $model;
    }
}
