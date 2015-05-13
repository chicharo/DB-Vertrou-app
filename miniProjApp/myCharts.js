
        var containerAllValues = [];
        //Is the container a double type?
        var isDoubleType = false;

        $.ajax({
      dataType: "json",
      url: 'getAllValues.php',
      success: function(result){
        result.forEach(function(d){
          containerAllValues.push([d.value,d.content_type_container,d.name, d.date]);
          
          
          });
        //Is the container a double type?
        for(i=0;i<containerAllValues.length;i++){
            if(containerAllValues[i][1]!=containerAllValues[0][1]){
                isDoubleType = true;
                break;
            }
        }

        var dataTab = [], dataTab2 = [], dataTabFin1 = [], dataTabFin2 = [];
        var datesTab = [];
        var type1 , type2, title1, title2, title;
        title1 = containerAllValues[0][2];

        //initialise the table of dates
        datesTab[0] = containerAllValues[0][3].substring(0, 16);
        var j =0;
        for(i=0;i<containerAllValues.length;i++){
            if(datesTab[j-1] !=  containerAllValues[i][3].substring(0, 16)){
                datesTab[j] =  containerAllValues[i][3].substring(0, 16);
                j++;
            }
        }

            if(isDoubleType==true){
                type1=containerAllValues[0][1];                        //save the other type and other title in a variable

                for(i=0;i<containerAllValues.length;i++){
                    if(containerAllValues[i][1] != type1){
                        type2 = containerAllValues[i][1];
                        title2 = containerAllValues[i][2];
                    }
                }

                //attach values to date
                for(i=0;i<containerAllValues.length;i++){
                    if(containerAllValues[i][1]==type1){

                        dataTab.push([Math.floor(containerAllValues[i][0]), containerAllValues[i][3].substring(0, 16)]);
                    }
                    else{
                        dataTab2.push([Math.floor(containerAllValues[i][0]), containerAllValues[i][3].substring(0, 16)]);

                    }
                }

                //the final title is the two containers' names
                title = title1 + ' & '+ title2;

                //initialisation of the finals table
                var bool;
                var k = 0;
                //creation of final table for the graphs
                for(i=0;i<datesTab.length;i++){

                    for(j=0;j<dataTab.length;j++){

                        if(dataTab[j][1]==datesTab[i]){

                            bool = true;
                            dataTabFin1.push(dataTab[j][0]);
                            k++;
                        }
                    }
                    if(bool==false){
                        if(dataTabFin1.length==0){
                            dataTabFin1.push(null);
                            k++;
                        }
                        else{
                            dataTabFin1.push(dataTabFin1[k-1]);
                            k++;
                        }
                    }

                    bool = false;
                }

                bool = false;
                k = 0;
                for(i=0;i<datesTab.length;i++){

                    for(j=0;j<dataTab2.length;j++){

                        if(dataTab2[j][1]==datesTab[i]){

                            bool = true;
                            dataTabFin2.push(dataTab2[j][0]);
                            k++;
                        }
                    }
                    if(bool==false){
                        if(dataTabFin2.length==0){
                            dataTabFin2.push(null);
                            k++;
                        }
                        else{
                            dataTabFin2.push(dataTabFin2[k-1]);
                            k++;
                        }
                    }

                    bool = false;
                }

                initiateTabTwo();
                initiateDetailsTwo(type1, type2, title, dataTabFin1, dataTabFin2, datesTab);
            }
            else{
                title = containerAllValues[0][2];
                type1 = containerAllValues[0][1];
                for(i=0;i<containerAllValues.length;i++){
                    dataTabFin1[i] = Math.floor(containerAllValues[i][0]);        
                }

                initiateTab();
                initiateDetails(type1, title, dataTabFin1, datesTab);
                
            }
            init_map();
    }



  });     

    function initiateDetailsTwo(type1, type2, title, dataTab, dataTab2, datesTab) {

        var chart;
    $('#contChart').highcharts({
        chart: {
            type: 'line'
        },
        title: {
            text: title
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: datesTab
        },
        yAxis: {
            title: {
                text: 'Volume (m3)'
            }
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: false
            }
        },
        series: [{
            name: type1,
            data: []
        },
        {
            name: type2,
            data: []
        }]
    });
    chart = $('#contChart').highcharts();
    if(isDoubleType == true){
        chart.series[0].setData(dataTab);
        chart.series[1].setData(dataTab2);
    }
    else{
        chart.series[0].setData(dataTab);
        chart.series[1].setData(null);
    }
    //chart.setTitle({ text: 'New title ' + title},{ text: 'New title '});

};

function initiateDetails(type, title, dataTab, datesTab) {

        var chart;
    $('#contChart').highcharts({
        chart: {
            type: 'line'
        },
        title: {
            text: title
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: datesTab
        },
        yAxis: {
            title: {
                text: 'Volume (m3)'
            }
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: false
            }
        },
        series: [{
            name: type,
            data: []
        }]
    });
    chart = $('#contChart').highcharts();
    if(isDoubleType == true){
        chart.series[0].setData(dataTab);
        chart.series[1].setData(dataTab2);
    }
    else{
        chart.series[0].setData(dataTab);
        chart.series[1].setData(null);
    }
    //chart.setTitle({ text: 'New title ' + title},{ text: 'New title '});

};

function initiateTabTwo(){
        $('#resTitleType').append('Type');
    var myBody = document.getElementById("myBody");

   for(i=0;i<containerAllValues.length;i++){

        $('#resDate').append('<p>'+containerAllValues[i][3]+'</p>');
        $('#resType').append('<p>'+containerAllValues[i][1]+'</p>');
        $('#resValue').append('<p>'+containerAllValues[i][0]+'</p>');

    }
    
}

function initiateTab(){
    var myBody = document.getElementById("myBody");

   for(i=0;i<containerAllValues.length;i++){

        $('#resDate').append('<p>'+containerAllValues[i][3]+'</p>');
        $('#resValue').append('<p>'+containerAllValues[i][0]+'</p>');

    }
    
}
function init_map() {
  var longitude;
  var latitude; 
  $.ajax({
      dataType: "json",
      url: 'getLoc.php',
      success: function(result){
        
        
        result.forEach(function(d){
          longitude = d.geolong;
          latitude = d.geolat;
        
        });
        if(longitude!=null && latitude != null){
          var var_location = new google.maps.LatLng(latitude,longitude);
         
        var var_mapoptions = {
          center: var_location,
          zoom: 14
        };
 
    var var_marker = new google.maps.Marker({
      position: var_location,
            map: var_map,
      title:"Venice"});
 
        var var_map = new google.maps.Map(document.getElementById("map-container"),
            var_mapoptions);
 
    var_marker.setMap(var_map); 

        }
    
 
      }
    });
}