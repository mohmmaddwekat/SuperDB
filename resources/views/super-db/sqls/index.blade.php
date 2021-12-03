
<x-layout title="{{ __('Add Query') }}">
    <div class="d-grid gap-2 d-md-block">
        <a href="{{ route('super-db.jobs.index',  $connection->id) }}" class="btn btn-sm btn-primary"><i data-feather="skip-back"></i>{{ __('Back') }}</a>
      </div>
            <div class="row d-flex justify-content-center align-items-center h-100 mt-5">
                <div class="col col-md-12 col-lg-8 col-xl-6">
                    <form action="{{ route('super-db.sqls.store', $connection->id) }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">{{ __('Enter Query') }}</label>
                            <textarea class="form-control" name="query" id="exampleFormControlTextarea1"
                                rows="3"></textarea>
                        </div>
                        <div class="col-sm-12 d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary me-1 mb-1">{{ __('Send') }}</button>
                        </div>
                    </form>
                </div>
            </div>
   
    </x-layout>
