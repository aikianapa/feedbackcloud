$(document).undelegate(".qr-get","click");
$(document).delegate(".qr-get","click",function(){
    let place = $(this).data("place");
    let modal = wbapp.getModal();
    let url = document.location.origin+"/chat/#"+place+"/";
    $(modal).attr("id","qrModal");
    $(modal).find(".modal-body").attr("id","qrModal-body").addClass("mx-auto");
    $("#placesList").append($(modal));
    $(modal).modal("show");
    new QRCode(document.getElementById("qrModal-body"), url);
    $("#qrModal-body").append("<p>"+ url +"</p>");
});

$("#placesList[data-api]").trigger("click");

var placesListTpl = $("#placesList template").html()
console.log(placesListTpl);
function placesList(data) {
  var ractive = Ractive({
    target: "#placesList",
    template: placesListTpl,
    data: data
  });
}
