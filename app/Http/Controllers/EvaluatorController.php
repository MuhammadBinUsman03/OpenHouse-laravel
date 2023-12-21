<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use App\Models\Group;
use App\Models\Admin;
use App\Models\Project;
use App\Models\Evaluator;

class EvaluatorController extends Controller
{
    public function index($evaluatorId){

        //Fetch all evaluations (Max 5) against this evaluatorID
        $evaluations = DB::table('evaluations')
        ->where('evaluator_id', $evaluatorId)
        ->take(5)
        ->get();

        $records = [];

        foreach ($evaluations as $evaluation) {
            $project = DB::table('projects')->where('project_id', $evaluation->project_id)->first();
            $record = [
                'project_id' => $project->project_id,
                'project_name' => $project->project_name,
                'project_details' => $project->project_details,
                'location' => $project->location_id,
                'evaluation_rating' => $evaluation->evaluation_rating !== null ? $evaluation->evaluation_rating : 'null'
            ];
            $records[] = $record;
        }

        return view('evaluator')->with('evaluatorId',$evaluatorId)->with('records', $records);
    }
    
    //Funtion to retrieve match project keywords and evaluator preferences and select top 5
    public function assignProjects($evaluatorId){
        
        //Get evaluator object
        $evaluator = Evaluator::find($evaluatorId);

        $preferencesArray = explode(' ', $evaluator->evaluator_preferences);

        $projects = DB::table('projects')->get(); // Retrieve all projects from the database

        $matchedProjects = [];

        foreach ($projects as $project) {
            $projectId = $project->project_id;
            $projectKeywords = explode(' ', $project->project_keywords);

            // Calculate similarity between preferences and project keywords
            $matchingKeywords = array_intersect($projectKeywords, $preferencesArray);
            $matchingScore = count($matchingKeywords);

            // Store project ID and matching score--
            $matchedProjects[] = [
                'project_id' => $projectId,
                'matching_score' => $matchingScore
            ];
        }

        // Sort the matched projects by matching score in descending order
        usort($matchedProjects, function ($a, $b) {
            return $b['matching_score'] <=> $a['matching_score'];
        });

        // Get Max 5 projects with the highest matching scores
        $topMatchedProjects = (count($matchedProjects) >= 5) ? array_slice($matchedProjects, 0, 5) : $matchedProjects;


        // Now fill the pivot table evaluation (Evaluator-Projects M2M relation) and keep the pivot column null currently
        foreach ($topMatchedProjects as $project) {
            //get projectId for attaching with evaluator
            $projectId = $project['project_id'];
            // Assuming $evaluator is an instance of Evaluator model
            $evaluator->project()->attach($projectId, ['evaluation_rating' => null]);
        }
        
        //Evaluation entries created , now route back to admin page
        return redirect()->route('admin');

    }

    public function updateRating(Request $request,$evaluatorId){

        // Retrieve form data
        $projectId = $request->input('project_id');
        $rating = $request->input('rating');

        DB::table('evaluations')
            ->where('evaluator_id', $evaluatorId)
            ->where('project_id', $projectId)
            ->update(['evaluation_rating' => $rating]);
        
        return redirect()->route('evaluator', ['evaluatorId' => $evaluatorId]);

    }
}
