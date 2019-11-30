<div style="width:50%">
	<canvas id="myChart2" height="650" width="600"></canvas>
</div>
<script>
    var lados = [<?= json_encode($lados) ?>];
    var valores = [<?= json_encode($valores) ?>];
    var ladx = [];
    var valx = [];
    var lady = [];
    var valy = [];
    for (let index = 0; index < valores.length; index++) {
        const element = valores[index];
        for (let index1 = 0; index1 < element.length; index1++) {
            const element1 = element[index1]; 
            if(index1 == 1){
                for (let index2 = 0; index2 < element1.length; index2++) {
                    const element2 = element1[index2];
                    ladx.push(element2.grafica_nombre); 
                    valx.push(element2.grafica_valor);   
                }   
            }else{
                for (let index2 = 0; index2 < element1.length; index2++) {
                    const element2 = element1[index2];
                    lady.push(element2.grafica_nombre); 
                    valy.push(element2.grafica_valor);      
                }  
            } 
        }           
    }
	var ctx = document.getElementById('myChart2');
	var myChart2 = new Chart(ctx, {
	    type: 'bar',
	    data: {
	        labels: valy,
	        datasets: [{
                label: lados[0][0].grafica_nombre,
                fillColor: "rgba(220,220,220,0.2)",
                strokeColor: "rgba(220,220,220,1)",
                pointColor: "rgba(220,220,220,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(220,220,220,1)",
                data: valx
            }]
	    },
	    options: {
	        scales: {
	            yAxes: [{
	                ticks: {
	                    beginAtZero: true
	                }
	            }]
	        }
	    }
	});
</script>