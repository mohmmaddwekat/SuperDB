<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
  <br>
  <br>
  <br>
  <div class="container">
    <div class="row g-3">
  <div class="col-sm-7">
    <input type="text" class="form-control name" placeholder="Database New">
  </div>
  <div class="col-sm">
    <button type="button" class="btn btn-primary connection">Create</button>
  </div>
</div>
<br>
<br>
<table class="table">
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
        <td><a type="button" href="connection/delete/{{$connection->id}}" class="btn btn-danger">delete</a></td>
        <td><a type="button" href="{{ route('jobs.index', $connection->id ) }}" class="btn btn-danger">Show</a></td>

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
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>