<?php

namespace App;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Post;
use App\Comment;
use App\Subscription;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements JWTSubject, MustVerifyEmail
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'type', 'membership_type', 'gym_id', 'profile_picture'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class)->withTrashed();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function isAdmin()
    {
        return $this->type == 0; 
    }

    public function subscriptions()
    {
        return $this->hasMany('App\Subscription');
    }

    public function reservations()
    {
        return $this->hasMany('App\Reservation');
    }

    public function subscription()
    {
        return $this->hasOne('App\Subscription')->latest();
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function gym() {
        return $this->belongsTo('App\Gym')->withTrashed();
    }

    public function isPremium() {
        $subscription = $this->subscription;

        if ($this->isAdmin()) {
            return true;
        } else {
            $is_subscribed = ($subscription && $subscription->status === "Approved" && $subscription->date_expired >= Carbon::now());
            $is_free_trial = $this->created_at->addMonth() >= Carbon::now();
            return $is_free_trial || $is_subscribed;
        }
    }

    public function isPostable() {
        return (count($this->posts) < 10) || $this->isPremium();
    }

    public function ads() {
        return $this->hasMany('App\Ad');
    }

    public function audits()
    {
        return $this->hasMany('App\Audit');
    }
}
