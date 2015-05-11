
//grid is the principal division wich contain and display the elements
var grid = null;
//myElem is a array which contain all the elements of a user
var myElem = [];
// tabId contains the id of elements which are added on the grid
var tabId = [];

$(document).ready(function(){
  var items = [];
  //alert("hey");


    $.ajax({
      dataType: "json",
      url: 'getContainers.php',
      success: function(result){
        //alert("su?");
        grid = $('.grid-stack').data('gridstack');
        
        result.forEach(function(d){
          items.push([d.id,d.content_type,d.name,d.max_value,d.alert_value]);
        
        });

        for(i=0; i<items.length;i++){
          
            if(i<(items.length-1) && (items[i][0]==items[i+1][0])){
            
            
              element = document.createElement("div");
              element.className ="grid-stack-item";
              element.id = "gridstackitem" + items[i][0];

               content = document.createElement("div");
              content.className = "grid-stack-item-content";
              content.id = "gridstackitemcontent" + i;
              content.style.outline = "1px solid black";
              
              buttonClose = document.createElement("button");
              buttonClose.className = "close";
              buttonClose.id = "itemclose" + i;
              buttonClose.setAttribute("aria-hidden",true);
              textButton = document.createTextNode("x");
              buttonClose.appendChild(textButton);

              span = document.createElement("span");
              span.className = "label label-default";
               text = document.createTextNode(items[i][2] + "&" + items[i+1][2]);
              span.appendChild(text);
              

              div = document.createElement("div");

              div.setAttribute("style","width: 400px; height: 200px;margin: 0 auto");
              div.style.width='400px';
              div.style.height='200px';
              
              div1 = document.createElement("div");
              div1.id = items[i][0]+items[i][1];
              div1.setAttribute("style","width: 130px; height: 200px;float: left");
              div1.style.width='130px';
              div1.style.height='200px';
              
              div2 = document.createElement("div");
              div2.id = items[i+1][0]+items[i+1][1];
              div2.setAttribute("style","width: 130px; height: 200px;float: left");
              div2.style.width='130px';
              div2.style.height='200px';
              
              div.appendChild(div1);
              div.appendChild(div2);

              content.appendChild(buttonClose);
              content.appendChild(span);
              content.appendChild(div);
              element.appendChild(content);

              myElem.push([items[i][1],element, items[i][0]]);
              myElem.push([items[i+1][1],element, items[i+1][0]]);


              grid.add_widget(element,1,1,3,4,true);
              
              initiateDoubleChart(div1.getAttribute('id'),items[i][1],items[i][3], items[i][4],div2.getAttribute('id'),items[i+1][1],items[i+1][3], items[i+1][4]);
              
              i++;
              
            }

            else{
             
              element = document.createElement("div");
              element.className ="grid-stack-item";
              element.id = "gridstackitem" + items[i][0];

              content = document.createElement("div");
              content.className = "grid-stack-item-content";
              content.id = "gridstackitemcontent" + i;
              content.style.outline = "1px solid black";

              buttonClose = document.createElement("button");
              buttonClose.className = "close";
              buttonClose.id = "itemclose" + i;
              buttonClose.setAttribute("aria-hidden",true);
               textButton = document.createTextNode("x");
              buttonClose.appendChild(textButton);

              span = document.createElement("span");
              span.className = "label label-default";
              text = document.createTextNode(items[i][2]);
              span.appendChild(text);

              div = document.createElement("div");
              div.id = items[i][0]+items[i][1];
              div.setAttribute("style","width: 300px; height: 200px;");


              content.appendChild(buttonClose);
              content.appendChild(span);
              content.appendChild(div);
              element.appendChild(content);

              grid.add_widget(element,1,1,3,4,true);
              initiateChart(div.getAttribute('id'), items[i][1],items[i][3], items[i][4]);

              myElem.push([items[i][1],element, items[i][0]]  );

            }
          }
          
            getLastValues();

              }
         });
 
}); 
        
  //for the selection of elements by type
function displayContainers(type){
  //selection des items du JSON par type
  grid.remove_all();
  tabId =[];
  var b = false;

  for(i=0; i<myElem.length; i++){
    b = false;
    for(j=0; j<tabId.length; j++){

      if(myElem[i][2] == tabId[j]){
        b = true;

        break;
      }
    }

    if(myElem[i][0]==type && b == false){

      grid.add_widget(myElem[i][1]);
      alert('Voici le type du container : ' + type);
      tabId.push(myElem[i][2]);

    }
  }
}
        
function displayContainersCheckbox(type){
  //selection des items du JSON par type
  grid.remove_all();
  tabId =[];
  var b = false;

  for(i=0; i<myElem.length; i++){
    b = false;
    for(j=0; j<tabId.length; j++){

      if(myElem[i][2] == tabId[j]){
        b = true;

        break;
      }
    }

    if(myElem[i][0]==type && b == false){

      grid.add_widget(myElem[i][1]);
      alert('Voici le type du container : ' + type);
      tabId.push(myElem[i][2]);

    }
  }
}



