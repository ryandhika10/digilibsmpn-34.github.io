<?php

namespace App\Http\Controllers\Petugas\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return view('petugas/data-blog/tag/index');
    }
}
