<?php

namespace App\Models\Companies;

use App\Models\Users\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'street_address',
        'country',
        'city',
        'house_no',
        'phone_no',
        'status',
        'vat_no',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function prettyAddress(){
//        return `$($this->house_no) $($this->street_address) $($this->city) $($this->country)`;
        return "$this->house_no $this->street_address $this->city $this->country";
    }
}
