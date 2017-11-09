<?php
namespace Xpressengine\Plugins\OSSGAStats;

use Xpressengine\Widget\Exceptions\NotConfigurationWidgetException;

class Middleware
{
    public function handle($request, \Closure $next)
    {
        try {
            app('xe.ga')->getAnalytics();
        } catch (NotConfigurationWidgetException $e) {
            return redirect()->back()
                ->with('alert', ['type' => 'danger', 'message' => 'Google Analytics 설정이 필요합니다.']);
        }

        return $next($request);
    }
}
