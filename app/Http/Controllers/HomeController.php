<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use App\HomeSlider;
use App\Service;
use App\Testimonial;
use App\Client;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Homepage Slide
        $homeSlides = HomeSlider::orderBy('order')->get();
        // Services
        $services = Service::get();
        //Testimonials
        $testimonials = Testimonial::get();
        // Clients
        $clients = Client::get();

        return view('home', compact('homeSlides','services','testimonials','clients'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showThankyou()
    {
        return view('thankyou');
    }

}
