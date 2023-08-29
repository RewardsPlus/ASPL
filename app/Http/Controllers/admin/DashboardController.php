<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Analytics\Facades\Analytics;
use Spatie\Analytics\Period;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function dashboard(Request $req)
    {
        try {
            $period = Period::days(7);
            if (count($req->all()) > 0) {
                if ($req->filter == 1) {
                    $period = Period::days(7);
                } else if ($req->filter == 2) {
                    $startdate = Carbon::now()->subMonth();
                    $enddate = Carbon::now();
                    $period = Period::create($startdate, $enddate);
                } else if ($req->filter == 3) {
                    $startdate = Carbon::now()->subYear();
                    $enddate = Carbon::now();
                    $period = Period::create($startdate, $enddate);
                }
            }
            $analyticsData = []; //Analytics::fetchUserTypes($period);
            // return $analyticsData;
            $totalVisitorPageview = Analytics::fetchVisitorsAndPageViews($period);
            $bounce_rate = Analytics::get($period, ['bounceRate'])->first();
            $citywiseusers = Analytics::get($period, ['activeUsers'], ['city']);
            $avgspenttime = Analytics::get($period, ['engagedSessions'])->first();
            $devicewise = Analytics::get($period, ['activeUsers'], ['deviceCategory', 'operatingSystem']);
            $datewise = Analytics::get($period, ['activeUsers'], ['date']);
            // dd($datewise);
            $colors = ['danger', 'primary', 'warning', 'info'];
            $filter = $req->filter ?? '';
            return view('admin-panel.dashboard', compact('analyticsData', 'totalVisitorPageview', 'bounce_rate', 'citywiseusers', 'avgspenttime', 'devicewise', 'colors', 'datewise', 'filter'));
        } catch (\Exception $e) {
            return $e->getMessage();
            // return redirect()->route('admin.company.index');
        }
    }
}
