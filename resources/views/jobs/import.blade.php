<x-layout title="Import File">

            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-md-12 col-lg-8 col-xl-6">
                    <form  action="{{ route('jobs.store-import') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="import_file" />
                        <button class="btn btn-primary">Import File</button>
                    </form>
                </div>

            </div>
        </div>

</x-layout>