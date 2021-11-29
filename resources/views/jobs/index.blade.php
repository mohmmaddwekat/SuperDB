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
        <a href="" class="mr-2"><button class="btn btn-primary" type="button">Import</button></a>

        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            Exprt
        </button>

    </div>
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Select method you wint to export data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex justify-content-center">
                    <a href="{{ route('db.export', [$connection->id, 'sql']) }}" class="mx-2"><button
                            class="btn btn-primary" type="button">Sql File</button></a>
                    <a href="{{ route('db.export', [$connection->id, 'csv']) }}"><button class="btn btn-primary"
                            type="button">Csv File</button></a>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <div>
        <table class="table table-hover">

            <thead>
                <tr>

                    <th>#</th>
                    <th>Name</th>
                    <th>Option</th>
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
                                <a href="{{ route('jobs.view-column', [$table, $connection->id]) }}"><button
                                        class="btn btn-primary" type="button">Show</button></a>
                                <form action="{{ route('jobs.delete-table', [$connection->id, $table]) }}" method="post"
                                    class="mx-2">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                                <a href="{{ route('inserts.rename-table', [$connection->id, $table]) }}"><button
                                        class="btn btn-warning" type="button">Rename</button></a>
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
