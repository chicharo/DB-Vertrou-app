$(document).ready(function(){
	var items = [];

	$.ajax({
  		dataType: "json",
  		url: 'getContainers.php',
  		success: function(result){
  			result.forEach(function(d){
  				items.push([d.content_type,d.name]);

  			});
  			alert(items.length);
  			objSelect=document.getElementById('tank_id');
			var type = [];

			var exists = false;
			var j =0;

			
			for(i=0; i < items.length;i++){
				exists = false;

				while((exists==false) && j<type.length){

					if(items[i][0] === type[j]){
						exists=true;
					}

					j++;
				}

				j = 0;

				if(exists==false){
					type.push(items[i][0]);
					optGroup = document.createElement('optgroup');
					optGroup.label = items[i][0];

					objSelect.appendChild(optGroup);	

					for(k=0; i < items.length;k++){
						if(items[k][0] === items[i][0]){

							option = document.createElement('option');
							option.setAttribute("id",items[k][1]);
							option.text = items[k][1];

							optGroup.appendChild(option);
						}
					}
				}	

			

			}

  		}
		});
});