function getLastValues(){
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
   
        function initiateChart(id_div,type,max_value,alert_value) {

    $('#'+id_div).highcharts({
        exporting: { enabled: false },
        credits: {
      enabled: false
  },
        title: {
    text: '',
    style: {
        display: 'none'
    }
},
subtitle: {
    text: '',
    style: {
        display: 'none'
    }
},
        chart: {
            type: 'gauge',
            enabled:false,
            plotBackgroundColor: null,
            plotBackgroundImage: null,
            plotBorderWidth: 0,
            plotShadow: false
        },

        pane: {
            startAngle: -150,
            endAngle: 150,
            background: [{
                backgroundColor: {
                    linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                    stops: [
                        [0, '#FFF'],
                        [1, '#333']
                    ]
                },
                borderWidth: 0,
                outerRadius: '100%'
            }, {
                backgroundColor: {
                    linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                    stops: [
                        [0, '#333'],
                        [1, '#FFF']
                    ]
                },
                borderWidth: 1,
                outerRadius: '107%'
            }, {
                // default background
            }, {
                backgroundColor: '#DDD',
                borderWidth: 0,
                outerRadius: '105%',
                innerRadius: '103%'
            }]
        },

        // the value axis
        yAxis: {
            min: 0,
            max: max_value,

            minorTickInterval: 'auto',
            minorTickWidth: 1,
            minorTickLength: 10,
            minorTickPosition: 'inside',
            minorTickColor: '#666',

            tickPixelInterval: 30,
            tickWidth: 2,
            tickPosition: 'inside',
            tickLength: 10,
            tickColor: '#666',
            labels: {
                step: 2,
                rotation: 'auto'
            },
            title: {
                text: 'Liters'
            },
            plotBands: [{
                from: 0,
                to: alert_value,
                color: '#DF5353' // red
                
            }, {
                from: alert_value,
                to: max_value,
                color: '#55BF3B' // green
            }]
        },

        series: [{
            name: type,
            data: [0],
            tooltip: {
                valueSuffix: 'Liters'
            }
        }]

    });
  }; //end of function initiatechart (One value)

  function initiateDoubleChart(id_div1,type1,max_value1,alert_value1,id_div2,type2,max_value2,alert_value2) {

    gaugeOptions = {

        chart: {
            type: 'solidgauge'
        },

        title: null,

        pane: {
            center: ['50%', '85%'],
            size: '140%',
            startAngle: -90,
            endAngle: 90,
            background: {
                backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || '#EEE',
                innerRadius: '60%',
                outerRadius: '100%',
                shape: 'arc'
            }
        },

        tooltip: {
            enabled: false
        },

        // the value axis
        yAxis: {
            stops: [
                [alert_value1/max_value1, '#DF5353'], // red
                [(alert_value1/max_value1), '#55BF3B'] // green
            ],
            lineWidth: 0,
            minorTickInterval: null,
            tickPixelInterval: 400,
            tickWidth: 0,
            title: {
                y: -70
            },
            labels: {
                y: 16
            }
        },

        plotOptions: {
            solidgauge: {
                dataLabels: {
                    y: 5,
                    borderWidth: 0,
                    useHTML: true
                }
            }
        }
    };

    // The speed gauge
    $('#'+id_div1).highcharts(Highcharts.merge(gaugeOptions, {
        exporting: { enabled: false },
        credits: {
      enabled: false
  },
subtitle: {
    text: '',
    style: {
        display: 'none'
    }
},
        yAxis: {
            min: 0,
            max: max_value1,
            title: {
                text: type1
            }
        },

        credits: {
            enabled: false
        },

        series: [{
            name: type1,
            data: [30],
            dataLabels: {
                format: '<div style="text-align:center"><span style="font-size:20px;color:' +
                    ((Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black') + '">{y}</span><br/>' +
                       '<span style="font-size:12px;color:silver">Liters</span></div>'
            },
            tooltip: {
                valueSuffix: ' Liters'
            }
        }]

    }));

    // The RPM gauge
    $('#'+id_div2).highcharts(Highcharts.merge(gaugeOptions, {
        exporting: { enabled: false },
        credits: {
      enabled: false
  },
subtitle: {
    text: '',
    style: {
        display: 'none'
    }
},
        yAxis: {
            min: 0,
            max: max_value2,
            title: {
                text: type2
            }
        },

        series: [{
            name: type2,
            data: [1],
            dataLabels: {
                format: '<div style="text-align:center"><span style="font-size:20px;color:' +
                    ((Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black') + '">{y:.1f}</span><br/>' +
                       '<span style="font-size:12px;color:silver">Liters</span></div>'
            },
            tooltip: {
                valueSuffix: 'Liters'
            }
        }]

    }));
  };
    