

<ul class="nav nav-tabs">
    <li {!! $page === 'source' ? 'class="active"' : '' !!}><a href="{{ route('oss_ga_stats::contents.traffic.source') }}">유입 경로</a></li>
    <li {!! $page === 'keyword' ? 'class="active"' : '' !!}><a href="{{ route('oss_ga_stats::contents.traffic.keyword') }}">유입 키워드</a></li>
</ul>