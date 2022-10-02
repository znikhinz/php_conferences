function delete_conf(id){
  $("#confirmationForm").attr("action", "/public/delete.php?id=" + id)
  $("#confirmation").modal('show')
}

var marker, map;

function map_gen(draggable, pos_x=null, pos_y=null){
  return function initMap() {
    const lat = parseFloat($("#lat").val());
    const long = parseFloat($("#lng").val());
    const uluru = (lat && long) ? { lat: lat, lng: long} : {lat: 50.450001, lng:  30.523333};

    map = new google.maps.Map(document.getElementById("map"), {
      zoom: 9,
      center: uluru,
      draggable: draggable
    });

    if (lat && long || draggable){
      marker = new google.maps.Marker({
        position: uluru,
        map: map,
        draggable: draggable
      });

      marker.addListener("dragend", () => {
        $("#lat").val(marker.position.lat());
        $("#lng").val(marker.position.lng());
      })
    }
  }
}

window.initMap = map_gen(draggable=$("#editable").attr('value') == "true");

function deleteMarker(){
  marker.setPosition();
  
  $("#lat").val("");
  $("#lng").val("");
}