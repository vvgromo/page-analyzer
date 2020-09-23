<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class DomainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $domains = DB::table('domains')->get();
        $lastChecks = DB::table('domain_checks')
            ->select('created_at', 'domain_id')
            ->orderByDesc('created_at')
            //->distinct('domain_id')
            ->get();
//            ->select(DB::raw('domain_id, max(created_at) as last_check'))
//            ->groupBy('domain_id')
//            ->get()
//            ->keyBy('domain_id');
        dump($lastChecks);
//        $domainsView = $domains->map(function ($domain) use ($lastChecks) {
//            return [
//               'id' => $domain->id,
//               'name' => $domain->name,
//               'last_check' =>
//           ]
//        });
        return view('domains.index', ['domains' => $domains]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('welcome');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), ['domain' => 'required|url']);
        if ($validator->fails()) {
            flash('Not a valid url')->error();
            return redirect()->route('create');
        }
        $domain = $request->get('domain');
        $parsedDomain = parse_url($domain);
        $domainName = mb_strtolower(join("://", [$parsedDomain["scheme"], $parsedDomain["host"]]));
        $hasDomain = DB::table('domains')
            ->where('name', $domainName)
            ->exists();
        if (!$hasDomain) {
            DB::table('domains')->insert(
                [
                    'name' => $domainName,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]
            );
            flash('Url has been added');
        } else {
            flash('Url already exists');
        }
        $id = DB::table('domains')->where('name', $domainName)->first()->id;
        return redirect()->route('show', ['id' => $id]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $domain = DB::table('domains')->where('id', $id)->first();
        if (!$domain) {
            return abort(404);
        }
        $domainChecks = DB::table('domain_checks')
            ->where('domain_id', $id)
            ->orderByDesc('id')
            ->get();

        return view('domains.show', ['domain' => $domain, 'domainChecks' => $domainChecks]);
    }
}
