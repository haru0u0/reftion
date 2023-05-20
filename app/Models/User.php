<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

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

    public function getLoginUser_token()
    {
        $raw_login_user_notion_token = DB::table('users')->where('id', Auth::user()->id)->value('notion_token');
        if ($raw_login_user_notion_token == null) {
            $login_user_notion_token = null;
        } else {
            $login_user_notion_token = Crypt::decryptString(DB::table('users')->where('id', Auth::user()->id)->value('notion_token'));
        }
        return $login_user_notion_token;
    }

    public function getLoginUser_dbid()
    {
        $raw_login_user_notion_dbid = DB::table('users')->where('id', Auth::user()->id)->value('notion_dbid');
        if ($raw_login_user_notion_dbid == null) {
            $login_user_notion_dbid = null;
        } else {
            $login_user_notion_dbid = Crypt::decryptString(DB::table('users')->where('id', Auth::user()->id)->value('notion_dbid'));
        }
        return $login_user_notion_dbid;
    }

    public function getGuestUser_email()
    {
        $guest_user_notion_email = env('GUEST_USER_EMAIL');
        //DB::table('users')->where('email', 'guest@example.com')->value('email');
        return $guest_user_notion_email;
    }

    public function getGuestUser_token()
    {
        $guest_user_notion_token = env('GUEST_USER_TOKEN');
        //Crypt::decryptString(DB::table('users')->where('email', 'guest@example.com')->value('notion_token'));
        return $guest_user_notion_token;
    }

    public function getGuestUser_dbid()
    {
        $guest_user_notion_dbid  = env('GUEST_USER_DBID');
        //Crypt::decryptString(DB::table('users')->where('email', 'guest@example.com')->value('notion_dbid'));
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
        'email',
        'lastlogin_at',
        'created_at',
        'updated_at',
        'notion_token',
        'notion_dbid',
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
