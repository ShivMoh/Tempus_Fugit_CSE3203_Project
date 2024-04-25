<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Monkey;

class MonkeyController extends Controller
{
    public function index() {

        $monkey = new Monkey([
            'name'=>'testing',
            'banana_count'=>10,
            'max_power'=>20
        ]);
        $monkey->save();

        return view('monkey');
    }
}
