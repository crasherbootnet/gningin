<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\ProjectHistorisation;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /*protected function getProjectHistorisation($project)
    {
        $projectHistorisation = ProjectHistorisation::where('project_id', $project->id)->first();

        if($projectHistorisation->context)
        {
            return $projectHistorisation;
        }else{
            $projectsHistorisations = ProjectHistorisation::all();
            if(count($projectsHistorisations) > 2){
                return $projectsHistorisations[1];
            }
        }

        return null;
    }*/
}
