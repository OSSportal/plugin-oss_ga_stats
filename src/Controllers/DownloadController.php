<?php
namespace Xpressengine\Plugins\OSSGAStats\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Contracts\Routing\ResponseFactory;
use PHPExcel;
use PHPExcel_IOFactory;
use Xpressengine\Http\Request;
use Xpressengine\Plugins\OSSGAStats\Collections\C2TableCollection;
use Xpressengine\Plugins\OSSGAStats\Collections\PairCollection;
use Xpressengine\Plugins\OSSGAStats\Collections\TableCollection;
use Xpressengine\Plugins\GoogleAnalytics\Handler;

class DownloadController extends Controller
{
    public function __construct(Handler $handler)
    {
        $this->middleware('ga_enabled');
    }

    public function time(Request $request, Handler $handler)
    {
        $startdate = $request->get('startdate') ?: Carbon::now()->now()->format('Y-m-d');

        $data = $handler->getData($startdate, $startdate, 'ga:visits', [
            'dimensions' => 'ga:hour'
        ]);

        $collection = new PairCollection($data);

        return $this->download($collection, 'time');
    }

    public function date(Request $request, Handler $handler)
    {
        $startdate = $request->get('startdate') ?: Carbon::now()->subDay(15)->format('Y-m-d');
        $enddate = $request->get('enddate') ?: Carbon::now()->format('Y-m-d');

        $data = $handler->getData($startdate, $enddate, 'ga:visits',[
            'dimensions' => 'ga:date'
        ]);

        $collection = new PairCollection($data);

        return $this->download($collection, 'date');
    }

    public function month(Request $request, Handler $handler)
    {
        $startdate = $request->get('startdate') ?: Carbon::now()->subDay(15)->format('Y-m-d');
        $enddate = $request->get('enddate') ?: Carbon::now()->format('Y-m-d');

        $data = $handler->getData($startdate, $enddate, 'ga:visits',[
            'dimensions' => 'ga:month'
        ]);

        $collection = new PairCollection($data);

        return $this->download($collection, 'month');
    }

    public function year(Request $request, Handler $handler)
    {
        $startdate = $request->get('startdate') ?: Carbon::now()->subDay(15)->format('Y-m-d');
        $enddate = $request->get('enddate') ?: Carbon::now()->format('Y-m-d');

        $data = $handler->getData($startdate, $enddate, 'ga:visits',[
            'dimensions' => 'ga:year'
        ]);

        $collection = new PairCollection($data);

        return $this->download($collection, 'year');
    }

    public function term(Request $request, Handler $handler)
    {
        $startdate = $request->get('startdate') ?: Carbon::now()->subDay(15)->format('Y-m-d');
        $enddate = $request->get('enddate') ?: Carbon::now()->format('Y-m-d');
        $unit = $request->get('unit') ?: 'day';

        $data = $handler->getData($startdate, $enddate, 'ga:visits',[
            'dimensions' => 'ga:'.$unit
        ]);

        $collection = new PairCollection($data);

        return $this->download($collection, $unit);
    }

    public function hour(Request $request, Handler $handler)
    {
        $startdate = $request->get('startdate') ?: Carbon::now()->subDay(15)->format('Y-m-d');
        $enddate = $request->get('enddate') ?: Carbon::now()->format('Y-m-d');
        $unit = $request->get('unit') ?: 'date';

        $data = $handler->getData($startdate, $enddate, 'ga:visits',[
            'dimensions' => 'ga:'.$unit.',ga:hour'
        ]);

        $collection = new TableCollection($data);

        return $this->download($collection, 'hour');
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

        return $this->download($collection, 'region');
    }

