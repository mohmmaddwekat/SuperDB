<x-layout title="Tables">

    <div class="d-grid gap-2 d-md-block">
        <a href="{{ route('connection.index') }}" class="btn btn-sm btn-primary"><i
                data-feather="skip-back"></i>Back</a>
        <a href="{{ route('sqls.index', $connection->id) }}"><button class="btn btn-primary"
                type="button">Sql</button></a>
        <a href="{{ route('inserts.index', $connection->id) }}"><button class="btn btn-primary"
                type="button">Insert</button></a>
    </div>

    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a href="{{ route('import.index', $connection->id) }}" class="mr-2"><button class="btn btn-primary"
            type="button">Import</button></a>
        <a href="{{ route('db.export', $connection->id) }}"><button class="btn btn-primary"
                type="button">Exprt</button></a>
      </div>
    <div>
        <table class="table table-hover">

            <thead>
                <tr>

                    <th>#</th>
                    <th>Name</th>
                    <th >Option</th>
                    <th></th>
                    <th scope="3"></th>

                </tr>
            </thead>
            <tbody>
                <!-- Item -->
                @forelse ($tables as $key => $table )
                    <tr>

                        <td><span class="font-weight-normal">{{ $key }}</span></td>
                        <td><span class="font-weight-normal">{{ $table }}</span></td>
                        <td>
                            <div class="d-grid gap-2 d-md-flex ">
                                <a href="{{ route('jobs.view-column',[$table,$connection->id]) }}"><button class="btn btn-primary" type="button">Show</button></a>
                                <form action="{{ route('jobs.delete-table',[$connection->id,$table]) }}" method="post" class="mx-2">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                                <a href="{{ route('inserts.rename-table',[$connection->id,$table]) }}"><button class="btn btn-warning" type="button">Rename</button></a>
                            </div>

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10">
                            No Tables Found.
                        </td>
                    </tr>
                @endforelse


            </tbody>
        </table>
    </div>


</x-layout>
