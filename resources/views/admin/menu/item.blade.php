<div class="dd-handle">
    <i class="fa fa-align-justify"></i>&nbsp;<strong>{{ $content->title }}</strong>&nbsp;&nbsp;&nbsp;
    <a target="_blank" href="{{ url($content->uri?:'') }}" class="dd-nodrag">{{ url($content->uri?:'') }}</a>
    <span class="pull-right dd-nodrag">
        <a href="{{ route('admin.menu-content.edit',[$menu,$content]) }}"><i class="fa fa-edit"></i></a>
        <a href="javascript:void(0);" data-id="{{ $content->id }}" class="tree_branch_delete "><i class="fa fa-trash"></i></a>
    </span>
</div>
