<x-layout title="Tabel">

    <div class="d-grid gap-2 d-md-block">
        <a href="{{ route('jobs.index', $connection->id) }}" class="btn btn-sm btn-primary"><i
                data-feather="skip-back"></i>Back</a>

    </div>
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a href="{{ route('db.export', [$connection->id,$table ]) }}"><button class="btn btn-primary"
                type="button">Exprt</button></a>
      </div>
    <div>
    <div>
        <table class="table table-hover">

            <thead>
                <tr>

                    <th>#</th>
                    @foreach ($colunms as $key => $colunm)
                        <th>
                            <div class="d-grid gap-2 d-md-flex ">

                            
                            <span class="font-weight-normal">{{ $colunm[0] }}</span>
                            <form action="{{ route('jobs.delete-column', [$connection->id,$table,$colunm[0]]) }}" method="post" class="mx-2">
                                @csrf
                                @method('delete')
                                <button type="submit" class="text-danger p-0 m-0 border-0 bg-white " >Delete/</button>
                            </form>
                            <a href="{{ route('inserts.rename-column', [$connection->id,$table,$colunm[0]]) }}" >Rename</a>
                        </div>
                        </th>
                    @endforeach
                    <th>Option</th>
                </tr>
            </thead>
            <tbody>
                <!-- Item -->
                @foreach ($rows as $key => $row)

                    <tr>
                        <th><span class="font-weight-normal">{{ $key }}</span></th>

                        @foreach ($colunms as $colunm)
                            <th><span class="font-weight-normal">{{ $row[$colunm[0]] }}</span></th>
                            
                        @endforeach
                        <th> <a href="" ><span class="font-weight-normal">Delete</span></a></th>
                    </tr>
                @endforeach


            </tbody>
        </table>
    </div>


</x-layout>
