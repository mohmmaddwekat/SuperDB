<x-layout title="{{ __('Add Row') }}">

    <table class="table table-hover ">

        <thead>
            <tr>
                @foreach ($colunms as $colunm)                
                <th><span>{{ $colunm[0] }}</span><span>({{ $colunm[1] }})</span></th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            <!-- Item -->
            <form action="{{ route('super-db.inserts.store-row',[$table,$connection->id,]) }}" method="post">
                @csrf
                <tr>
                        @foreach ($colunms as $key => $colunm)                
                        <td><input type="text" name="data[]"></td>
                        @endforeach
                </tr>
                <tr>
                    <td >
                        <button class="btn btn-primary">{{ __('Add Row') }}</button>
                    </td>
                </tr>
            </form>
        </tbody>
    </table>

    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            var i = 1;

            $('#add3').click(function() {
         
            });


        });
    </script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

</x-layout>