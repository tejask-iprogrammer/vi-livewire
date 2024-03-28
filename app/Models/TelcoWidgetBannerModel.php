<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class TelcoWidgetBannerModel extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'telco_widget_banners';

    protected $fillable = [
        "circle",
        "login_type",
        "brand",
        "plan",
        "prepaid_persona",
        "banner_title",
        "analytics_tag",
        "mrp",
        "internal_link",
        "external_link",
        "device_os",
        "app_version",
        "banner_rank",
        "status",
        "is_pack_expiry_near",
        "is_data_exhausted",
        "rail_title",
        "rail_view_all",
        "banner_name",
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
        // 'banner_screen'=>'array',
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

    // public function getBannerName(){
    //     return $this->belongsTo(BannerScreen::class,'banner_screen','id');
    // }
}
