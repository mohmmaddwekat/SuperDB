



<x-layout title="Tables">



    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
    <div class="row g-3">
  <div class="col-sm-7">
    <input type="text" class="form-control name" placeholder="Database New">
  </div>
  <div class="col-sm">
    <button type="button" class="btn btn-primary connection">Create</button>
  </div>
</div>
      </div>
    <div>
<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Database</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody class="body">
   
  @if (sizeof($connections) > 0) 
   @foreach ($connections as $connection)
      <tr>
        <td><a href="">{{ $connection->name }}</a></td>
        <td><a type="button" href="{{route('connection.delete', $connection->id ) }}" class="btn btn-danger">delete</a>
        <a type="button" href="{{ route('jobs.index', $connection->id ) }}" class="btn btn-primary">Show</a></td>

      </tr>
    @endforeach
        @else 
      <tr class="notfound">
        <td colspan="2">
        <h5 style="text-align: center;">There are no databases, add a new one</h5>
        </td>
      </tr>
      @endif
    <tr>

    </tr>
    
  </tbody>
</table>
    </div>
<script src="/assets/js/connectoin.js"></script>
</x-layout>
