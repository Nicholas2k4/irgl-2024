<?php

namespace App\Models;

use App\Models\ModelUtils;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;


class ElimStatistics extends Model
{
    use HasFactory;
    use HasUuids;
    use HasApiTokens;
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable=[
        'id_team',
        'start_time',
        'end_time',
        'won_grand_prize',
        'highest_gp_streak',
        'highest_streak',
        'total_score',
        'total_game_finished',
    
    ]; 

    /**
     * Rules that applied in this model
     *
     * @var array
     */
    public static function validationRules()
    {
        return [
            'id_team' => 'required|uuid|exists:teams,id',
            'start_time' => 'nullable',
            'end_time' => 'nullable',
            'won_grand_prize' => 'required',
            'highest_gp_streak' => 'required',
            'highest_streak' => 'required',
            'total_score' => 'required',
            'total_game_finished' => 'required',
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
            'id_team.required' => 'id_team is required',
            'id_team.uuid' => 'id_team must be a valid UUID',
            'id_team.exists' => 'id_team does not exist',
            'start_time.nullable' => 'start_time must be a valid date',
            'end_time.nullable' => 'end_time must be a valid date',
            'won_grand_prize.required' => 'won_grand_prize is required',
            'highest_gp_streak.required' => 'highest_gp_streak is required',
            'highest_streak.required' => 'highest_streak is required',
            'total_score.required' => 'total_score is required',
            'total_game_finished.required' => 'total_game_finished is required',
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
        return 'App\Http\Controllers\ElimStatisticsController';
    }

    /**
    * Relations associated with this model
    *
    * @var array
    */
    public function relations()
    {
        return ['team'];
    }

    /**
    * Space for calling the relations
    *
    *
    */
    public function team()
    {
        return $this->belongsTo(Team::class, 'id_team', 'id');
    }
}
