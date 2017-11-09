<?php
namespace Xpressengine\Plugins\OSSGAStats;

use Route;
use XeRegister;
use Xpressengine\Plugin\AbstractPlugin;

class Plugin extends AbstractPlugin
{
    /**
     * 이 메소드는 활성화(activate) 된 플러그인이 부트될 때 항상 실행됩니다.
     *
     * @return void
     */
    public function boot()
    {
        // implement code
        $this->routes();

        app('router')->aliasMiddleware('ga_enabled', Middleware::class);
    }

    private function routes()
    {
        Route::group(
            ['namespace' => 'Xpressengine\\Plugins\\OSSGAStats\\Controllers', 'as' => 'oss_ga_stats::'],
            function () {
                require __DIR__ . '/routes.php';
            }
        );

        foreach (require __DIR__ . '/menus.php' as $id => $menu) {
            XeRegister::push('settings/menu', $id, $menu);
        }
    }
}
