<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';

    protected $guarded = array('id');

    public $timestamps = false;

    public function getLoginUser()
    {
        $login_user = Auth::user();
        return $login_user;
    }

    public function getGuestUser_token()
    {
        $guest_user_notion_token = DB::table('users')->where('name', 'guest_user')->value('notion_token');
        return $guest_user_notion_token;
    }

    public function getGuestUser_dbid()
    {
        $guest_user_notion_dbid  = DB::table('users')->where('name', 'guest_user')->value('notion_dbid');
        return $guest_user_notion_dbid;
    }

    // public function getDBID()
    // {
    //   $dbid = DB::table($this->table)->where('id',Auth::id())->value('notion_dbid');
    //   return $dbid;
    // }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'notion_token',
        'notion_dbid'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
