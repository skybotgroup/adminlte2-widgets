<div {{$attributes}}>
    <div class="progress-bar progress-bar-{{$color}}" role="progressbar" aria-valuenow="{{$progress['percent']}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$progress['percent']}}%">
        <span class="sr-only">{{$progress['description']}}</span>
    </div>
</div>