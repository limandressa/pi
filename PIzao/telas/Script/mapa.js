var latRef = 0.0;
var nomeBairro = ""; 

function initMap() {
  var uluru = {lat: -26.952, lng: -48.639};
  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 15,
    mapTypeId: google.maps.MapTypeId.SATELLITE,
    center: uluru
  });

  var pinIcon2 = new google.maps.MarkerImage(
    "marcadorverde.png", //
    null, /* size is determined at runtime */
    null, /* origin is 0,0 */
    null, /* anchor is bottom center of the scaled image */
    new google.maps.Size(150, 145)
    );

  var pinIcon = new google.maps.MarkerImage(
    "marcadorvermelho.png",
    null, /* size is determined at runtime */
    null, /* origin is 0,0 */
    null, /* anchor is bottom center of the scaled image */
    new google.maps.Size(150, 145)
    );

  var collection = new Array();
  var aux = pinIcon2;
  var i = 1;

  async function buscar() {

    var request = await fetch('../api/bairro/buscar.php')
    var response = await request.json()

    response.forEach(marcador => {
        // console.log(marcador)

        if (marcador.perigo > marcador.seguro && marcador.perigo > (marcador.quantidadeU * 0.2)) {
          aux = pinIcon;  
        } else {
          aux = pinIcon2;
        }


        collection[i] = new google.maps.Marker({ //-----
          position: {lat: parseFloat(marcador.latitude), lng: parseFloat(marcador.longitude)}, 
          icon: aux,
          label: { 
            class: labelClass,
            text: marcador.nome,
            color: "#FFFFFF",
            fontSize: "45px",
            fontWeight: "bold",
            idbairro: marcador.idbairro
          },  
          map: map
        }); 
        //-----
        i++; 

        aux = pinIcon2;

    })


    for(var a = 1; a < collection.length; a += 1){

      google.maps.event.addListener(collection[a], "click", function (event) {
        latRef = this.position.lat();

        for(var b = 1; b < collection.length; b += 1){

          if (latRef == collection[b].position.lat()) {
            nomeBairro = collection[b].label.text;
            idbairro = collection[b].label.idbairro;
          }
        }

        window.location.href = "Bairro.html?nome="+nomeBairro+"&idbairro="+idbairro;
      });
    }   
  }

  buscar()

}
