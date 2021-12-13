<x-layout :title="__('Tables')">
    @php
    $roles_permissions = Auth::user()->role->permissions()->pluck('code')->toArray();
         
  @endphp

    <div class="d-grid gap-2 d-md-block">
        @if (in_array('super-db.connection.index',$roles_permissions))
        <a href="{{ route('super-db.connection.index') }}" class="btn btn-sm btn-primary"><i
                data-feather="skip-back"></i>{{ __('Back') }}</a>
        @endif
        @if (in_array('super-db.sqls.index',$roles_permissions))
        <a href="{{ route('super-db.sqls.index', $connection->id) }}"><button class="btn btn-primary"
                type="button">Sql</button></a>
        @endif
        @if (in_array('super-db.inserts.index',$roles_permissions))
        <a href="{{ route('super-db.inserts.index', $connection->id) }}"><button class="btn btn-primary"
                type="button">{{ __('Insert') }}</button></a>
        @endif        
    </div>

    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        @if (in_array('super-db.import.index',$roles_permissions))
        <a href="{{ route('super-db.import.index', $connection->id) }}" class="mr-2"><button class="btn btn-primary" type="button">{{ __('Import') }}</button></a>
        @endif
        @if (in_array('super-db.versionControl.index',$roles_permissions))
        <a href="{{ route('super-db.versionControl.index', $connection->id) }}" class="mr-2"><button class="btn btn-primary" type="button">{{ __('Version Control') }}</button></a>
        @endif 

        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            {{ __('Export') }}
        </button>

    </div>
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content main-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel"><span class="font-weight-normal">{{ __('Select method you want to export data') }}</span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex justify-content-center">
                    @if (in_array('super-db.db.export',$roles_permissions))
                    <a href="{{ route('super-db.db.export', [$connection->id, 'sql']) }}" class="mx-2"><button
                            class="btn btn-primary" type="button">Sql {{ __('File') }}</button></a>
                            @endif     
                    @if (in_array('super-db.db.export',$roles_permissions))        
                    <a href="{{ route('super-db.db.export', [$connection->id, 'csv']) }}"><button class="btn btn-primary"
                            type="button">Csv {{ __('File') }}</button></a>
                            @endif 
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
                                @if (in_array('super-db.jobs.view-column',$roles_permissions))
                                <a href="{{ route('super-db.jobs.view-column', [$table, $connection->id]) }}"><button
                                        class="btn btn-primary" type="button">{{ __('Show') }}</button></a>
                                @endif
                                @if (in_array('super-db.jobs.delete-table',$roles_permissions))            
                                <form action="{{ route('super-db.jobs.delete-table', [$connection->id, $table]) }}" method="post"
                                    class="mx-2">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
                                </form>
                                @endif
                                @if (in_array('super-db.inserts.rename-table',$roles_permissions))     
                                <a href="{{ route('super-db.inserts.rename-table', [$connection->id, $table]) }}"><button
                                        class="btn btn-warning" type="button">{{ __('Rename') }}</button></a>
                                        @endif
                            </div>

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10">
                            <span class="font-weight-normal">{{ __('No Tables Found.') }}</span>
                        </td>
                    </tr>
                @endforelse


            </tbody>
        </table>
    </div>


</x-layout>
