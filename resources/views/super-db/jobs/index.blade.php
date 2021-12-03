<x-layout :title="__('Tables')">

    <div class="d-grid gap-2 d-md-block">
        <a href="{{ route('super-db.connection.index') }}" class="btn btn-sm btn-primary"><i
                data-feather="skip-back"></i>{{ __('Back') }}</a>
        <a href="{{ route('super-db.sqls.index', $connection->id) }}"><button class="btn btn-primary"
                type="button">Sql</button></a>
        <a href="{{ route('super-db.inserts.index', $connection->id) }}"><button class="btn btn-primary"
                type="button">{{ __('Insert') }}</button></a>
    </div>

    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a href="{{ route('super-db.import.index', $connection->id) }}" class="mr-2"><button class="btn btn-primary" type="button">{{ __('Import') }}</button></a>

        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            {{ __('Export') }}
        </button>

    </div>
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">{{ __('Select method you want to export data') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex justify-content-center">
                    <a href="{{ route('super-db.db.export', [$connection->id, 'sql']) }}" class="mx-2"><button
                            class="btn btn-primary" type="button">Sql {{ __('File') }}</button></a>
                    <a href="{{ route('super-db.db.export', [$connection->id, 'csv']) }}"><button class="btn btn-primary"
                            type="button">Csv {{ __('File') }}</button></a>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
                </div>
            </div>
        </div>
    </div>


    <div>
        <table class="table table-hover">

            <thead>
                <tr>

                    <th>#</th>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Options') }}</th>
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
                                <a href="{{ route('super-db.jobs.view-column', [$table, $connection->id]) }}"><button
                                        class="btn btn-primary" type="button">{{ __('Show') }}</button></a>
                                <form action="{{ route('super-db.jobs.delete-table', [$connection->id, $table]) }}" method="post"
                                    class="mx-2">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
                                </form>
                                <a href="{{ route('super-db.inserts.rename-table', [$connection->id, $table]) }}"><button
                                        class="btn btn-warning" type="button">{{ __('Rename') }}</button></a>
                            </div>

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10">
                            {{ __('No Tables Found.') }}
                        </td>
                    </tr>
                @endforelse


            </tbody>
        </table>
    </div>


</x-layout>
