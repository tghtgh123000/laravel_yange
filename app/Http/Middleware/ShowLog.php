<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;

class ShowLog
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $start = microtime(true);

        DB::connection()->enableQueryLog();#开启执行日志
        \Log::info('======================Begin=======================');
        \Log::info('URL: ' . $request->url());
        \Log::info('INPUT: ' . json_encode($request->input() , 256));
        $rep = $next($request);
        $sqlLogs = DB::getQueryLog();
        foreach ($sqlLogs as $r){
            \Log::info('SQL: ' . vsprintf(str_replace('?', '%s', $r['query']), $r['bindings']) . ' # time: ' . $r['time']);
        }
        \Log::info('=== TAKE: ' . round( (microtime(true) - $start)  * 1000 ) . 'ms' );
        \Log::info('====================== End =======================' . "\n");
        return $rep;
    }
}
