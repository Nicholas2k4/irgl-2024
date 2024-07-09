<?php

namespace App\Models;

use App\Models\ModelUtils;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ElimQuestionHistory extends Model
{
    use HasFactory;
    use HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable= [
        'id_team',
        'id_question',
    ]; 

    /**
     * Rules that applied in this model
     *
     * @var array
     */
    public static function validationRules()
    {
        return [
            'id_team' => 'required|string',
            'id_question' => 'required|string',
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
            'id_team.required' => 'Id team harus diisi',
            'id_team.string' => 'Id team harus berupa string',
            'id_question.required' => 'Id question harus diisi',
            'id_question.string' => 'Id question harus berupa string',
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
        return 'App\Http\Controllers\ElimQuestionHistoryController';
    }

    /**
    * Relations associated with this model
    *
    * @var array
    */
    public function relations()
    {
        return [
            'team',
            'question'
        ];
    }

    /**
    * Space for calling the relations
    *
    *
    */
    public function team(){
        return $this->belongsTo(Team::class, 'id_team', 'id');
    }
    public function question(){
        return $this->belongsTo(ElimQuestions::class, 'id_question', 'id');
    }
}
