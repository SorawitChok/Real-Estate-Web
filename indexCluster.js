var divcount = document.getElementById("count");
var count = divcount.textContent;

var locations = [];

for(i= 0; i<count; i++)
{
  var latlng = [];
  var div = document.getElementById(i+'lat');
  var div2 = document.getElementById(i+'lng');
  var myDatalat = div.textContent;
  var myDatalng = div2.textContent;
  latlng.push(myDatalat);
  latlng.push(myDatalng);
  locations.push(latlng);
}

var my_locations = [];

for(i = 0; i<count; i++)
{
  var x = {lat: parseFloat(locations[i][0]) ,lng: parseFloat(locations[i][1])};
  my_locations.push(x);
}



function initMap() {
  if(my_locations.length<1)
  {
      const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 10,
        center: { lat: -34.397, lng: 150.644 },
      });
  }
  else{
    const map = new google.maps.Map(document.getElementById("map"), {
      zoom: 10,
      center: {lat: parseFloat(locations[0][0]) ,lng: parseFloat(locations[0][1])},
    });
    const markers = my_locations.map((location, i) => {
      return new google.maps.Marker({
        position: location,
      });
    });
  
    const markerCluster = new markerClusterer.MarkerClusterer({ map, markers });
  
    new markerCluster({ markers, map });
  }
}
