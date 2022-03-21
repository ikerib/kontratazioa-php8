require('admin-lte/plugins/chart.js/Chart.min')


/********************************************************************************************************/
/*** CHART1 *********************************************************************************************/
/********************************************************************************************************/
const chart1Value = JSON.parse($('#txtChart1').val());
let donutData1 = {
    labels: [],
    datasets: [
        {
            data: [],
            backgroundColor : [],
        }
    ]
}

chart1Value.forEach((item) => {
    if ( item.izena === "") {
        donutData1.labels.push('SAIL GABE')
    } else {
        donutData1.labels.push(item.izena)
    }
    donutData1.datasets[0].data.push(item.zenbat)
    donutData1.datasets[0].backgroundColor.push('#17a2b8')

});

//-------------
//- PIE CHART -
//-------------
// Get context with jQuery - using jQuery's .get() method.
const pieChartCanvas = $('#pieChart').get(0).getContext('2d')
const pieData        = donutData1;
const pieOptions     = {
    legend: { display: false },
    maintainAspectRatio : false,
    responsive : true,
    title: {
        display: true,
        text: 'Kontratu kopurua: '
    }
}
//Create pie or douhnut chart
// You can switch between pie and douhnut using the method below.
new Chart(pieChartCanvas, {
    type: 'bar',
    data: pieData,
    options: pieOptions
})

/********************************************************************************************************/
/*** CHART2 *********************************************************************************************/
/********************************************************************************************************/
const chart2Value = JSON.parse($('#txtChart2').val());
let donutData2 = {
    labels: [],
    datasets: [
        {
            data: [],
            backgroundColor : [],
        }
    ]
}

chart2Value.forEach((item) => {
    if ( item.name === null) {
        donutData2.labels.push('EGOERA GABE')
    } else {
        donutData2.labels.push(item.name)
    }
    donutData2.datasets[0].data.push(item.zenbat)
    donutData2.datasets[0].backgroundColor.push('#17a2b8')

});

//-------------
//- PIE CHART -
//-------------
// Get context with jQuery - using jQuery's .get() method.
const pieChartCanvas2 = $('#pieChart2').get(0).getContext('2d')
const pieData2        = donutData2;
const pieOptions2     = {
    legend: { display: false },
    maintainAspectRatio : false,
    responsive : true,
    title: {
        display: true,
        text: 'Kontratu kopurua: '
    }
}
//Create pie or douhnut chart
// You can switch between pie and douhnut using the method below.
new Chart(pieChartCanvas2, {
    type: 'bar',
    data: pieData2,
    options: pieOptions2
})

/********************************************************************************************************/
/*** CHART3 *********************************************************************************************/
/********************************************************************************************************/
const chart3Value = JSON.parse($('#txtChart3').val());
let donutData3 = {
    labels: [],
    datasets: [
        {
            data: [],
            backgroundColor : [],
        }
    ]
}

chart3Value.forEach((item) => {
    if ( item.mota_eus === null) {
        donutData3.labels.push('EGOERA GABE')
    } else {
        donutData3.labels.push(item.mota_eus)
    }
    donutData3.datasets[0].data.push(item.zenbat)
    donutData3.datasets[0].backgroundColor.push('#17a3b8')

});
const pieChartCanvas3 = $('#pieChart3').get(0).getContext('2d')
const pieData3        = donutData3;
const pieOptions3     = {
    legend: { display: false },
    maintainAspectRatio : false,
    responsive : true,
    title: {
        display: true,
        text: 'Kontratu kopurua: '
    }
}
new Chart(pieChartCanvas3, {
    type: 'bar',
    data: pieData3,
    options: pieOptions3
})

/********************************************************************************************************/
/*** CHART4 *********************************************************************************************/
/********************************************************************************************************/
const chart4Value = JSON.parse($('#txtChart4').val());
let donutData4 = {
    labels: [],
    datasets: [
        {
            data: [],
            backgroundColor : [],
        }
    ]
}

chart4Value.forEach((item) => {
    if ( item.prozedura_eus == '') {
        donutData4.labels.push('PROZEDURA ESLEITU GABE')
    } else {
        donutData4.labels.push(item.prozedura_eus)
    }
    donutData4.datasets[0].data.push(item.zenbat)
    donutData4.datasets[0].backgroundColor.push('#17a3b8')

});
const pieChartCanvas4 = $('#pieChart4').get(0).getContext('2d')
const pieData4        = donutData4;
const pieOptions4     = {
    legend: { display: false },
    maintainAspectRatio : false,
    responsive : true,
    title: {
        display: true,
        text: 'Kontratu kopurua: '
    }
}
new Chart(pieChartCanvas4, {
    type: 'bar',
    data: pieData4,
    options: pieOptions4
})

/********************************************************************************************************/
/*** CHART5 *********************************************************************************************/
/********************************************************************************************************/
const chart5Value = JSON.parse($('#txtChart5').val());
let donutData5 = {
    labels: [],
    datasets: [
        {
            data: [],
            backgroundColor : [],
        }
    ]
}

chart5Value.forEach((item) => {
    console.log(item)
    if ( item.name == '') {
        donutData5.labels.push('ARDURADUN GABE')
    } else {
        donutData5.labels.push(item.name)
    }
    donutData5.datasets[0].data.push(item.zenbat)
    donutData5.datasets[0].backgroundColor.push('#17a3b8')

});
const pieChartCanvas5 = $('#pieChart5').get(0).getContext('2d')
const pieData5        = donutData5;
const pieOptions5     = {
    legend: { display: false },
    maintainAspectRatio : false,
    responsive : true,
    title: {
        display: true,
        text: 'Kontratu kopurua: '
    }
}
new Chart(pieChartCanvas5, {
    type: 'bar',
    data: pieData5,
    options: pieOptions5
})
