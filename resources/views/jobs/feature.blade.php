<x-layout title="Add Query">
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

</x-layout>