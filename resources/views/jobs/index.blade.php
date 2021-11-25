
<x-layout title="Add Query">

            <div class="row d-flex justify-content-center align-items-center h-100 mt-5">
                <div class="col col-md-12 col-lg-8 col-xl-6">
                    <form action="{{ route('jobs.store') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Enter Query</label>
                            <textarea class="form-control" name="query" id="exampleFormControlTextarea1"
                                rows="3"></textarea>
                        </div>
                        <div class="col-sm-12 d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary me-1 mb-1">Send</button>
                        </div>
                    </form>
                </div>
            </div>

   
    </x-layout>
