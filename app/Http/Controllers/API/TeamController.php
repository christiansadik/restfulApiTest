<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Team;
use Validator;
use App\Http\Resources\Team as TeamResource;
   
class TeamController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teams = Team::all();
    
        return $this->sendResponse(TeamResource::collection($teams), 'Teams retrieved successfully.');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'name' => 'required',
            'country' => '',
            'value' => '',
            'salary_cap' => '',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $team = Team::create($input);
   
        return $this->sendResponse(new TeamResource($team), 'Team created successfully.');
    } 
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $team = Team::find($id);
  
        if (is_null($team)) {
            return $this->sendError('Team not found.');
        }
   
        return $this->sendResponse(new TeamResource($team), 'Team retrieved successfully.');
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'name' => 'required',
            'detail' => 'required'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $team->name         = $input['name'];
        $team->country      = $input['country'];
        $team->value        = $input['value'];
        $team->salary_cap   = $input['salary_cap'];
        $team->save();
   
        return $this->sendResponse(new TeamResource($team), 'Team updated successfully.');
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team)
    {
        $team->delete();
   
        return $this->sendResponse([], 'Team deleted successfully.');
    }
}