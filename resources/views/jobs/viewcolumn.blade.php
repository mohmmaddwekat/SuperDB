<x-layout title="Tabel">

    <div class="d-grid gap-2 d-md-block">
        <a href="{{ route('jobs.index', $connection->id) }}" class="btn btn-sm btn-primary"><i
                data-feather="skip-back"></i>Back</a>

    </div>

    <div>
        <table class="table table-hover">

            <thead>
                <tr>

                    <th>#</th>
                    @foreach ($colunms as $key => $colunm)
                        <th><span class="font-weight-normal">{{ $colunm[0] }}</span></th>
                    @endforeach

                </tr>
            </thead>
            <tbody>
                <!-- Item -->


                @foreach ($rows as $key => $col)

                    <tr>
                        <th><span class="font-weight-normal">{{ $key }}</span></th>
                        @foreach ($colunms as $colunm)
                            <th><span class="font-weight-normal">{{ $col[$colunm[0]] }}</span></th>
                        @endforeach
                    </tr>
                @endforeach


            </tbody>
        </table>
    </div>


</x-layout>
