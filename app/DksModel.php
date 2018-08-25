<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Project;
use App\ProjectHistorisation;
use Mail;
use DB;

class DKsModel extends Model
{

    protected $name;

	/*protected static function makeHistorisationProject($short_code, $primaryKey = "short_code")
    {

        // recuperation du project 
        $project = Project::where($primaryKey, $short_code)->first();

        // recuperation du dernier project de l'historisation 
        $projectHistorisation = ProjectHistorisation::where('project_id', $project->id)->orderBy('created_at', 'DESC')->first();
        
        // recuperation de l'objet 
        $classe_name_obj = $project->{self::$name};

        // duplication dans la table concerne
        $class_name = "\\App\\".ucfirst(self::$name);
        $classe_name::create($classe_name_obj->toArray());

        // ajout de la cle de l'historisation
        $classe_name_obj->project_historisation_id = $projectHistorisation->id;
        $classe_name_obj->save();

        return $classe_name_obj;
    }*/

    /*public static function saveHistorisation($request, $short_code)
    {
        DB::beginTransaction();
        try {
            // recuperation des informations du project
            $project = Project::where('short_code', $short_code)->first();

            // on vérifie si nous avons une modification 
            if(!$project->isModification())
            {
                return 2;
            }
            
            // historisation du project
            $projecthistorisation = ProjectHistorisation::create([
                                            'id' => uniqid(), 
                                            'project_id' => $project->id,
                                            'libelle' =>$request->name,
                                            'description' =>$request->description,
                                            "date_envoi" => date("Y-m-d H:i:s")
                                        ]);

        
            // on change l'etat du project
            if($projecthistorisation)
            {
                $project->etat_project_id = 4;
                $project->save();
            }
            
            $project->makeHistorisation($projecthistorisation);

            // generation du fichier word et envoi au ptf
            $this->createDocument($projecthistorisation->id);

            // envoi de mail au bayeur
            Mail::send('emails.email', ['title' => "ddd", 'content' => "dss"], function ($message) use($project)
            {

                $message->from($project->ong->user->email, 'Christian Nwamba');
                $message->to($project->ong->bayeur->user->email);
                $message->subject('Bonjour, vous avez recu un rapport de la part de l\'ong '.$project->ong->user->name);

            });

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return False;
        }

        return 0;
    }*/

    public static function createDocument($file_name)
    {
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $section = $phpWord->addSection();
        //$text = $section->addText($request->get('name'));
        $text = $section->addText("salut les zeros");
        //$text = $section->addText($request->get('email'));
        //$text = $section->addText($request->get('number'),array('name'=>'Arial','size' => 20,'bold' => true));
        //  $section->addImage("./images/Krunal.jpg");
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, self::FORMAT_DOC);
        Storage::disk('local')->makeDirectory(self::RAPPORTS_DIRECTORY);
        $chemin_relatif = 'app/'.self::RAPPORTS_DIRECTORY.'/'.$file_name.'.'.self::DOCUMENT_EXTENSION;
        echo $objWriter->save(storage_path($chemin_relatif));
        //Storage::disk('local')->put('doc.docx', '');
        //return response()->download(public_path('doc.docx'));
    }

    /*public function haveYouHistorisation(){
        try {
            // recuperation de l'historisation 
            $projectHistorisation = ProjectHistorisation::where('project_id', $this->project->id)->get()->reverse()->first();

            $classe_name = "\\App\\".ucfirst($this->name);

            if($projectHistorisation && !$classe_name::where('project_historisation_id', $projectHistorisation->id)->first()){
                return True;
            }
        } catch (Exception $e) {
            // trait exception
        }

        return False;
    }*/

    public function createModel($request, $project)
    {
        $classe_name_instance = "\\App\\".ucfirst($this->name);

        $classe_name_instance::create([
                                'project_id' => $project->id, 
                                'content'    => $request->content
                            ]);

        // on change le status de project on le passant en mode modification
        $project->is_modification = 1;
        $project->save();
    }

    public function updateModel($request)
    {
        $classe_name_instance = "\\App\\".ucfirst($this->name);

        // recuperation du project
        $project = $this->project;

        // update or create context for this project
        if($project->{$this->name}){
            $classe_name_instance::where('project_id', $project->id)
                          ->whereNull('project_historisation_id')
                          ->orderBy('created_at', 'DESC')
                          ->first()
                          ->update(['content' => $request->content]);
        }

        // on change le status de project on le passant en mode modification
        $project->is_modification = 1;
        $project->save();
    }

    // permet de vérifier si nous avons des modifications au niveau de l'object
    public function isChanged($content){
        return $this->project->{$this->name}->content !== $content;
    }
}
