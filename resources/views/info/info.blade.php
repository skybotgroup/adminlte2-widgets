<div {{$attributes}}>
    <span class="info-box-icon {{$iconBg?'bg-'.$iconBg:''}}">
        <i class="fa fa-{{$icon}}"></i>
    </span>

    <div class="info-box-content">
        <span class="info-box-text">{{$text}}</span>
        <span class="info-box-number">{{$number}}</span>
        @if($progress['percent'] >= 0)
            <div class="progress">
                <div class="progress-bar" style="width: {{$progress['percent']}}%"></div>
            </div>
            <span class="progress-description">
                {{$progress['description']}}
            </span>
        @endif
    </div>
</div>