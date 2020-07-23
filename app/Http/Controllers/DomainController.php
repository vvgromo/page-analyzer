<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DomainController extends Controller
{
    public function add(Request $request)
    {
        $queryDomain = $request->get('domain');
        $parsedDomain = parse_url($queryDomain['name']);
        $domain = mb_strtolower("{$parsedDomain['scheme']}://{$parsedDomain['host']}");
        $hasDomain = DB::table('domains')
            ->where('name', $domain)
            ->exists();
        if (!$hasDomain) {
            DB::table('domains')->insert(
                [
                    'name' => $domain,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]
            );
        }
        return var_dump($domain);
    }
}
