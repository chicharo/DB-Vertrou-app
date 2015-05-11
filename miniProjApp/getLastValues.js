$('#refresh').onclick = function () {
    getLastValues();
};




function getLastValues(){
	alert("Do i get here");
	var containersLastValues = [];

	$.ajax({
  		dataType: "json",
  		url: 'getLastValues.php',
  		success: function(result){
  			result.forEach(function(d){
  				containersLastValues.push([d.id_container,d.content_type_container,d.value,d.date]);

  				});

  					for(i=0; i<containersLastValues.length; i++){
  							id = containersLastValues[i][0]+containersLastValues[i][1];
  							var intvalue = Math.floor( containersLastValues[i][2] );
							

  							$('#'+id).highcharts().series[0].points[0].update(intvalue);

  							
						}
		}

	});
};