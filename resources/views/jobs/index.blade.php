<x-layout title="Tables">

    <div class="d-grid gap-2 d-md-block">
        <a href="{{ route('connection.index') }}" class="btn btn-sm btn-primary"><i
                data-feather="skip-back"></i>Back</a>
        <a href="{{ route('jobs.sql', $connection->id) }}"><button class="btn btn-primary"
                type="button">Sql</button></a>
        <a href="{{ route('jobs.insert', $connection->id) }}"><button class="btn btn-primary"
                type="button">Insert</button></a>
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
                            <div class="d-grid gap-2 d-md-block">
                                <a href="{{ route('jobs.view-column',[$table,$connection->id]) }}"><button class="btn btn-primary" type="button">Show</button></a>
                                <a href=""><button class="btn btn-danger" type="button">Delete</button></a>
                                <a href=""><button class="btn btn-warning" type="button">Edit</button></a>
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
