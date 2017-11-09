{{ XeFrontend::css('assets/vendor/jqueryui/jquery-ui.min.css')->load() }}
{{ XeFrontend::js('assets/vendor/jqueryui/jquery-ui.min.js')->appendTo('head')->load() }}

@include('oss_ga_stats::views.time._header', ['page' => 'term'])

<div class="panel-group" role="tablist" aria-multiselectable="true">
    <div class="panel">
        <div class="panel-heading">
            <div class="pull-left">
                <h3 class="panel-title">기간별 방문자</h3>
            </div>
        </div>
        <div class="panel-collapse collapse in">

            <div class="panel-body">
                <div style="margin:10px 0;">
                    <form class="form-inline" id="__xe_form-condition">
                        <input type="text" class="form-control" name="startdate" value="{{ $startdate }}" readonly="readonly">
                        -
                        <input type="text" class="form-control" name="enddate" value="{{ $enddate }}" readonly="readonly">
                        <button type="submit" class="btn btn-primary"><i class="xi-search"></i></button>
                    </form>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-md-6">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4>
                                            일별
                                            <small><button type="button" class="btn btn-link btn-download" data-url="{{ route('oss_ga_stats::download.term') }}" data-unit="day">다운로드</button></small>
                                        </h4>
                                    </div>
                                    @include('oss_ga_stats::views._table', ['collection' => $dCollection])
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4>
                                            월별
                                            <small><button type="button" class="btn btn-link btn-download" data-url="{{ route('oss_ga_stats::download.term') }}" data-unit="month">다운로드</button></small>
                                        </h4>
                                    </div>
                                    @include('oss_ga_stats::views._table', ['collection' => $mCollection])
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4>
                                            년별
                                            <small><button type="button" class="btn btn-link btn-download" data-url="{{ route('oss_ga_stats::download.term') }}" data-unit="year">다운로드</button></small>
                                        </h4>
                                    </div>
                                    @include('oss_ga_stats::views._table', ['collection' => $yCollection])
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <div class="row">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4>
                                            주별
                                            <small><button type="button" class="btn btn-link btn-download" data-url="{{ route('oss_ga_stats::download.term') }}" data-unit="week">다운로드</button></small>
                                        </h4>
                                    </div>
                                    @include('oss_ga_stats::views._table', ['collection' => $wCollection])
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4>
                                            요일별
                                            <small><button type="button" class="btn btn-link btn-download" data-url="{{ route('oss_ga_stats::download.term') }}" data-unit="dayOfWeek">다운로드</button></small>
                                        </h4>
                                    </div>
                                    @include('oss_ga_stats::views._table', ['collection' => $wdCollection])
                                </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function () {
        var options = {
            dateFormat: 'yy-mm-dd'
        };

        $('input[name="startdate"]').datepicker(options);
        $('input[name="enddate"]').datepicker(options);

        $('.btn-download').click(function () {
            location.href = $(this).data('url') + '?' + $('#__xe_form-condition').serialize() + '&unit=' + $(this).data('unit');
        });
    });
</script>