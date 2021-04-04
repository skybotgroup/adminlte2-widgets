<div class="box-group" id="#{{$id}}" {{$attributes}}>
    @foreach($rows as $row)
        <div class="panel box box-{{$row['color']}}">
            <div class="box-header with-border">
                <h4 class="box-title">
                    <a data-toggle="collapse" data-parent="#{{$id}}" href="#{{$row['id']}}">
                        {{$row['title']}}
                    </a>
                </h4>
            </div>
            <div id="{{$row['id']}}" class="panel-collapse collapse in">
                <div class="box-body">
                    {{$row['content']}}
                </div>
            </div>
        </div>
    @endforeach
</div>