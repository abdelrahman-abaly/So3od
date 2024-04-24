<?php

namespace App\Http\Controllers;

use App\Models\Workout;
use App\Trait\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WorkoutController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $workouts = Workout::get();
        return $this->returnData('workouts', $workouts);
    }
    public function __construct() {
        $this->middleware('auth:api-2', ['except' => ['index', 'show']]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name'=> 'required|max:255|unique:workouts',
                'description' => 'required',
                'goal' => 'required',
                'reps' => 'required',
                'sets' => 'required',
                'completed_sets' => 'required',
                'rest' => 'required',
                'weight' => 'required',
                'link' => 'required',
                'created_at',
                'updated_at'
            ]);

            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }

            $workout = Workout::create($request->all());

            if($workout){
                return $this->returnSuccessMessage('wourkout is saved');
            }

            return $this->returnError('E001', 'wourkout not saved');
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Workout  $workout
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $workout = Workout::find($request->id);

        if($workout){
            return $this->returnData('workout', $workout);
        }
        return $this->returnError('E001', 'The workout Not Found');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Workout  $workout
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Workout  $workout
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request )
    {
        try {
            $validator = Validator::make($request->all(), [
                'name'=> 'required|max:255',
                'description' => 'required',
                'goal' => 'required',
                'reps' => 'required',
                'sets' => 'required',
                'completed_sets' => 'required',
                'rest' => 'required',
                'weight' => 'required',
                'link' => 'required',
                'created_at',
                'updated_at'
            ]);

            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }

            $workout=Workout::find($request->id);

            if(!$workout){
                return $this->returnError('E001', 'The workout Not Found');
            }

            $workout->update($request->all());

            if($workout){
                return $this->returnSuccessMessage('wourkout is updated');
            }

        }catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Workout  $workout
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $workout=Workout::find($request->id);

        if(!$workout){
            return $this->returnError('E001', 'The workout Not Found');
        }

        $workout->delete($request->id);

        if($workout){
            return $this->returnSuccessMessage('The workout deleted');
        }


    }
}
