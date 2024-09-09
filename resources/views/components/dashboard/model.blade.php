
@props(['status','name','message','action','icon'])

<button type="button" class="btn text-{{$status}}" data-toggle="modal" data-target="#{{$name}}">
    <i class="{{$icon}}"></i>
</button>
<div class="modal fade" id="{{$name}}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Warning Message</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{$message}}
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <form  action="{{$action}}" method="post">
                    @csrf
                    {{$slot}}
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
