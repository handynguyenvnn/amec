<div class="col-xs-2">
    <ul class="nav nav-tabs tabs-right sideways">
        <li class="active"><a href="#common-v" data-toggle="tab">共通</a></li>
        @if(count($languages))
            @foreach($languages as $items)
                <li><a href="#{{ $items['lang_code']}}-v" data-toggle="tab">{{ $items['lang']}}</a></li>
            @endforeach
        @endif
    </ul>
</div>