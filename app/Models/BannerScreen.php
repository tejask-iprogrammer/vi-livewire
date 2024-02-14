<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Cache;

class BannerScreen extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'banner_screens';

    protected $fillable = [
        // 'name',
        // 'email',
        // 'password',
        // 'last_login_at',
        // 'last_login_ip',
        // 'profile_photo_path',
        // 'username',
        // "user_type_id",
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        // 'password',
        // 'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        // 'email_verified_at' => 'datetime',
        // 'last_login_at' => 'datetime',
    ];

    // public function getProfilePhotoUrlAttribute()
    // {
    //     if ($this->profile_photo_path) {
    //         return asset('storage/' . $this->profile_photo_path);
    //     }

    //     return $this->profile_photo_path;
    // }

    // public function addresses()
    // {
    //     return $this->hasMany(Address::class);
    // }

    // public function getDefaultAddressAttribute()
    // {
    //     return $this->addresses?->first();
    // }
    public function bannerScreenData(){

        // temporarly removed cache code

        // Cache::tags(BannerScreen::table())->flush();
        // $cacheKey = str_replace(['\\'], [''], __METHOD__) . ':' . md5(json_encode($params));
        //Cache::tags not suppport with files and Database
        // $response = Cache::tags(BannerScreen::table())->remember($cacheKey, $this->ttlCache, function() {
            return BannerScreen::orderBY('id')->orderBy('updated_at', 'desc')->pluck('screen_title as screen_name','id')->toArray();
        // });
    }
}