    public function source(Request $request, Handler $handler)
    {
        $startdate = $request->get('startdate') ?: Carbon::now()->subDay(15)->format('Y-m-d');
        $enddate = $request->get('enddate') ?: Carbon::now()->format('Y-m-d');
        $unit = $request->get('unit') ?: 'date';

        $data = $handler->getData($startdate, $enddate, 'ga:visits',[
            'dimensions' => 'ga:'.$unit.',ga:source', 'sort' => 'ga:'.$unit.',-ga:visits',
        ]);

        $collection = new TableCollection($data);

        return $this->download($collection, 'source');
    }

    public function keyword(Request $request, Handler $handler)
    {
        $startdate = $request->get('startdate') ?: Carbon::now()->subDay(15)->format('Y-m-d');
        $enddate = $request->get('enddate') ?: Carbon::now()->format('Y-m-d');
        $unit = $request->get('unit') ?: 'date';

        $data = $handler->getData($startdate, $enddate, 'ga:visits',[
            'dimensions' => 'ga:'.$unit.',ga:keyword', 'sort' => 'ga:'.$unit.',-ga:visits',
        ]);

        $collection = new TableCollection($data);

        return $this->download($collection, 'keyword');
    }

    public function device(Request $request, Handler $handler)
    {
        $startdate = $request->get('startdate') ?: Carbon::now()->subDay(15)->format('Y-m-d');
        $enddate = $request->get('enddate') ?: Carbon::now()->format('Y-m-d');
        $unit = $request->get('unit') ?: 'date';

        $data = $handler->getData($startdate, $enddate, 'ga:visits',[
            'dimensions' => 'ga:'.$unit.',ga:deviceCategory', 'sort' => 'ga:'.$unit.',-ga:visits',
        ]);

        $collection = new TableCollection($data);

        return $this->download($collection, 'device');
    }

    public function os(Request $request, Handler $handler)
    {
        $startdate = $request->get('startdate') ?: Carbon::now()->subDay(15)->format('Y-m-d');
        $enddate = $request->get('enddate') ?: Carbon::now()->format('Y-m-d');
        $unit = $request->get('unit') ?: 'date';

        $data = $handler->getData($startdate, $enddate, 'ga:visits',[
            'dimensions' => 'ga:'.$unit.',ga:operatingSystem,ga:operatingSystemVersion',
            'sort' => 'ga:'.$unit.',-ga:visits',
        ]);

        $collection = new C2TableCollection($data);

        return $this->download($collection, 'os');
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

        return $this->download($collection, 'browser');
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

        $collection = new PairCollection($data);

        return $this->download($collection, 'pageview');
    }

    protected function download(TableCollection $collection, $name)
    {
        $beginTrack = 'B';
        $beginSession = 2;
        $excel = new PHPExcel();
        $sheet = $excel->setActiveSheetIndex(0);

        // set field title
        $track = $beginTrack;
        foreach ($collection->columns() as $column) {
            $cellId = $track . 1;
            $sheet->setCellValue($cellId, $column->name());

            $track = $this->nextTrack($track);
        }

        // set data rows
        $track = $beginTrack;
        $session = $beginSession;
        foreach($collection as $row) {
            $sheet->setCellValue('A'.$session, $row->header());

            foreach ($collection->columns() as $column) {
                $cellId = $track . $session;
                $sheet->setCellValue($cellId, $row->getCol($column)->value());

                $track = $this->nextTrack($track);
            }

            $track = $beginTrack;
            $session++;
        }

        $path = storage_path('app/google/'.$name.'.xlsx');

        $writer = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $writer->save($path);

        $response = app(ResponseFactory::class)->download($path);
        $response->deleteFileAfterSend(true);

        return $response;
    }


    protected function nextTrack($current)
    {
        $begin = 'A';
        $end = 'Z';

        if (!$current) {
            return $begin;
        }

        $segments = str_split($current);
        $code = array_pop($segments);
        $header = implode('', $segments);

        if ($code === $end) {
            $header = $this->nextTrack($header);
            return $header.$begin;
        }

        $code = chr(ord($code) + 1);

        return $header.$code;
    }
}
