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

    public function getContact() {
        return view('contact');
    }

    public function getCorpoEuropeo() {
        return view('corpo-europeo-solidarieta');
    }

    public function getScambiGiovanili() {
        return view('scambi-giovanili');
    }

    public function getCorsiFormazione() {
        return view('corsi-formazione');
    }
}
