<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function store()
    {
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $section = $phpWord->addSection();
        //$text = $section->addText($request->get('name'));
        $text = $section->addText("salut les zeros");
        //$text = $section->addText($request->get('email'));
        //$text = $section->addText($request->get('number'),array('name'=>'Arial','size' => 20,'bold' => true));
        $section->addImage("./images/Krunal.jpg");
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save('Appdividend.docx');
        return response()->downlorad(public_path('doc.docx'));
    }
}
