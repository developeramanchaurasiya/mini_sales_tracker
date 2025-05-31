<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\User;


class ServiceController extends Controller
{
        public function index()
        {
            $services = Service::paginate(10);
            return view('services.index', compact('services'));
        }
}
