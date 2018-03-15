document.getElementById('pagestring').innerHTML = "<strong>Scissors2 You </strong>Afspraken";

function sendAppointmentMail(appointment, firstmail) {
    if (firstmail === false) {
        swal({
            title: "Wil je verder gaan?",
            html: "Er is al reeds een mail gestuurd, wil je de afspraak nogmaals versturen?",
            showCancelButton: true,
            showConfirmButton: true,
            cancelButtonText: 'Annuleer',
            confirmButtonText: 'Verzend',
            dangerMode: true
        })
            .then((result) => {
                if (result.value) {
                    sendMail(appointment);
                }
            });
    } else {
        sendMail(appointment);
    }
}

function sendMail(appointment) {
    $.ajax({
        type: 'POST',
        url: '/admin/assets/functions/process.php',
        data: "&appid=" + appointment + "&class=appointment&action=mail"
    })
        .done(function (data) {
            dt = JSON.parse(data);

            if (dt['send'] === true) {
                swal({
                    title: "Je mail is verzonden.",
                    type: "success",
                    closeOnClickOutside: true,
                    timer: 3000
                });
            } else {
                swal({
                    title: "Je mail is niet verzonden!",
                    type: "warning",
                    closeOnClickOutside: true
                });
            }
            jQuery(document).ready(function () {
                window.scroll({top: 0, left: 0, behavior: 'smooth' });
            });

            $('#response').html(data);

        });
    return false;
}
