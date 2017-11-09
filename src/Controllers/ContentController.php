<?php
namespace Xpressengine\Plugins\OSSGAStats\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use XeFrontend;
use XePresenter;
use Xpressengine\Http\Request;
use Xpressengine\Plugins\OSSGAStats\Collections\C2TableCollection;
use Xpressengine\Plugins\OSSGAStats\Collections\PairCollection;
use Xpressengine\Plugins\OSSGAStats\Collections\TableCollection;
use Xpressengine\Plugins\GoogleAnalytics\Handler;

class ContentController extends Controller
{
    public function __construct(Handler $handler)
    {
        $this->middleware('ga_enabled');

        XePresenter::setSkinTargetId('oss_ga_stats');
    }

    public function time(Request $request, Handler $handler)
    {
        $startdate = $request->get('startdate') ?: Carbon::now()->now()->format('Y-m-d');

        $data = $handler->getData($startdate, $startdate, 'ga:visits', [
            'dimensions' => 'ga:hour'
        ]);

        $collection = new PairCollection($data);

        return XePresenter::make('time.time', [
            'collection' => $collection,
            'startdate' => $startdate,
        ]);
    }

    public function date(Request $request, Handler $handler)
    {
        $startdate = $request->get('startdate') ?: Carbon::now()->subDay(15)->format('Y-m-d');
        $enddate = $request->get('enddate') ?: Carbon::now()->format('Y-m-d');

        $data = $handler->getData($startdate, $enddate, 'ga:visits', [
            'dimensions' => 'ga:date'
        ]);

        $collection = new PairCollection($data);

        return XePresenter::make('time.date', [
            'collection' => $collection,
            'startdate' => $startdate,
            'enddate' => $enddate,
        ]);
    }

    public function month(Request $request, Handler $handler)
    {
        $startdate = $request->get('startdate') ?: Carbon::now()->subDay(15)->format('Y-m-d');
        $enddate = $request->get('enddate') ?: Carbon::now()->format('Y-m-d');

        $data = $handler->getData($startdate, $enddate, 'ga:visits', [
            'dimensions' => 'ga:month'
        ]);

        $collection = new PairCollection($data);

        return XePresenter::make('time.month', [
            'collection' => $collection,
            'startdate' => $startdate,
            'enddate' => $enddate,
        ]);
    }

    public function year(Request $request, Handler $handler)
    {
        $startdate = $request->get('startdate') ?: Carbon::now()->subDay(15)->format('Y-m-d');
        $enddate = $request->get('enddate') ?: Carbon::now()->format('Y-m-d');

        $data = $handler->getData($startdate, $enddate, 'ga:visits', [
            'dimensions' => 'ga:year'
        ]);

        $collection = new PairCollection($data);

        return XePresenter::make('time.year', [
            'collection' => $collection,
            'startdate' => $startdate,
            'enddate' => $enddate,
        ]);
    }

    public function term(Request $request, Handler $handler)
    {
        $startdate = $request->get('startdate') ?: Carbon::now()->subDay(15)->format('Y-m-d');
        $enddate = $request->get('enddate') ?: Carbon::now()->format('Y-m-d');

        $dayData = $handler->getData($startdate, $enddate, 'ga:visits', [
            'dimensions' => 'ga:day'
        ]);
        $monthData = $handler->getData($startdate, $enddate, 'ga:visits', [
            'dimensions' => 'ga:month'
        ]);
        $yearData = $handler->getData($startdate, $enddate, 'ga:visits', [
            'dimensions' => 'ga:year'
        ]);
        $weekData = $handler->getData($startdate, $enddate, 'ga:visits', [
            'dimensions' => 'ga:week'
        ]);
        $weekDayData = $handler->getData($startdate, $enddate, 'ga:visits', [
            'dimensions' => 'ga:dayOfWeek'
        ]);

        return XePresenter::make('time.term', [
            'dCollection' => new PairCollection($dayData),
            'mCollection' => new PairCollection($monthData),
            'yCollection' => new PairCollection($yearData),
            'wCollection' => new PairCollection($weekData),
            'wdCollection' => new PairCollection($weekDayData),
            'startdate' => $startdate,
            'enddate' => $enddate,
        ]);
    }

    public function hour(Request $request, Handler $handler)
    {
        $startdate = Carbon::now()->subDay(15)->format('Y-m-d');
        $enddate = Carbon::now()->format('Y-m-d');
        $unit = $request->get('unit') ?: 'date';

        $data = $handler->getData($startdate, $enddate, 'ga:visits',[
            'dimensions' => 'ga:'.$unit.',ga:hour'
        ]);

        $collection = new TableCollection($data);


        return XePresenter::make('time.hour', [
            'collection' => $collection,
            'startdate' => $startdate,
            'enddate' => $enddate,
            'unit' => $unit,
        ]);
    }

    public function region(Request $request, Handler $handler)
    {
        $startdate = $request->get('startdate') ?: Carbon::now()->subDay(15)->format('Y-m-d');
        $enddate = $request->get('enddate') ?: Carbon::now()->format('Y-m-d');
        $unit = $request->get('unit') ?: 'date';

        $data = $handler->getData($startdate, $enddate, 'ga:visits',[
            'dimensions' => 'ga:'.$unit.',ga:region'
        ]);

        $collection = new TableCollection($data);

        return XePresenter::make('region', [
            'collection' => $collection,
            'startdate' => $startdate,
            'enddate' => $enddate,
            'unit' => $unit,
        ]);
    }

