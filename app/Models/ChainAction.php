<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChainAction extends Model
{
    use HasFactory;

    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'chain_action';

   /**
    * The attributes that are mass assignable.
    *
    * @var array<int, string>
    */
    protected $fillable = [
       'installation_id',
       'vehicle_id',
       'user_id',
       'install_chain'
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
