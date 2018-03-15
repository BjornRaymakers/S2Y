document.getElementById('pagestring').innerHTML = "<strong>Scissors 2 You </strong> Dashboard";

function showPanel(pnl) {
    var style_display = document.getElementById(pnl).style.display;
    var parent_panel = document.getElementById('hiddenPanels');
    var children = parent_panel.childNodes;

    for (var i=0; i<children.length; i++) {
        if (children[i].nodeName == 'DIV') {
            children[i].style.display = 'none';
        }
    }

    if (style_display == 'none') {
        document.getElementById(pnl).style.display = 'block';
    } else {
        document.getElementById(pnl).style.display = 'none';
    }

}

function showModal(log) {
    var str ='';

    for (index = 0; index < log.length; ++index) {
        str += "<b>Actie " + (index+1) + "</b><br/>";
        str += "<i>URL: </i>" + log[index].URL + "<br/>";
        str += "<i>Duurtijd: </i>" + log[index].Duurtijd + "<br/>";
        str += "<i>Datum: </i>" + log[index].Datum + "<br/><br/>";
    }

    swal({
        title: "Bezoek overzicht",
        html: str,
        type: "info",
    })
}