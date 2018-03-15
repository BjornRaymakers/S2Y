document.getElementById('pagestring').innerHTML = "<strong>Scissors 2 You </strong>Contact";

function setBorderBackToOriginal(elename) {
    document.getElementById(elename).style.borderColor = null;
}

function sendMessage() {
    if (validateContactForm() == true) {
        $.ajax({
                type: 'POST',
                url: '/assets/functions/process.php',
                data: $('#newmail').serialize() + "&class=contact"
            })
            .done(function (data) {
                dt = JSON.parse(data);
                window.location = 'thanks.php?id=' + dt['code'] + '&fname=' + dt['fname'];
                $('#response').html(data);
            });
    }
}

function validateContactForm() {
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