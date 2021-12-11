



<x-layout title="{{ __('Connectopin') }}">
  <div id="errDiv">

  </div>

    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
    <div class="row g-3">
  <div class="col-sm-7">
    <input type="text" class="form-control name" placeholder="{{ __('Add database') }}">
  </div>
  <div class="col-sm">
    <button type="button" class="btn btn-primary connection">{{ __('Create') }}</button>
  </div>
</div>
      </div>
    <div>
<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">{{ __('Database') }}</th>
      <th scope="col">{{ __('Action') }}</th>
    </tr>
  </thead>
  <tbody class="body">
    @if (sizeof($connections) > 0) 
    @foreach ($connections as $connection)
        <tr>
          <td><a href="">{{ $connection->name }}</a></td>
          <td><a type="button" href="{{route('super-db.connection.delete', $connection->id ) }}" class="btn btn-danger">{{ __('Delete') }}</a>
          <a type="button" href="{{ route('super-db.jobs.index', $connection->id ) }}" class="btn btn-primary">@lang('Show') </a></td>
        </tr>
      @endforeach
          @else 
        <tr class="notfound">
          <td colspan="2">
          <h5 style="text-align: center;">{{ __('There are no databases, add a new one') }}</h5>
          </td>
        </tr>
        @endif
      <tr>
      </tr>
  </tbody>
</table>
    </div>

    <script>
$(document).ready(function () {
    $(".connection").click(function () {
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: "connection/add/" + $(".name").val(),
            // contentType: "application/json; charset=utf-8",
            type: "POST",
            dataType: "json",
            error: function (xhr, status, err) {
          
          var jsonResponse = JSON.parse(xhr.responseText);
         viewError("Error", Object.values(jsonResponse)[0]);
         
           
            },
            success: function (result) {
          
                $("tbody").append(
                    `<tr><td>${result[0].name}</td><td><a type="button" href="connection/delete/${result[0].id}" class="btn btn-danger">{{ __('Delete') }}</a>
                    <a type="button" href="jobs/${result[0].id}" class="btn btn-primary">@lang('Show')</a></td></tr>`
                );
                $(".notfound").remove();
                $(".name").val("");
            },
        });
    });
});

    </script>
</x-layout>
