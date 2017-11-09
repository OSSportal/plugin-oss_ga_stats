<ul class="nav nav-tabs">
    <li {!! $page === 'time' ? 'class="active"' : '' !!}><a href="{{ route('oss_ga_stats::contents.time.time') }}">시간별</a></li>
    <li {!! $page === 'date' ? 'class="active"' : '' !!}><a href="{{ route('oss_ga_stats::contents.time.date') }}">날짜별</a></li>
    <li {!! $page === 'month' ? 'class="active"' : '' !!}><a href="{{ route('oss_ga_stats::contents.time.month') }}">월별</a></li>
    <li {!! $page === 'year' ? 'class="active"' : '' !!}><a href="{{ route('oss_ga_stats::contents.time.year') }}">연도별</a></li>
</ul>