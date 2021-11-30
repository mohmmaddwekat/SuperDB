<x-layout :title="__('Table')">

    <div class="d-grid gap-2 d-md-block">
        <a href="{{ route('jobs.index', $connection->id) }}" class="btn btn-sm btn-primary"><i
                data-feather="skip-back"></i>{{ __('Back') }}</a>

    </div>
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
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
                    <a href="{{ route('db.export', [$connection->id, 'sql',$table]) }}" class="mx-2"><button
                            class="btn btn-primary" type="button">Sql {{ __('File') }}</button></a>
                    <a href="{{ route('db.export', [$connection->id, 'csv',$table]) }}"><button class="btn btn-primary"
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
                    @foreach ($colunms as $key => $colunm)
                        <th>
                            <div class="d-grid gap-2 d-md-flex ">

                            
                            <span class="font-weight-normal">{{ $colunm[0] }}</span>
                            <form action="{{ route('jobs.delete-column', [$connection->id,$table,$colunm[0]]) }}" method="post" class="mx-2">
                                @csrf
                                @method('delete')
                                <button type="submit" class="text-danger p-0 m-0 border-0 bg-white " >{{ __('Delete') }}/</button>
                            </form>
                            <a href="{{ route('inserts.rename-column', [$connection->id,$table,$colunm[0]]) }}" >{{ __('Rename') }}</a>
                        </div>
                        </th>
                    @endforeach
                    <th>{{ __('Options') }}</th>
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
                        <th> <a href="" ><span class="font-weight-normal">{{ __('Delete') }}</span></a></th>
                    </tr>
                @endforeach


            </tbody>
        </table>
    </div>


</x-layout>
