@extends(config('TaskManager.extendsView'))

@section(config('TaskManager.titleView'))
    TaskManager
@endsection

@section(config('TaskManager.contentView'))
    TaskManager content
    <div id="taskmanager">
        <taskmanager prefix="{{ config('TaskManager.prefix') }}"></taskmanager>
    </div>
@endsection


@push(config('TaskManager.cssView'))
@endpush

@push(config('TaskManager.jsView'))
@endpush
