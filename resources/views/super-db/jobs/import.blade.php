<x-layout title="{{ __('Database') }}">
        <div class="d-grid gap-2 d-md-block">
        <a href="{{ route('super-db.jobs.index', $id) }}" class="btn btn-sm btn-primary"><i
                data-feather="skip-back"></i>{{ __('Back') }}</a>
    </div>
    <form action="{{ route('super-db.import.add', $id) }}" method="POST" enctype="multipart/form-data">
        @csrf
    <div class="d-grid gap-2 d-md-flex justify-content-md-end"> 
        <label for="formFile" class="form-label">{{ __('Browse your computer:') }}</label>
        <input class="form-control" type="file" name="formFile" id="formFile">
        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
    </div>
</form>
</x-layout>