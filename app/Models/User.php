<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    const ADMIN_ROLE = 1;
    const EDITOR_ROLE = 2;
    const MEMBER_ROLE = 3;
    const DEFAULT_ROLE = self::MEMBER_ROLE;
    const ROLES = [
        self::ADMIN_ROLE => "Admin",
        self::EDITOR_ROLE => "Editor",
        self::MEMBER_ROLE => "Member"
    ];
    public function canAccessPanel(Panel $panel): bool
    {
        // fillament alt
        // return $this->can("viewAdminPanel", User::class);
        // return $this->can("view-admin-panel", User::class);
        return $this->isAdmin() || $this->isEditor();
    }
    public function isAdmin()
    {
        return $this->role === self::ADMIN_ROLE;
    }
    public function isEditor()
    {
        return $this->role === self::EDITOR_ROLE;
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'role',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    public function likes()
    {
        return $this->belongsToMany(Post::class, "post_like")->withTimestamps();
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function hasLiked(Post $post)
    {
        return $this->likes()->where("post_id", $post->id)->exists();
    }
}
