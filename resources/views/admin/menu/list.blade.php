<ol class="dd-list">
    @foreach($subcategories as $subcategory)
        <li class="dd-item" data-id="{{ $subcategory->id }}">
            @include('admin.menu.item',['content'=>$subcategory])
            @if($subcategory->parents->count())
                @include('admin.menu.list',['subcategories'=>$subcategory->parents->sortBy('sort')])
            @endif
        </li>
    @endforeach
</ol>

