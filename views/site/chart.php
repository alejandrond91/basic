<!--Vista con Canvas para dibujar charts. -->


<!--importa la "librería" javascript para poder crear los charts. -->
<script src="../../vendor/Chart/Chart.js"></script>

<!--Canvas donde se van a dibujar posteriormente los charts. -->
<canvas id="myChart" width="400" height="400" style="margin-top: 10%;"></canvas>
<canvas id="myChart2" width="500" height="500" style="margin-top: 10%;"></canvas>
<canvas id="myChart3" width="300" height="300" style="margin-left: 5%;"></canvas>
<canvas id="myChart4" width="300" height="300" style="margin-left: 15%;"></canvas>

<!--Botón al que se le asigna el evento click donde se utiliza ajax para poder generar el pdf.-->
<fieldset style="margin-top: 10%; margin-left:7%;">
	<button class="btn btn-primary btn-lg" id="png">Generar PDF con los charts</button>
</fieldset>

<!-- El primer script crea el chart de barras. -->
<script>
	//chart de barras, los datos del personal, los trae el controller. Se codifica a json para poder representarlo en el chart.
	var data = {
		labels : <?php echo json_encode($nombre_personal); ?>,
		datasets : [
			{
				fillColor : "rgba(151,187,205,0.5)",
				strokeColor : "rgba(220,220,220,1)",
				data : <?php echo json_encode($nota_rendimiento); ?>

			},
		]
	}
	//En estas lineas se recoge el canvas y se le cargan los datos para poder representarlos en el canvas.
	var ctx = document.getElementById("myChart").getContext("2d");
	var myNewChart = new Chart(ctx).Bar(data);
	var ctx = $("#myChart").get(0).getContext("2d");
	var myNewChart = new Chart(ctx);
	new Chart(ctx).Bar(data,options);
</script>

<!-- El segundo scrip crea el chart radar, es igual que el anterior pero con propiedades de visualización diferente. -->
<script>
//Chart radar
	var data = {
		labels : <?php echo json_encode($nombre_personal); ?>,
		datasets : [
			{
				fillColor : "rgba(151,187,205,0.5)",
				strokeColor : "rgba(220,220,220,1)",
				pointColor : "rgba(220,220,220,1)",
				pointStrokeColor : "#fff",
				data : <?php echo json_encode($nota_rendimiento); ?>
			},
		]
	}
	var ctx = document.getElementById("myChart2").getContext("2d");
	var myNewChart = new Chart(ctx).Radar(data);
	var ctx = $("#myChart2").get(0).getContext("2d");
	var myNewChart = new Chart(ctx);
	new Chart(ctx).Radar(data,options);

</script>

<!-- El tercer scrip crea el chart tarta, es igual que el anterior pero con propiedades de visualización diferente. -->
<script>
//Chart tarta
	var rendimientos = <?php echo json_encode($nota_rendimiento); ?>;
	var data = [
		{
			value: rendimientos[0],
			color:"#F38630"
		},
		{
			value : rendimientos[1],
			color : "#E0E4CC"
		},
		{
			value : rendimientos[2],
			color : "#69D2E7"
		}			
	]
	var ctx = document.getElementById("myChart3").getContext("2d");
	var myNewChart = new Chart(ctx).Pie(data);
	var ctx = $("#myChart3").get(0).getContext("2d");
	var myNewChart = new Chart(ctx);
	new Chart(ctx).Pie(data,options);
</script>

<!-- El cuarto script crea el chart polar area, es igual que el anterior pero con propiedades de visualización diferente. -->
<script>
//Chart polar area
	var rendimientos = <?php echo json_encode($nota_rendimiento); ?>;
	var data = [
	{
		value : rendimientos[0],
		color: "#D97041"
	},
	{
		value : rendimientos[1],
		color: "#C7604C"
	},
	{
		value : rendimientos[2],
		color: "#21323D"
	}
]
	var ctx = document.getElementById("myChart4").getContext("2d");
	var myNewChart = new Chart(ctx).PolarArea(data);
	var ctx = $("#myChart4").get(0).getContext("2d");
	var myNewChart = new Chart(ctx);
	new Chart(ctx).PolarArea(data,options);

</script>

<!-- Este último script es el que hace la magia. -->
<script>
	
	//Se recogen las referencias a las etiquetas html, tanto del botón para asignarle la función que ocurrirá cuando ocurra el evento click
	//como las de los 4 canvas.
	var png = document.getElementById("png");
	var barras = document.getElementById("myChart");
	var radar = document.getElementById("myChart2");
	var torta = document.getElementById("myChart3");
	var polar = document.getElementById("myChart4");

	//Se le asigna una función al botón para el evento click.
	png.addEventListener("click",function(){
	  //Se crean 4 etiquetas img y se le asignan el atributo src, gracias a una función que tiene canvas para pasar canvas a src de img.
	  //Esto se hace para pasarle las etiquetas al php para poder transformar el html a pdf.
	  var imgBarras = document.createElement("img");
	  imgBarras.setAttribute("src", barras.toDataURL("image/png"));
	  var imgRadar = document.createElement("img");
	  imgRadar.setAttribute("src", radar.toDataURL("image/png"));
	  var imgTorta = document.createElement("img");
	  imgTorta.setAttribute("src", torta.toDataURL("image/png"));
	  var imgPolar = document.createElement("img");
	  imgPolar.setAttribute("src", polar.toDataURL("image/png"));
	  //Se introduce todo en una variable para poder pasarla por ajax al archivo php que usa la librería mpdf para transformar el html a pdf.
	  var html = "<img src='"+imgBarras.src+"'>"+"<img src='"+imgRadar.src+"'>"+"<img src='"+imgTorta.src+"'>"+"<img src='"+imgPolar.src+"'>";

	  //Función que pasa la variable html que contiene las etiquetas img a un archivo php para que pueda procesarla.
	  $.ajax({
     	type: "POST",
     	url: "http://localhost/basic/charttopdf.php",
    	data: {html : html},
    	dataType: "text",
     	success: function(data){
         	
     	},
     	error: function(XMLHttpRequest, textStatus, errorThrown) {
            alert(textStatus);
            alert(XMLHttpRequest);
            alert(errorThrown);
        }
 	  });
	});


</script>