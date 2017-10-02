<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Role;
use App\Models\UserRole;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'full_name', 'email', 'password', 'address', 'phone',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles(){
        return $this->belongsToMany('App\Models\Role','user_role_xref');
    }
    
    public function checkMod(){
        $listRole = UserRole::where('user_id', $this->id)->get();
        $flag = false;
        for ($i=0; $i < count($listRole); $i++) { 
            if($listRole[$i]->role_id >= ROLE_MODERATOR)
            {
                $flag = true;
                break;
            }
        }
        return $flag;
    }
}
