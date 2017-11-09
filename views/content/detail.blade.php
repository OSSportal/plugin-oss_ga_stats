{{ XeFrontend::css('assets/vendor/jqueryui/jquery-ui.min.css')->load() }}
{{ XeFrontend::js('assets/vendor/jqueryui/jquery-ui.min.js')->appendTo('head')->load() }}

<div class="panel-group" role="tablist" aria-multiselectable="true">
    <div class="panel">
        <div class="panel-heading">
            <div class="pull-left">
                <h3 class="panel-title">페이지 통계 <small>{{ $path }}<a href="{{ url($path) }}" target="_blank"><i class="xi-external-link"></i></a></small></h3>
            </div>
        </div>
        <div class="panel-collapse collapse in">

            <div class="panel-body">
                <div style="margin:10px 0;">
                    <form class="form-inline" id="__xe_form-condition">
                        <input type="text" class="form-control" name="startdate" value="{{ $startdate }}" readonly="readonly">
                        -
                        <input type="text" class="form-control" name="enddate" value="{{ $enddate }}" readonly="readonly">
                        <input type="hidden" name="path" value="{{ rawurlencode($path) }}">
                        <button type="submit" class="btn btn-primary"><i class="xi-search"></i></button>
                    </form>
                </div>

                <div class="row" style="margin-top: 80px;">
                    @foreach($collection as $row)
                        @foreach($collection->columns() as $column)
                            <div class="col-xs-4 col-md-2">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <dl>
                                            <dt>{{ date('Y-m-d', strtotime($row->header())) }}</dt>
                                            <dd class="text-center"><h2>{{ $row->getCol($column)->value() }}</h2></dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
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


    });
</script>