<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ Meta::get('title',$page ? $page->meta_title : config('app.name','Загоовок страницы')) }}</title>

    {!! Meta::tag('robots') !!}

    {!! Meta::tag('locale', config('app.locale')) !!}

    {!! Meta::tag('keywords', $page ? $page->meta_keywords : config('site.keywords')) !!}

    {!! Meta::tag('description', $page ? $page->meta_description : config('site.description')) !!}

    <livewire:styles />

    <link rel="icon" href="{{ image(config('site.favicon')) }}" type="image/ico"/>

{{--    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>--}}

    {{ $slot }}

    <!-- #### START COUNTERS ##### -->
    @foreach($counters as $counter)
        {!! $counter->counters !!}
    @endforeach
    <!-- ##### END COUNTERS ##### -->
{{--    <link href="https://cdn.jsdelivr.net/npm/suggestions-jquery@21.12.0/dist/css/suggestions.min.css" rel="stylesheet" />--}}
{{--    <script src="https://cdn.jsdelivr.net/npm/suggestions-jquery@21.12.0/dist/js/jquery.suggestions.min.js"></script>--}}
{{--    <script>--}}
{{--        $("#party").suggestions({--}}
{{--            token: "{{ config('dadata.token') }}",--}}
{{--            type: "PARTY",--}}
{{--            /* Вызывается, когда пользователь выбирает одну из подсказок */--}}
{{--            onSelect: function(suggestion) {--}}
{{--                console.log(suggestion);--}}
{{--            }--}}
{{--        });--}}
{{--    </script>--}}
    <x-style/>
    
</head>
