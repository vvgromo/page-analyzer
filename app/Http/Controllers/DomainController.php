<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DomainController extends Controller
{
    public function add(Request $request)
    {
        $domain = $request->get('domain');
        DB::table('domains')->insert(
            ['name' => $domain]
        );
        return $domain['name'];
    }
}
