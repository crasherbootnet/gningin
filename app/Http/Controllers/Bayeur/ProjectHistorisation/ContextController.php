<?php

namespace App\Http\Controllers\Bayeur\ProjectHistorisation;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContextController extends Controller
{
    public function show($short_code){
        
        // recuperation du context du project
        $project = Project::where('short_code', $short_code)->first();
        $context = $project->context ?? null;

        return view('projects.context', ['context' => $context, 'project' => $project]);
    }
}