    public function source(Request $request, Handler $handler)
    {
        $startdate = $request->get('startdate') ?: Carbon::now()->subDay(15)->format('Y-m-d');
        $enddate = $request->get('enddate') ?: Carbon::now()->format('Y-m-d');
        $unit = $request->get('unit') ?: 'date';

        $data = $handler->getData($startdate, $enddate, 'ga:visits', [
            'dimensions' => 'ga:'.$unit.',ga:source', 'sort' => 'ga:'.$unit.',-ga:visits',
        ]);

        $collection = new TableCollection($data);

        return XePresenter::make('traffic.source', [
            'collection' => $collection,
            'startdate' => $startdate,
            'enddate' => $enddate,
            'unit' => $unit,
        ]);
    }

    public function keyword(Request $request, Handler $handler)
    {
        $startdate = $request->get('startdate') ?: Carbon::now()->subDay(15)->format('Y-m-d');
        $enddate = $request->get('enddate') ?: Carbon::now()->format('Y-m-d');
        $unit = $request->get('unit') ?: 'date';

        $data = $handler->getData($startdate, $enddate, 'ga:visits', [
            'dimensions' => 'ga:'.$unit.',ga:keyword', 'sort' => 'ga:'.$unit.',-ga:visits',
        ]);

        $collection = new TableCollection($data);

        return XePresenter::make('traffic.keyword', [
            'collection' => $collection,
            'startdate' => $startdate,
            'enddate' => $enddate,
            'unit' => $unit,
        ]);
    }

    public function device(Request $request, Handler $handler)
    {
        $startdate = $request->get('startdate') ?: Carbon::now()->subDay(15)->format('Y-m-d');
        $enddate = $request->get('enddate') ?: Carbon::now()->format('Y-m-d');
        $unit = $request->get('unit') ?: 'date';

        $data = $handler->getData($startdate, $enddate, 'ga:visits', [
            'dimensions' => 'ga:'.$unit.',ga:deviceCategory', 'sort' => 'ga:'.$unit.',-ga:visits',
        ]);

        $collection = new TableCollection($data);

        return XePresenter::make('platform.device', [
            'collection' => $collection,
            'startdate' => $startdate,
            'enddate' => $enddate,
            'unit' => $unit,
        ]);
    }

    public function os(Request $request, Handler $handler)
    {
        $startdate = $request->get('startdate') ?: Carbon::now()->subDay(15)->format('Y-m-d');
        $enddate = $request->get('enddate') ?: Carbon::now()->format('Y-m-d');
        $unit = $request->get('unit') ?: 'date';

        $data = $handler->getData($startdate, $enddate, 'ga:visits', [
            'dimensions' => 'ga:'.$unit.',ga:operatingSystem,ga:operatingSystemVersion',
            'sort' => 'ga:'.$unit.',-ga:visits',
        ]);

        $collection = new C2TableCollection($data);

        return XePresenter::make('platform.os', [
            'collection' => $collection,
            'startdate' => $startdate,
            'enddate' => $enddate,
            'unit' => $unit,
        ]);
    }

    public function browser(Request $request, Handler $handler)
    {
        $startdate = $request->get('startdate') ?: Carbon::now()->subDay(15)->format('Y-m-d');
        $enddate = $request->get('enddate') ?: Carbon::now()->format('Y-m-d');
        $unit = $request->get('unit') ?: 'date';

        $data = $handler->getData($startdate, $enddate, 'ga:visits', [
            'dimensions' => 'ga:'.$unit.',ga:browser,ga:browserVersion',
            'sort' => 'ga:'.$unit.',-ga:visits',
        ]);

        $collection = new C2TableCollection($data);

        return XePresenter::make('platform.browser', [
            'collection' => $collection,
            'startdate' => $startdate,
            'enddate' => $enddate,
            'unit' => $unit,
        ]);
    }

    public function pv(Request $request, Handler $handler)
    {
        $startdate = $request->get('startdate') ?: Carbon::now()->subDay(15)->format('Y-m-d');
        $enddate = $request->get('enddate') ?: Carbon::now()->format('Y-m-d');
        $limit = $request->get('limit') ?: '20';

        $data = $handler->getData($startdate, $enddate, 'ga:pageviews', [
            'dimensions' => 'ga:pagePath',
            'sort' => '-ga:pageviews',
            'max-results' => $limit
        ]);

        return XePresenter::make('content.index', [
            'startdate' => $startdate,
            'enddate' => $enddate,
            'limit' => $limit,
            'data' => $data,
        ]);
    }

    public function detail(Request $request, Handler $handler)
    {
        $startdate = $request->get('startdate') ?: Carbon::now()->subDay(15)->format('Y-m-d');
        $enddate = $request->get('enddate') ?: Carbon::now()->format('Y-m-d');
        $path = rawurldecode($request->get('path') ?: '/');

        $data = $handler->getData($startdate, $enddate, 'ga:pageviews', [
            'dimensions' => 'ga:date',
            'filters' => 'ga:pagePath==' . $path
        ]);

        $collection = new PairCollection($data);

        return XePresenter::make('content.detail', [
            'collection' => $collection,
            'startdate' => $startdate,
            'enddate' => $enddate,
            'path' => $path,
        ]);
    }
}
