<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="dist/jquery.add-input-area.min.js"></script>

    <title>Document</title>
</head>

<body>




    <div class="main-content container-fluid">
        <div class="container py-5 vh-100 h-100">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $message)
                            <li>

                                {{ $message }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{ session()->get('success') }}
                </div>
            @endif

            @if (session()->has('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session()->get('error') }}
                </div>
            @endif



            <div class="container">
                <div class="row ">
                    <div class="col"></div>
                    <div class="col-md-8">
                        <form action="{{ route('jobs.store-feature') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="name table" class="form-label">Enter name of table</label>
                                <input type="text" name="nametable" class="form-control" id="nametable">
                              </div>

                            <fieldset>
                                <div id="dynamic_field3" >
                                    <div class="form-row">

                                        <div class="col m-3">
                                            <td><button type="button" name="add" id="add3" class="btn btn-success"><i
                                                        class="fa fa-plus"></i>Add row</button></td>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="form-row"><br>
                                    <div class="col">
                                        <button type="submit" id='submit' name="submit" class="btn btn-primary "
                                            value="Save">Save the form data</button>
                                    </div>
                                </div>
                                <br>
                        </form>
                        </fieldset>
                    </div>
                    <div class="col"></div>
                </div>
            </div>

            <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
            <script>
                $(document).ready(function() {
                    var i = 1;

                    $('#add3').click(function() {
                        i++;
                        $('#dynamic_field3').append('<div class="form-row m-3" id="row3' + i +
                            '"> <div class="col"> <input type="text" class="form-control"  name="colunm[]"> </div> <div class="col"> <select class="form-select" name="type[]" aria-label="Default select example"><option selected>select Type</option><option value="int">int</option><option value="varchar">varchar</option></select> </div> <div class="col"> <td><button type="button" name="add"  class="btn btn-danger btn_remove3" id="' +
                            i + '"><i class="fa fa fa-trash"></i>Remove</button></td> </div> </div>');
                    });
                    $(document).on('click', '.btn_remove3', function() {
                        var button_id = $(this).attr("id");

                        $('#row3' + button_id + '').remove();
                    });

                });
            </script>
            <!-- JavaScript Bundle with Popper -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
                        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
            </script>

</body>

</html>
