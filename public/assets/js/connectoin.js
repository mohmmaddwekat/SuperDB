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
                    `<tr><td><a href="">${result[0].name}</a></td><td><a type="button" href="connection/delete/${result[0].id}" class="btn btn-danger">delete</a>
                    <a type="button" href="{{ route('jobs.index', ${result[0].id} ) }}" class="btn btn-primary">Show</a></td></tr>`
                );
                $(".notfound").remove();
            },
        });
    });
});
