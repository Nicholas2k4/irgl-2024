<?php

namespace App\Models;

use App\Models\ModelUtils;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ElimGames extends Model
{
    use HasFactory;
    use HasUuids;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'game_name',
        'game_link'
    ]; 

    /**
     * Rules that applied in this model
     *
     * @var array
     */
    public static function validationRules()
    {
        return [
            'game_name' => 'required|string',
            'game_link' => 'required|string'
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
            'game_name.required' => 'Nama game harus diisi',
            'game_name.string' => 'Nama game harus berupa string',
            'game_link.required' => 'Link game harus diisi',
            'game_link.string' => 'Link game harus berupa string'
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
        return 'App\Http\Controllers\ElimGamesController';
    }

    /**
    * Relations associated with this model
    *
    * @var array
    */
    public function relations()
    {
        return ['teams'];
    }

    /**
    * Space for calling the relations
    *
    *
    */

    public function teams(){
        return $this->belongsToMany(Team::class,'elim_scores', 'id_game', 'id_team')->withPivot('score','time');
    }

}
