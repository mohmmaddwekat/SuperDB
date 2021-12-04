<x-layout title="{{ __('Database') }}">
        <div class="d-grid gap-2 d-md-block">
        <a href="{{ route('super-db.jobs.index', $id) }}" class="btn btn-sm btn-primary"><i
                data-feather="skip-back"></i>{{ __('Back') }}</a>
    </div>
    <form action="{{ route('super-db.import.add', $id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="d-grid gap-2 d-md-flex justify-content-md-center">
            <div class="col-5">
                <select class="form-select" name="type" aria-label="Default select example">
                    <option value="csv" selected>CSV File</option>
                    <option value="text">Text File</option>
                    <option value="sql">SQL File</option>
                </select>
            </div>
        </div>
    <div class="d-grid gap-2 d-md-flex justify-content-md-end"> 
        <label for="formFile" class="form-label">{{ __('Browse your computer:') }}</label>
        <input class="form-control" type="file" name="formFile" id="formFile">
        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
    </div>
</form>
</x-layout>