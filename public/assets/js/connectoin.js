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
                alert(err);
            },
            success: function (result) {
                console.log(result[0]);
                $("tbody").append(
                    `<tr><td><a href="">${result[0].name}</a></td><td><a type="button" href="connection/delete/${result[0].id}" class="btn btn-danger">delete</a></td></tr>
                    <td><a type="button" href="{{ route('jobs.index', ${connection[0].id} ) }}" class="btn btn-primary">Show</a></td>`
                );
                $(".notfound").remove();
            },
        });

        // $.ajax({
        //     headers: {
        //         "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        //     },
        //     type: "POST",
        //     url: "connection/add/" + $(".name").val(),
        //     data: "",
        //     error: function (xhr, status) {
        //         alert(status);
        //     },
        //     success: function (data) {
        //         console.log("dddd");
        //         $("tbody").html(
        //             "<tr><td>" +
        //                 data +
        //                 "</td></tr><a type='button' href='' class='btn btn-danger'>delete</a></td>"
        //         );
        //     },
        // });
    });
});
