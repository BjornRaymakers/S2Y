document.getElementById('pagestring').innerHTML = "<strong>Scissors2 You </strong>Afspraak";

function inputModal() {
    swal({
        input: 'text',
        inputPlaceholder: 'Geef de nieuwe kleurcode in',
        showCancelButton: true,
        inputValidator: function inputValidator(value) {
            return !value && 'Ongeldige invoer!';
        }
    })
        .then((value) => {
            let sel = document.getElementById('haircolor');
            let opt = document.createElement('option');
            let val = value.value;

            opt.textContent = val;
            opt.selected = true;
            sel.add(opt);
        });
}

function viewBill() {
    window.location = 'bill?id=' + document.getElementById('appid').value;
}

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

function checkAppointment(createabill) {
    let cust = document.getElementById("custid");
    let cust_id = cust.value;

    if (cust_id < 1000) {
        if (custlookalike.length > 0) {
            let alertstring = 'Er is momenteel een tijdelijke klant geselecteerd, hoewel er vergelijkbare klanten zijn terug gevonden:<br><br>';
            custlookalike.forEach(function (customer) {
                alertstring += customer['id'] + ' - ' + customer['fullname'] + ' - ' + customer['street'] + ' ' + customer['housenumber'] + ', ' + customer['pcode'] + ' ' + customer['city'] + '<br>';
            });

            alertstring += '\n';

            swal({
                title: "Wil je verder gaan?",
                html: alertstring,
                type: "warning",
                showCancelButton: true,
                showConfirmButton: true,
                cancelButtonText: 'Annuleer',
                confirmButtonText: 'Ga verder',
                dangerMode: true
            })
                .then((result) => {
                    if (result.value) {
                        saveAppointment(createabill);
                    }
                });
        } else {
            saveAppointment(createabill);
        }
    } else {
        saveAppointment(createabill);
    }

}

function saveAppointment(createabill) {
    $.ajax({
        type: 'POST',
        url: '/admin/assets/functions/process.php',
        data: $('#appointmentform').serialize() + "&class=appointment&action=save"
    })
        .done(function (data) {
            dt = JSON.parse(data);
            document.getElementById("responseH").innerHTML = dt['string'];

            if (dt['id'] !== '') {
                appid = dt['id'];
                document.getElementById("appid").value = dt['id'];
            } else {
                appid = document.getElementById("appid").value;
            }

            jQuery(document).ready(function () {
                window.scroll({top: 0, left: 0, behavior: 'smooth' });
            });

            if (createabill === true) {
                createBill(appid);
            }

            $('#response').html(data);

        });
    return false;
}

function createBill(appid) {
    $.ajax({
        type: 'POST',
        url: '/admin/assets/functions/process.php',
        data: "&class=appointment&action=bill&id=" + appid
    })
        .done(function (data) {
            dt = JSON.parse(data);
            document.getElementById("responseH").innerHTML = dt['string'];
            billid = dt['id'];

            jQuery(document).ready(function () {
                window.scroll({top: 0, left: 0, behavior: 'smooth' });
            });

            if (dt['redirect']) {
                window.setTimeout(function () {
                    window.location = "bill?id=" + billid;
                }, 1500);
            }
            $('#response').html(data);

        });
    return false;
}

function checkGift() {
    let icowarn = "icon-warning fas fa-exclamation-circle fa-spin";
    let icoinfo = "icon-information fas fa-exclamation-circle fa-spin";

    let ele = document.getElementById('giftdetails');
    let eleicon = document.getElementById('gifticon');

    let uid = document.getElementById('giftuid').value;

    ele.innerText = "Geen geldige code";
    eleicon.classList = icowarn;

    if (uid.length > 3) {
        for (index = 0; index < gifts.length; ++index) {
            if (gifts[index].uniqid === uid) {
                if (gifts[index].valid === true) {
                    eleicon.classList = icoinfo;
                    ele.innerText = gifts[index].validstring + " tot " + gifts[index].expires + " (€ " + gifts[index].amount + ")";
                } else {
                    eleicon.classList = icowarn;
                    ele.innerText = gifts[index].validstring + " (Deze bon was geldig tot " + gifts[index].expires + ")";
                }
            }
        }
    }
}

