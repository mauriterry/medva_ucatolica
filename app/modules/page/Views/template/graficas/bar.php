<div style="width:50%">
	<canvas id="myChart<?php echo $id; ?>" height="650" width="600"></canvas>
</div>
<script>
    var nombreGrafica = String(<?= json_encode($this->nombreGrafica) ?>);
    var lados<?php echo $id; ?> = [<?= json_encode($lados) ?>];
    var valores<?php echo $id; ?> = [<?= json_encode($valores) ?>];
    var ladx<?php echo $id; ?> = [];
    var valx<?php echo $id; ?> = [];
    var lady<?php echo $id; ?> = [];
    var valy<?php echo $id; ?> = [];
    for (let index = 0; index < valores<?php echo $id; ?>.length; index++) {
        const element = valores<?php echo $id; ?>[index];
        for (let index1 = 0; index1 < element.length; index1++) {
            const element1 = element[index1]; 
            if(index1 == 1){
                for (let index2 = 0; index2 < element1.length; index2++) {
                    const element2 = element1[index2];
                    ladx<?php echo $id; ?>.push(element2.grafica_nombre); 
                    valx<?php echo $id; ?>.push(element2.grafica_valor);   
                }   
            }else{
                for (let index2 = 0; index2 < element1.length; index2++) {
                    const element2 = element1[index2];
                    lady<?php echo $id; ?>.push(element2.grafica_nombre); 
                    valy<?php echo $id; ?>.push(element2.grafica_valor);      
                }  
            } 
        }           
    }
	var ctx<?php echo $id; ?> = document.getElementById('myChart<?php echo $id; ?>');
	var myChart<?php echo $id; ?> = new Chart(ctx<?php echo $id; ?>, {
	    type: 'bar',
	    data: {
	        labels: valy<?php echo $id; ?>,
	        datasets: [{
                label: nombreGrafica,
                fillColor: "rgba(220,220,220,0.2)",
                strokeColor: "rgba(220,220,220,1)",
                pointColor: "rgba(220,220,220,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(220,220,220,1)",
                data: valx<?php echo $id; ?>
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