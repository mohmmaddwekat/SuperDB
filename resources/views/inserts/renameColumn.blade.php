<x-layout title="Insert table">

        <div class="container">
                <div class="row ">
                    <div class="col-md-8">
                        <form action="{{ route('inserts.update-column',  [$connection->id,$table,$namecolumn]) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="name column" class="form-label">Enter name of column</label>
                                <input type="text" name="namecolumn" class="form-control" id="namecolumn" value="{{ $namecolumn }}">
                              </div>
                              <button type="submit" class="btn btn-primary ">Rename</button>
                        </form>
                    </div>
                </div>
        </div>

</x-layout>