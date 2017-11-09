{{ XeFrontend::css('assets/vendor/jqueryui/jquery-ui.min.css')->load() }}
{{ XeFrontend::js('assets/vendor/jqueryui/jquery-ui.min.js')->appendTo('head')->load() }}

@include('oss_ga_stats::views.platform._header', ['page' => 'browser'])

<div class="panel-group" role="tablist" aria-multiselectable="true">
    <div class="panel">
        <div class="panel-heading">
            <div class="pull-left">
                <h3 class="panel-title">방문 페이지</h3>
            </div>
        </div>
        <div class="panel-collapse collapse in">

            <div class="panel-body">
                <div style="margin:10px 0;" class="pull-left">
                    <form class="form-inline" id="__xe_form-condition">
                        <input type="text" class="form-control" name="startdate" value="{{ $startdate }}" readonly="readonly">
                        -
                        <input type="text" class="form-control" name="enddate" value="{{ $enddate }}" readonly="readonly">
                        <select class="form-control" name="limit">
                            <option value="10" {{ $limit === '10' ? 'selected' : '' }}>10개보기</option>
                            <option value="20" {{ $limit === '20' ? 'selected' : '' }}>20개보기</option>
                            <option value="30" {{ $limit === '30' ? 'selected' : '' }}>30개보기</option>
                            <option value="50" {{ $limit === '50' ? 'selected' : '' }}>50개보기</option>
                        </select>
                        <button type="submit" class="btn btn-primary"><i class="xi-search"></i></button>
                    </form>
                </div>
                <div class="pull-right">
                    <button type="button" class="btn btn-link btn-download" data-url="{{ route('oss_ga_stats::download.pv') }}">다운로드</button>
                </div>

                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>페이지</th>
                            <th>페이지 뷰</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $row)
                            <tr>
                                <td><a href="{{ route('oss_ga_stats::contents.content.detail', ['path' => rawurlencode($row[0])]) }}">{{ $row[0] }}</a></td>
                                <td>{{ $row[1] }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
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