<form  method="POST"
       action="{{ $action }}"
       class="form-horizontal"
       accept-charset="UTF-8">
    {{ csrf_field() }}
    <div class="box-body fields-group">
        <div class="form-group  ">
            <label for="parent_id" class="col-sm-2  control-label">Родитель</label>
            <div class="col-sm-8">
                <input type="hidden" name="parent_id">
                <select class="form-control parent_id select2-hidden-accessible" style="width: 100%;"
                        name="parent_id"   aria-hidden="true">
                    <option value=""></option>
                    <option value="0" selected="">ROOT</option>

                    @foreach($menu->menus->where('parent_id',0)->sortBy('sort') as $taxonomy)
                        <option
                            @isset($menuItem)
                                @if((integer)$menuItem->parent_id === $taxonomy->id) selected @endif
                            @else
                                @if((integer)old('parent_id') === $taxonomy->id) selected @endif
                            @endisset
                            value="{{ $taxonomy->id }}">┝&nbsp;&nbsp;{{ $taxonomy->title }}</option>
                        @if(count($taxonomy->parents))
                            @include('admin.menu.partials.select-sub-category',['subcategories'=>$taxonomy->parents,'iteration'=>1])
                        @endif
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group  @if($errors->first('title')) has-error @endif">
            <label for="title" class="col-sm-2 asterisk control-label">Название</label>
            <div class="col-sm-8">
                @if($errors->first('title'))
                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>
                    {{ $errors->first('title') }}
                </label>
                @endif
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                    <input type="text" id="title" name="title"
                           @isset($menuItem)
                                value="{{ $menuItem->title }}"
                           @else
                                value="{{ old('title') }}"
                           @endisset
                           class="form-control title" placeholder="Введите название">
                </div>
            </div>
        </div>
{{--        <div class="form-group">--}}
{{--            <label for="icon" class="col-sm-2 control-label">Иконка</label>--}}
{{--            <div class="col-sm-8">--}}
{{--                <div class="input-group iconpicker-container">--}}
{{--                    <span class="input-group-addon"><i class="fa fa-bars"></i></span>--}}
{{--                    <input style="width: 140px" type="text" name="icon"--}}
{{--                           @isset($menuItem)--}}
{{--                           value="{{ $menuItem->icon }}"--}}
{{--                           @else--}}
{{--                           value="{{ old('icon') }}"--}}
{{--                           @endisset--}}
{{--                           class="form-control"--}}
{{--                           placeholder="Ввод Иконка">--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
        <div class="form-group">
            <label for="uri" class="col-sm-2  control-label">URI</label>
            <div class="col-sm-8">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                    <input type="text" id="uri" name="uri"
                           @isset($menuItem)
                            value="{{ $menuItem->uri }}"
                           @else
                           value="{{ old('uri') }}"
                           @endisset
                           class="form-control uri" placeholder="Ввод URI">
                </div>
            </div>
        </div>
{{--        <div class="form-group">--}}
{{--            <label for="uri" class="col-sm-2  control-label">Target</label>--}}
{{--            <div class="col-sm-8">--}}
{{--                <div class="input-group">--}}
{{--                    <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>--}}
{{--                    <input type="text" id="uri" name="target"--}}
{{--                           @isset($menuItem)--}}
{{--                           value="{{ $menuItem->target }}"--}}
{{--                           @else--}}
{{--                           value="{{ old('target') }}"--}}
{{--                           @endisset--}}
{{--                           class="form-control uri" placeholder="Ввод Target">--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
        <div class="form-group">
            <label for="uri" class="col-sm-2  control-label">Параметры</label>
            <div class="col-sm-8">
                <div class="form-group">
                    <textarea name="parameters" class="form-control as" rows="5" placeholder="Параметры">@isset($menuItem){{ $menuItem->parameters }}@else{{ old('parameters') }}@endisset</textarea>
                </div>
            </div>
        </div>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="btn-group pull-left">
                <button type="reset" class="btn btn-warning pull-right">Сбросить</button>
            </div>
            <div class="btn-group pull-right">
                <button type="submit" class="btn btn-info pull-right">Отправить</button>
            </div>
        </div>
    </div>
</form>
<script data-exec-on-popstate="">$(function () {
        $(".parent_id").select2({"allowClear":true,"placeholder":{"id":"","text":"\u0420\u043e\u0434\u0438\u0442\u0435\u043b\u044c"}});
    });
</script>
