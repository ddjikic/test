<?php

namespace App\Http\Controllers;

use App\Service\Analytics;
use DateInterval;
use DatePeriod;
use Illuminate\Http\Request;

class AnaliticsController extends Controller
{
    //
    var $analitics;

    public function __construct(Analytics $analytics)
    {
        $this->analitics = $analytics;
    }

    public function index(Request $request)
    {
        if (!empty($request['start'])) {
            $start =  \DateTime::createFromFormat('d/m/Y', $request['start']);
        } else {
            $start = new \DateTime('-30 days');
        }
        if (!empty($request['end'])) {
            $end =  \DateTime::createFromFormat('d/m/Y', $request['end']);
        } else {
            $end = new \DateTime('now');
        }
        $interval = DateInterval::createFromDateString('1 day');

        $period = new DatePeriod($start, $interval, $end);


        return view('analytics.index', [
            'websites' => $this->analitics->getWebsites(),
            'start' => $start->format('d/m/Y'),
            'end' => $end->format('d/m/Y'),
            'period' => $period,
            'stats' => $this->analitics->getStats($request->all(['website', 'start', 'end'])),
        ]);
    }

    public function tracker(Request $request)
    {
        $this->analitics->track($request);
        return response()->json([], 200);
    }
}
