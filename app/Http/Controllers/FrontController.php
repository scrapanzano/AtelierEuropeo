<?php

namespace App\Http\Controllers;

use App\Models\DataLayer;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function getHome() {
        
        $dl = new DataLayer();
        $featuredProjects = $dl->getFeaturedProjects();
        return view('index')->with('featuredProjects', $featuredProjects);
    }

    public function getAbout() {
        return view('about');
    }
}
