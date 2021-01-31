<!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    <li @if (isset($params['isChapter']) && $params['isChapter'] == 1 ||  (!isset($params['isChapter'])) && !isset($params['isBigTests']) && !isset($params['isAppTimes'])) class="active" @endif style="width: 20%;">
        <a href="{{ route('user-history.chapters', $uid) }}" >チャプター</a>
    </li>
    <li @if (isset($params['isBigTests']) && $params['isBigTests'] == 1) class="active" @endif style="width: 20%;">
        <a href="{{ route('user-history.bigtests', $uid) }}">大テスト</a>
    </li>
    <li @if (isset($params['isAppTimes'])  && $params['isAppTimes'] == 1) class="active" @endif style="width: 20%;">
        <a href="{{ route('user-history.apptimes', $uid) }}">アプリ起動時間</a>
    </li>
</ul>