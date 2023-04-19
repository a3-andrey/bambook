<section id="pjax-container" class="content">

    <div class="row">
        <div class="col-md-6">
            <div class="box">
                <div class="box-header">
                    <div class="btn-group">
                        <a class="btn btn-primary btn-sm tree-6001e3b3d13a5-tree-tools" data-action="expand" title="Развернуть">
                            <i class="fa fa-plus-square-o"></i>&nbsp;Развернуть
                        </a>
                        <a class="btn btn-primary btn-sm tree-6001e3b3d13a5-tree-tools" data-action="collapse" title="Свернуть">
                            <i class="fa fa-minus-square-o"></i>&nbsp;Свернуть
                        </a>
                    </div>
                    <div class="btn-group">
                        <a class="btn btn-info btn-sm tree-save" title="Сохранить">
                            <i class="fa fa-save"></i><span class="hidden-xs">&nbsp;Сохранить</span>
                        </a>
                    </div>
                    <div class="btn-group">
                        <a class="btn btn-warning btn-sm tree-refresh" title="Обновить">
                            <i class="fa fa-refresh"></i><span class="hidden-xs">&nbsp;Обновить</span>
                        </a>
                    </div>
                    <div class="btn-group">
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <div class="dd" id="tree-menu">
                        <ol class="dd-list">
                            @foreach($menu->parents as $taxonomy)
                                <li class="dd-item" data-id="{{ $taxonomy->id }}">
                                    @include('admin.menu.partials.item',['content'=>$taxonomy])
                                    @if($taxonomy->parents->count())
                                    @include('admin.menu.partials.list',['subcategories'=>$taxonomy->parents->sortBy('sort')])                                    @endif
                                </li>
                            @endforeach
                        </ol>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Добавить</h3>
                    <div class="box-tools pull-right">
                    </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body" style="display: block;">
                    @include('admin.menu.partials.form',['action'=>route('admin.menu-content.create',$menu)])
                </div><!-- /.box-body -->
            </div>
        </div>
    </div>

</section>

<script data-exec-on-popstate="">$(function () {
        $('#tree-menu').nestable([]);

        $('.tree-save').on('click', function() {
            var serialize = $('#tree-menu').nestable('serialize');
            $.post('{{ route('api.menu-item.update',$menu) }}', {
                    _token: LA.token,
                    _order: JSON.stringify(serialize)
                },
                function(data){
                    $.pjax.reload('#pjax-container');
                    toastr.success('Успешно сохранено!');
                });
        });

        $('.tree_branch_delete').click(function() {
            var id = $(this).data('id');
            swal({
                title: "Вы уверены, что хотите удалить эту запись?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Подтвердить",
                showLoaderOnConfirm: true,
                cancelButtonText: "Отмена",
                preConfirm: function() {
                    return new Promise(function(resolve) {
                        $.ajax({
                            method: 'get',
                            url: '/api/menu-item/'+id+'/delete',
                            data: {
                                _method:'delete',
                                _token:LA.token,
                            },
                            success: function (data) {
                                console.log(data);
                                $.pjax.reload('#pjax-container');
                                toastr.success('Успешно удалено!');
                                resolve(data);
                            }
                        });
                    });
                }
            }).then(function(result) {
                var data = result.value;
                if (typeof data === 'object') {
                    if (data.status) {
                        swal(data.message, '', 'success');
                    } else {
                        swal(data.message, '', 'error');
                    }
                }
            });
        });

        $('.tree-refresh').click(function () {
            $.pjax.reload('#pjax-container');
            toastr.success('Успешно обновлено!');
        });

        $('.tree-6001e3b3d13a5-tree-tools').on('click', function(e){
            var action = $(this).data('action');
            if (action === 'expand') {
                $('.dd').nestable('expandAll');
            }
            if (action === 'collapse') {
                $('.dd').nestable('collapseAll');
            }
        });

    });
</script>



