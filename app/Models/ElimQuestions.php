<?php

namespace App\Models;

use App\Models\ModelUtils;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ElimQuestions extends Model
{
    use HasFactory;
    use HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'question',
        'choice_1',
        'choice_2',
        'choice_3',
        'choice_4',
        'answer',
    ]; 

    /**
     * Rules that applied in this model
     *
     * @var array
     */
    public static function validationRules()
    {
        return [
            'question' => 'required|string',
            'choice_1' => 'required|string',
            'choice_2' => 'required|string',
            'choice_3' => 'required|string',
            'choice_4' => 'required|string',
            'answer' => 'required|string'
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
            'question.required' => 'Pertanyaan harus diisi',
            'question.string' => 'Pertanyaan harus berupa string',
            'choice_1.required' => 'Pilihan 1 harus diisi',
            'choice_1.string' => 'Pilihan 1 harus berupa string',
            'choice_2.required' => 'Pilihan 2 harus diisi',
            'choice_2.string' => 'Pilihan 2 harus berupa string',
            'choice_3.required' => 'Pilihan 3 harus diisi',
            'choice_3.string' => 'Pilihan 3 harus berupa string',
            'choice_4.required' => 'Pilihan 4 harus diisi',
            'choice_4.string' => 'Pilihan 4 harus berupa string',
            'answer.required' => 'Jawaban harus diisi',
            'answer.string' => 'Jawaban harus berupa string'
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
        return 'App\Http\Controllers\ElimQuestionsController';
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

    public function history()
    {
        return $this->hasMany(ElimQuestionHistory::class, 'id_question', 'id');
    }
}
