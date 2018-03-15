document.getElementById('pagestring').innerHTML = "<strong>Scissors 2 You </strong>Afspraak";

var i = 1;
var max = 5

function setBorderBackToOriginal(elename) {
    document.getElementById(elename).style.borderColor = null;
}

function validateAppointmentForm() {
    var errorreturn = true;
    var ele = getAllElementsWithAttribute('required');
    ele.forEach(function(entry) {
        if (entry.value == "") {
            entry.style.borderColor = "#ff8080";
            errorreturn = false;
        }
    });
    return errorreturn;
}

function getAllElementsWithAttribute(attribute)
{
    var matchingElements = [];
    var allElements = document.getElementsByTagName('*');
    for (var i = 0, n = allElements.length; i < n; i++)
    {
        if (allElements[i].getAttribute(attribute) !== null)
        {
            // Element exists with attribute. Add to array.
            matchingElements.push(allElements[i]);
        }
    }
    return matchingElements;
}

function duplicate() {

    if (i == max ) {
        document.getElementById('buttonaddtreatment').style.display = 'none';
    }

    var j = ++i;
    var ins_before = document.getElementById('buttonaddtreatment');

    var select_original = document.getElementById('duplicater1');
    var select_clone = select_original.cloneNode(true); // "deep" clone

    select_clone.childNodes[1].childNodes[1].id = 'treatment' + j;
    select_clone.childNodes[1].childNodes[1].name = 'treatment' + j;

    select_clone.id = "duplicater" + j;
    select_clone.name = "duplicater" + j;

    parentns = ins_before.parentNode;
    parentns.insertBefore(select_clone, ins_before);
}

function saveNewAppointment() {
    if (validateAppointmentForm() == true) {
        $.ajax({
                type: 'POST',
                url: '/assets/functions/process.php',
                data: $('#newappointmentform').serialize() + "&class=appointment"
            })
            .done(function (data) {
                dt = JSON.parse(data);
                window.location = 'thanks.php?id=' + dt['code'] + '&fname=' + dt['fname'];
                $('#response').html(data);

            });
    }
}