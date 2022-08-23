function loadData() {
    $("#content").load("contacts.php", () => {
        $("#loader").hide();
    })
}

function showGame() {
    setTimeout(loadData, 1000);
}

function showPaginate(start) {
    $("#content").load("paginate.php?id=" + start, () => {
        $("#loader").hide();
    })
}

function paginate(start) {
    setTimeout(showPaginate(start), 1000);
}

$(document).ready(function () {
    $("#loader").show();
    showGame();

    $("#addGame").submit(function (e) {
        e.preventDefault();
        let frmData = new FormData($("#addGame")[0]);

        $.ajax({
            type: "POST",
            url: "add_contacts.php",
            data: frmData,
            processData: false,
            contentType: false,
            beforeSend: function () {
                $("#loader").show();
            },
            success: function (res) {
                if (res == "true") {
                    alert("Data updated");
                    $(".modal").modal('hide');
                    $("#addGame")[0].reset();
                    showGame();
                } else {
                    alert(res);
                    $("#loader").hide();
                }
            },
            error: function (res) {
                console.log(res);
            }
        })
    });

    $(document).on("submit", ".editGame", function (e) {
        e.preventDefault();
        // let frmData = new FormData($(".editGame"));

        $.ajax({
            type: "POST",
            url: "updateGame.php",
            data: new FormData(this),
            processData: false,
            contentType: false,
            beforeSend: function () {
                $("#loader").show();
            },
            success: function (res) {
                if (res == "true") {
                    alert("Data updated");
                    $(".modal").modal('hide');
                    $(".editGame")[0].reset();
                    showGame();
                } else {
                    alert(res);
                    $("#loader").hide();
                }
            },
        })
    });

    $(document).on('submit', "#deleteData", function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "delete.php",
            data: $(this).serialize(),
            beforeSend: function () {
                $("#loader").show();
            },
            success: function (res) {
                // showGame();
                alert(res);
                showGame();
            },
            error: function (res) {
                console.log(res);
            }
        })
    })

    $("#content ").on("click", ".page-link", function (e) {
        e.preventDefault();
        
        let start = $(this).attr("data-start");

        // let end = $(this).attr("data-end");

        paginate(start);

        // $.ajax({
        //     type: "POST",
        //     url: "paginate.php",
        //     data: { "start": start, "end": end },
        //     beforeSend: function () {
        //         $("#loader").show();
        //     },
        //     success: function (res) {
        //         paginate(start);
        //     },
        //     error: function (res) {
        //         console.log(res);
        //     }
        // })

    })


    // $(".delete").each(function () {
    //     $(this).on("click", function (e) {
    //         e.preventDefault();
    //         console.log("it works");
    //         let data = $(this).attr("data-delete");
    //         console.log(data);
    //     })
    // })

})

