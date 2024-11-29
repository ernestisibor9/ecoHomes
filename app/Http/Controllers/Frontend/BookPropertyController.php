<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookPropertyController extends Controller
{
    // BookSearch
    public function BookSearch(){
        return view('frontend.book.book_search');
    }
}
