<?php

namespace App\Http\Controllers\Petugas\Ebook;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashEbookController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return view('petugas/data-ebook/index');
    }
}
