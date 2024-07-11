<?php

namespace App\Models;

use App\Models\ModelUtils;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ElimGamesHistory extends Model
{
    use HasFactory;
    use HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable =[

        'game_id',
        'team_id',
        'rotation'
    
    ]; 

    /**
     * Rules that applied in this model
     *
     * @var array
     */
    public static function validationRules()
    {
        return [
            'game_id' => 'required|exists:elim_games,id',
            'team_id' => 'required|uuid|exists:teams,id',
            'rotation' => 'required'
        ];
    }

    /**
     * Messages that applied in this model
     *
     * @var array
     */
    public static function validationMessages()
    {
        return [
            'game_id.required' => 'Game id harus diisi',
            'game_id.exists' => 'Game id tidak ditemukan',
            'team_id.required' => 'Team id harus diisi',
            'team_id.uuid' => 'Team id harus berupa UUID',
            'team_id.exists' => 'Team id tidak ditemukan',
            'rotation.required' => 'Rotation harus diisi'
        ];
    }

    /**
     * Filter data that will be saved in this model
     *
     * @var array
     */
    public function resourceData($request)
    {
        return ModelUtils::filterNullValues([]);
    }


    /**
     * Controller associated with this model
     *
     * @var string
     */

    public function controller()
    {
        return 'App\Http\Controllers\ElimGamesHistoryController';
    }

    /**
    * Relations associated with this model
    *
    * @var array
    */
    public function relations()
    {
        return [];
    }

    /**
    * Space for calling the relations
    *
    *
    */
    public function teams()
    {
        return $this->belongsTo(Team::class, 'team_id', 'id');
    }

    public function games()
    {
        return $this->belongsTo(ElimGames::class, 'game_id', 'id');
    }
}
