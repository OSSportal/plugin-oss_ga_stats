<?php

Route::settings('oss_ga_stats', function () {
    Route::group(['prefix' => 'contents', 'as' => 'contents.'], function () {
        Route::get('/', ['as' => 'index', 'uses' => function () {
            return redirect()->route('oss_ga_stats::contents.time.date');
        }]);

        Route::group(['prefix' => 'time', 'as' => 'time.', 'settings_menu' => 'statistics.oss_ga.time'], function () {
            Route::get('hour', ['as' => 'hour', 'uses' => 'ContentController@hour']);
            Route::get('term', ['as' => 'term', 'uses' => 'ContentController@term']);

            Route::get('time', ['as' => 'time', 'uses' => 'ContentController@time']);
            Route::get('month', ['as' => 'month', 'uses' => 'ContentController@month']);
            Route::get('year', ['as' => 'year', 'uses' => 'ContentController@year']);
            Route::get('date', ['as' => 'date', 'uses' => 'ContentController@date']);
        });

        Route::get('geo', ['as' => 'region', 'uses' => 'ContentController@region', 'settings_menu' => 'statistics.oss_ga.geo']);

        Route::group(['prefix' => 'traffic', 'as' => 'traffic.', 'settings_menu' => 'statistics.oss_ga.traffic'], function () {
            Route::get('keyword', ['as' => 'keyword', 'uses' => 'ContentController@keyword']);
            Route::get('source', ['as' => 'source', 'uses' => 'ContentController@source']);
        });

        Route::group(['prefix' => 'platform', 'as' => 'platform.', 'settings_menu' => 'statistics.oss_ga.platform'], function () {
            Route::get('os', ['as' => 'os', 'uses' => 'ContentController@os']);
            Route::get('browser', ['as' => 'browser', 'uses' => 'ContentController@browser']);

            Route::get('device', ['as' => 'device', 'uses' => 'ContentController@device']);
        });

        Route::group(['prefix' => 'content', 'as' => 'content.', 'settings_menu' => 'statistics.oss_ga.content'], function () {
            Route::get('detail', ['as' => 'detail', 'uses' => 'ContentController@detail']);

            Route::get('/', ['as' => 'index', 'uses' => 'ContentController@pv']);
        });
    });

    Route::group(['prefix' => 'download', 'as' => 'download.'], function () {
        Route::get('time', ['as' => 'time', 'uses' => 'DownloadController@time']);
        Route::get('date', ['as' => 'date', 'uses' => 'DownloadController@date']);
        Route::get('month', ['as' => 'month', 'uses' => 'DownloadController@month']);
        Route::get('year', ['as' => 'year', 'uses' => 'DownloadController@year']);
        Route::get('term', ['as' => 'term', 'uses' => 'DownloadController@term']);
        Route::get('hour', ['as' => 'hour', 'uses' => 'DownloadController@hour']);

        Route::get('geo', ['as' => 'region', 'uses' => 'DownloadController@region']);

        Route::get('source', ['as' => 'source', 'uses' => 'DownloadController@source']);
        Route::get('keyword', ['as' => 'keyword', 'uses' => 'DownloadController@keyword']);

        Route::get('device', ['as' => 'device', 'uses' => 'DownloadController@device']);
        Route::get('os', ['as' => 'os', 'uses' => 'DownloadController@os']);
        Route::get('browser', ['as' => 'browser', 'uses' => 'DownloadController@browser']);

        Route::get('pv', ['as' => 'pv', 'uses' => 'DownloadController@pv']);
    });
});
