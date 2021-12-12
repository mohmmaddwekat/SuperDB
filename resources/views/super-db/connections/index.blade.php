<x-layout title="{{ __('Connection') }}">

  @php
  $roles_permissions = Auth::user()->role->permissions()->pluck('code')->toArray();
       
@endphp

  <div class="d-grid gap-2 d-md-flex justify-content-md-end">
  <div class="row g-3">
<div class="col-sm-7">
  <input type="text" class="form-control name" placeholder="{{ __('Add database') }}">
</div>
<div class="col-sm">
  @if (in_array('super-db.connection.add',$roles_permissions))
  <button type="button" class="btn btn-primary connection">{{ __('Create') }}</button>
  @endif
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
        <td>{{ $connection->name }}</td>
       
        <td>
          @if (in_array('super-db.connection.delete',$roles_permissions))
          <a type="button" href="{{route('super-db.connection.delete', $connection->id ) }}" class="btn btn-danger">{{ __('Delete') }}</a>
          @endif
          @if (in_array('super-db.jobs.index',$roles_permissions))

          <a type="button" href="{{ route('super-db.jobs.index', $connection->id ) }}" class="btn btn-primary">@lang('Show') </a></td>
          @endif
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
          success: function (result) {
            if (result.length != 0) {
              $("tbody").append(
                  `<tr><td>${result[0].name}</td><td><a type="button" href="connection/delete/${result[0].id}" class="btn btn-danger">{{ __('Delete') }}</a>
                  <a type="button" href="jobs/${result[0].id}" class="btn btn-primary">@lang('Show')</a></td></tr>`
              );
              $(".notfound").remove();
              $(".name").val("");
            }
            if (result.length === 0) {
              alert("Connection is Already Exists");
            }
            
           
          },
      });
  });
});

  </script>
</x-layout>
