<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DependentController extends Controller
{
    public function destroy($id)
    {
        var_dump($id);
    }
}
