<div {!! $attributes !!}>

    <div
        class="progress-bar progress-bar-{{$color}}{{$active ? ' progress-bar-striped' : ''}}"
        role="progressbar"
        aria-valuenow="{{$progress['percent']}}"
        aria-valuemin="0"
        aria-valuemax="100"
        style="{{$vertical?'height':'width'}}: {{$progress['percent']}}%"
        >
        <span class="sr-only">{{$progress['description']}}</span>
    </div>

</div>