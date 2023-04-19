@php $iteration += 1 @endphp
@foreach($subcategories as $subcategory)
    <option
        @if(old('parent_id') === $subcategory->id) selected @endif
    value="{{ $subcategory->id }}">
        @for($i=0;$i <= $iteration; $i++ )&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        @endfor
            ┝&nbsp;{{ $subcategory->title }}
    </option>
    @if(count($subcategory->parents))
        @include('admin.menu.select-sub-category',['subcategories'=>$subcategory->parents,'iteration'=>$iteration])
    @endif
@endforeach
