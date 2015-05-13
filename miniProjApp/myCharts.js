
        var containerAllValues = [];
        var dataTab = [];

        $.ajax({
      dataType: "json",
      url: 'getAllValues.php',
      success: function(result){
        result.forEach(function(d){
          containerAllValues.push([d.value,d.content_type_container,d.name]);
          //alert(containerAllValues[0][3]);
          
          
          }); 

        initiateDetails(containerAllValues[0][2]);
    }

  });


        

    function initiateDetails(title) {

        var chart;
    $('#contChart').highcharts({
        chart: {
            type: 'line'
        },
        title: {
            text: title
        },
        subtitle: {
            text: 'Source: WorldClimate.com'
        },
        xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        },
        yAxis: {
            title: {
                text: 'Temperature (°C)'
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
            name: 'Tokyo',
            data: [7.0, 6.9, 9.5, 14.5, 18.4, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
        }, {
            name: 'London',
            data: [3.9, 4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 16.6, 14.2, 10.3, 6.6, 4.8]
        }]
    });
    //chart = $('#contChart').highcharts();
    //chart.setTitle({ text: 'New title ' + title},{ text: 'New title '});

    alert('chart check!!!');
};
