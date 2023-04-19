<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">Редактировать</h3>
    </div>
    @include('admin.menu.partials.form',['action'=>route('admin.menu-content.update',[$menu,$menuItem])])
</div>
