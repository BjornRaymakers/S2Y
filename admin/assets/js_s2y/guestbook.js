document.getElementById('pagestring').innerHTML = "<strong>Scissors2 You </strong>Gastenboek";

function toggleVisibility($id) {
    $.ajax({
        type: 'POST',
        url: '/admin/assets/functions/process.php',
        data: "&class=guestbook&action=toggle&id=" + $id
    })
        .done(function (data) {
            window.location = "guestbook.php";
        });
    return false;
}

function deleteMessage($id) {
    swal({
        title: "Wil je verder gaan?",
        text: 'Wilt u dit bericht verwijderen?',
        type: "warning",
        showCancelButton: true,
        showConfirmButton: true,
        cancelButtonText: 'Annuleer',
        confirmButtonText: 'Verwijder',
        dangerMode: true,
    })
        .then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: '/admin/assets/functions/process.php',
                    data: "&class=guestbook&action=del&id=" + $id
                })
                    .done(function (data) {
                        window.location = "guestbook.php";
                    });
                return false;
            }
        });
}