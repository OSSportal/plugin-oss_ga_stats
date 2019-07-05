{{ XeFrontend::css('assets/vendor/jqueryui/jquery-ui.min.css')->load() }}
{{ XeFrontend::js('assets/vendor/jqueryui/jquery-ui.min.js')->load() }}

@include('oss_ga_stats::views.platform._header', ['page' => 'os'])

<div class="panel-group" role="tablist" aria-multiselectable="true">
    <div class="panel">
        <div class="panel-heading">
            <div class="pull-left">
                <h3 class="panel-title">운영체제</h3>
            </div>
        </div>
        <div class="panel-collapse collapse in">

            <div class="panel-body">
                <div style="margin:10px 0;" class="pull-left">
                    <form class="form-inline" id="__xe_form-condition">
                        <input type="text" class="form-control" name="startdate" value="{{ $startdate }}" readonly="readonly">
                        -
                        <input type="text" class="form-control" name="enddate" value="{{ $enddate }}" readonly="readonly">
                        <select class="form-control" name="unit">
                            <option value="date" {{ $unit === 'date' ? 'selected' : '' }}>날짜별</option>
                            <option value="week" {{ $unit === 'week' ? 'selected' : '' }}>주별</option>
                            <option value="month" {{ $unit === 'month' ? 'selected' : '' }}>월별</option>
                        </select>
                        <button type="submit" class="btn btn-primary"><i class="xi-search"></i></button>
                    </form>
                </div>
                <div class="pull-right">
                    <button type="button" class="btn btn-link btn-download" data-url="{{ route('oss_ga_stats::download.os') }}">다운로드</button>
                </div>

                @include('oss_ga_stats::views._table', ['collection' => $collection])

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
            location.href = $(this).data('url') + '?' + $('#__xe_form-condition').serialize();
        });
    });
</script>
