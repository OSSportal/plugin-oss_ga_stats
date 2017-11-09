

<ul class="nav nav-tabs">
    <li {!! $page === 'device' ? 'class="active"' : '' !!}><a href="{{ route('oss_ga_stats::contents.platform.device') }}">접속환경</a></li>
    <li {!! $page === 'os' ? 'class="active"' : '' !!}><a href="{{ route('oss_ga_stats::contents.platform.os') }}">운영체제</a></li>
    <li {!! $page === 'browser' ? 'class="active"' : '' !!}><a href="{{ route('oss_ga_stats::contents.platform.browser') }}">브라우저</a></li>
</ul>