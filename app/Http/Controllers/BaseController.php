<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BaseController extends Controller
{
    /**
     * The model instance.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */

    public $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Display a listing of the resource with the filter applied.
     * @return array|object list of all resource in the model
     */
    public function getAll($filter = [])
    {
        if(!empty($filter)){
            return $this->model
            ->with($this->model->relations())
            ->where($filter)->get();
        }

        return $this->model
        ->with($this->model->relations())->get();
    }


    /**
     * Display a listing of the resource by Id
     * @return array|object list of all resource in the model
     */
    public function getById($id)
    {
        return $this->model
        ->with($this->model->relations())
        ->find($id);
    }

    /**
     * get validation rules
     * @return array of validation Rules
     */
    public function getValidationRules()
    {
        return $this->model->validationRules();
    }

    /**
     * get validation rules
     * @return array of validation Message
     */
    public function getValidationMessages()
    {
        return $this->model->validationMessages();
    }

    /**
     * Store a newly created resource in storage.
     * @return array|object created resource|error
     */
    public function store(Request $request)
    {
        $requestFillable = $request->only($this->model->getFillable());

        $valid = Validator::make($requestFillable, $this->model->validationRules(), $this->model->validationMessages());
        if($valid->fails()){
            return ['error' => $valid->errors()];
        }

        return $this->model->create($requestFillable);
    }

    /**
     * Find or Create a new Resource of model
     * @return array|object resource|error
     */
    public function firstOrCreate(Request $request)
    {
        $requestFillable = $request->only($this->model->getFillable());

        $valid = Validator::make($requestFillable, $this->model->validationRules(), $this->model->validationMessages());
        if($valid->fails()){
            return ['error' => $valid->errors()];
        }

        return $this->model->firstOrCreate($requestFillable);
    }

    /**
     * Update Resource
     * @return array|object updated resource
     */
    public function update(Request $request, $id)
    {
        $requestFillable = $request->only($this->model->getFillable());

        $valid = Validator::make($requestFillable, $this->model->validationRules(), $this->model->validationMessages());
        if($valid->fails()){
            return ['error' => $valid->errors()];
        }

        $update = $this->model->find($id);
        if(!$update){
            return ['error' => 'Id not Found!!'];
        }

        $update->update($requestFillable);

        return $update;
    }

    /**
     * Update Resource Partially
     * @return array|object updated resource
     */
    public function updatePartial($data,$id)
    {
        $model = $this->model->find($id);
        if(!$model){
            return ['error' => 'Id not Found!!'];
        }
        foreach($data as $key => $val){
            $model->{$key} = $val;    
        }
        $model->save();

        return $model->refresh();
    }

    /**
     * Remove the specified resource from storage.
     * @return array message either error or success (key)
     */
    public function delete($id)
    {
        $delete = $this->model->find($id);
        if(!$delete){
            return ['error' => 'Id not Found!!'];
        }        
        $delete->delete();

        return ['success' => 'Deleted Successfully!!'];
    }
}
