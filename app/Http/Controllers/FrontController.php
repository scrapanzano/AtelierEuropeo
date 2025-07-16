<?php

namespace App\Http\Controllers;

use App\Models\DataLayer;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function getHome() {
        
        $dl = new DataLayer();
        $featuredProjects = $dl->getFeaturedProjects();
        $randomTestimonials = $dl->getRandomTestimonials(3);
        return view('index')
            ->with('featuredProjects', $featuredProjects)
            ->with('randomTestimonials', $randomTestimonials);
    }

    public function getAbout() {
        return view('about');
    }
}