function showTreatmentDivs() {
    if (appointment.action2.id === null) document.getElementById('divaction2').style.display = 'none';
    if (appointment.action3.id === null) document.getElementById('divaction3').style.display = 'none';
    if (appointment.action4.id === null) document.getElementById('divaction4').style.display = 'none';
    if (appointment.action5.id === null) document.getElementById('divaction5').style.display = 'none';
    if (appointment.action6.id === null) document.getElementById('divaction6').style.display = 'none';
}

function addTreatmentDiv() {
    let divs = ['divaction1', 'divaction2', 'divaction3', 'divaction4', 'divaction5', 'divaction6'];

    for (index = 0; index < divs.length; ++index) {
        let ele = document.getElementById(divs[index]);
        if (ele.style.display === 'none') {
            ele.style.display = 'block';
            break;
        }
    }
}

function deleteTreatmentDiv() {
    let divs = ['divaction1', 'divaction2', 'divaction3', 'divaction4', 'divaction5', 'divaction6'];

    for (index = divs.length -1 ; index > 0; --index) {
        let ele = document.getElementById(divs[index]);
        if (ele.style.display === 'block') {
            ele.style.display = 'none';
            break;
        }
    }
}

function calculateTreatments() {
    let total = 0;
    let error = false;

    //Treatments
    for (i = 1; i < 7; ++i) {
        let val = document.getElementById('action' + i).value;
        if (val !== '') {
            let specifier = document.getElementById('hairtype').value;
            for (index = 0; index < actions.length; ++index) {
                if (actions[index].id === val) {
                    if (specifier === '') {
                        document.getElementById('hairtype').style.borderColor = "red";
                    } else {
                        if (actions[index].price2 === '') {
                            total = total + parseFloat(actions[index].price1);
                        } else {
                            if (actions[index].price1_comment === specifier) {
                                total = total + parseFloat(actions[index].price1);
                            } else if (actions[index].price2_comment === specifier) {
                                total = total + parseFloat(actions[index].price2);
                            } else {
                                error = true;
                            }
                        }
                    }

                }
            }
        }
    }

    //Afspraakkorting
    let appred = parseFloat(document.getElementById('reduction').value);
    if (appred > 0) {
        let reduction = (total / 100) * appred;
        total = total - reduction;
    }

    //KM vergoeding
    let custid = document.getElementById('custid').value;
    if (custid !== '') {
        for (index = 0; index < clients.length; ++index) {
            if (clients[index].id === custid) {
                let totalkm = clients[index].total_km;
                if (parseFloat(totalkm) > 10) {
                    total = total + (parseFloat(totalkm) * 0.25);
                }
            }
        }
    } else {
        error = true;
    }

    //Cadeaubon

    if (error) {
        swal({
            title: "Fout!",
            text: 'Niet alle velden zijn correct ingevuld!',
            type: "error",
            dangerMode: true
        });
    } else {
        document.getElementById('createbillli').innerText = "Afrekenen (€ " + total + ")";
    }
}

function deleteAppointment() {
    $id = document.getElementById("appid").value;

    if ($id === '') {
        swal({
            title: "Fout!",
            text: 'Geen afspraak gevonden met deze ID!',
            type: "error",
            dangerMode: true
        });
    }
    else {
        swal({
            title: "Wil je verder gaan?",
            text: 'Wilt u afspraak ' + $id + ' verwijderen?',
            type: "question",
            showCancelButton: true,
            showConfirmButton: true,
            cancelButtonText: 'Annuleer',
            confirmButtonText: 'Verwijder',
            dangerMode: true
        })
            .then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: '/admin/assets/functions/process.php',
                        data: $('#appointmentform').serialize() + "&class=appointment&action=del"
                    })
                        .done(function (data) {
                            dt = JSON.parse(data);
                            document.getElementById("responseH").innerHTML = dt['string'];

                            jQuery(document).ready(function () {
                                window.scroll({top: 0, left: 0, behavior: 'smooth' });
                            });

                            if (dt['redirect']) {
                                window.setTimeout(function () {
                                    window.location = "appointments.php";
                                }, 1500);
                            }

                        });
                    return false;
                }
            });
    }
}