@extends(config('LaravelAsterisk.extendsView'))

@section(config('LaravelAsterisk.titleView'))
    LaravelAsterisk
@endsection

@section(config('LaravelAsterisk.contentView'))
    LaravelAsterisk content
    <div id="laravelasterisk">
        <laravelasterisk prefix="{{ config('LaravelAsterisk.prefix') }}"></laravelasterisk>
    </div>
@endsection


@push(config('LaravelAsterisk.cssView'))
@endpush

@push(config('LaravelAsterisk.jsView'))
@endpush
