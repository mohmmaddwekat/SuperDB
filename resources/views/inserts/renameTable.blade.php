<x-layout title="Insert table">
    <div class="d-grid gap-2 d-md-block">
        <a href="{{ route('jobs.index',  $connection->id) }}" class="btn btn-sm btn-primary"><i data-feather="skip-back"></i>Back</a>
    </div>
        <div class="container">
                <div class="row ">
                    <div class="col-md-8">
                        <form action="{{ route('inserts.updateTable',  [$connection->id,$table]) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="name table" class="form-label">Enter name of table</label>
                                <input type="text" name="nametable" class="form-control" id="nametable" value="{{ $table }}">
                              </div>
                              <button type="submit" class="btn btn-primary ">Rename</button>
                        </form>
                    </div>
                </div>
        </div>

</x-layout>