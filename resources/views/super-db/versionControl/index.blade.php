<x-layout title="{{ __('Version Control') }}">
        <div class="d-grid gap-2 d-md-block">
        <a href="{{ route('super-db.jobs.index', $id) }}" class="btn btn-sm btn-primary"><i
                data-feather="skip-back"></i>{{ __('Back') }}</a>
    </div>
    <form action="{{ route('super-db.versionControl.store', $id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        
@if($tables !=null and count($tables)>0)
    <ul class="list-group">
        @foreach($tables as $table)
            <li class="list-group-item list-group-item-action list-group-item-dark">
                <div class="form-check">
                    <input class="form-check-input" name="tables[]" type="checkbox" value="{{$table}}" id="{{$table}}">
                    <label class="form-check-label" for="{{$table}}">
                        {{$table}}
                    </label>
                </div>
            </li>
        @endforeach
    </ul>
    <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
@else
    <p class="fw-bold">There are no tables in the Database</p>
@endif
</form>
</x-layout>