/*======== 16. ANALYTICS - ACTIVITY CHART ========*/


/**
 * @param {number} num
 */
 function monthNum2Str(num){
    const month = [
        "Januari", "Februari", "Maret",
        "April", "Mei", "Juni",
        "Juli", "Agustus", "Septeber",
        "Oktober", "November", "Desember"
    ];
    return month[num]
}

/**
 * 
 * @param {Array} values 
 */
function setLineChart(values){
    if (document.getElementById("chart") !== null) {
        var activityData = [
            {
                first: values,
            },
            // {
            //     first: [0, 65, 77, 33, 49, 100, 100],
            //     second: [20, 85, 97, 53, 69, 120, 120],
            // },
            // {
            //     first: [0, 40, 77, 55, 33, 116, 50],
            //     second: [30, 70, 107, 85, 73, 146, 80],
            // },
            // {
            //     first: [0, 44, 22, 77, 33, 151, 99],
            //     second: [60, 32, 120, 55, 19, 134, 88],
            // },
        ];
    
        document.getElementById("chart").height = 100;
    
        var config = {
            type: "line",
            data: {
                labels: generateDay(values.length),
                datasets: [
                    {
                        label: `pengaduan`,
                        backgroundColor: "rgba(111, 78, 242, 0.10)",
                        borderColor: "rgba(111, 78, 242, 1)",
                        data: values,
                        lineTension: 0,
                        pointRadius: 4,
                        borderWidth: 4,
                    }
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    display: false,
                },
                scales: {
                    xAxes: [
                        {
                            stacked: true,
                            barPercentage: 0.45,
                            gridLines: {
                                display: false,
                                drawBorder: false,
                            },
                            ticks: {
                                display: false,
                                // fontColor: "#8a909d",
                            },
                        },
                    ],
                    yAxes: [
                        {
                            stacked: true,
                            gridLines: {
                                display: false,
                                color: "#eee",
                            },
                            ticks: {
                                // display: false,
                                stepSize: 50,
                                fontColor: "#6f4ef2",
                                fontFamily: "Poppins",
                            },
                        },
                    ],
                },
                tooltips: {
                    mode: "index",
                    intersect: false,
                    titleFontColor: "#888",
                    bodyFontColor: "#555",
                    titleFontSize: 12,
                    bodyFontSize: 15,
                    backgroundColor: "rgba(256,256,256,0.95)",
                    displayColors: true,
                    xPadding: 10,
                    yPadding: 7,
                    borderColor: "rgba(220, 220, 220, 0.9)",
                    borderWidth: 2,
                    caretSize: 6,
                    caretPadding: 5,
                },
            },
        };
    
        var ctx = document.getElementById("chart").getContext("2d");
        var myLine = new Chart(ctx, config);
    
        var items = document.querySelectorAll("#user-activity .btn");
        items.forEach(function (item, index) {
            item.addEventListener("click", function () {
                config.data.datasets[0].data = activityData[index].first;
                config.data.datasets[1].data = activityData[index].second;
                myLine.update();
            });
        });
    }
}

function LineChart(activityElement, data, labels){
    console.log(data, labels)
    if (document.getElementById("chart") !== null) {
        var activityData = [
            {
                first: data,
            },
            // {
            //     first: [0, 65, 77, 33, 49, 100, 100],
            //     second: [20, 85, 97, 53, 69, 120, 120],
            // },
            // {
            //     first: [0, 40, 77, 55, 33, 116, 50],
            //     second: [30, 70, 107, 85, 73, 146, 80],
            // },
            // {
            //     first: [0, 44, 22, 77, 33, 151, 99],
            //     second: [60, 32, 120, 55, 19, 134, 88],
            // },
        ];
    
        activityElement.height = 250;
    
        var config = {
            type: "line",
            data: {
                labels: labels,
                datasets: [
                    {
                        label: `pengaduan`,
                        backgroundColor: "rgba(111, 78, 242, 0.10)",
                        borderColor: "rgba(111, 78, 242, 1)",
                        data: data,
                        lineTension: 0,
                        pointRadius: 4,
                        borderWidth: 4,
                    }
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    display: false,
                },
                scales: {
                    xAxes: [
                        {
                            stacked: true,
                            barPercentage: 0.45,
                            gridLines: {
                                display: false,
                                drawBorder: false,
                            },
                            ticks: {
                                display: false,
                                // fontColor: "#8a909d",
                            },
                        },
                    ],
                    yAxes: [
                        {
                            stacked: true,
                            gridLines: {
                                display: false,
                                color: "#eee",
                            },
                            ticks: {
                                // display: false,
                                stepSize: 50,
                                fontColor: "#6f4ef2",
                                fontFamily: "Poppins",
                            },
                        },
                    ],
                },
                tooltips: {
                    mode: "index",
                    intersect: false,
                    titleFontColor: "#888",
                    bodyFontColor: "#555",
                    titleFontSize: 12,
                    bodyFontSize: 15,
                    backgroundColor: "rgba(256,256,256,0.95)",
                    displayColors: true,
                    xPadding: 10,
                    yPadding: 7,
                    borderColor: "rgba(220, 220, 220, 0.9)",
                    borderWidth: 2,
                    caretSize: 6,
                    caretPadding: 5,
                },
            },
        };
    
        var ctx = document.getElementById("activity").getContext("2d");
        var myLine = new Chart(ctx, config);
        document.getElementById('user-activity').style.height ='300px';
        document.getElementById('chart').style.height = '280px';
        var items = document.querySelectorAll("#user-activity .btn");
        items.forEach(function (item, index) {
            item.addEventListener("click", function () {
                config.data.datasets[0].data = activityData[index].first;
                config.data.datasets[1].data = activityData[index].second;
                myLine.update();
            });
        });
    }

}

function generateDay(n){
    return [...Array(n)].map((x, i)=>{
        const date = new Date();
        const curdate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - i);
        return `${curdate.getDate()} ${monthNum2Str(curdate.getMonth())}`;
    }).reverse()
}

function DonutChart(context, labels, values){
    new Chart(context, {
        type: "doughnut",
        data: {
            datasets: [
                {
                    data: values,
                    backgroundColor: [
                        "rgba(111, 78, 242,1)",
                        "rgba(111, 78, 242,0.5)",
                        "rgba(111, 78, 242,0.10)",
                    ],
    
    
                }],
            labels: labels,
        },
        options: {
            responsive: true,
            cutoutPercentage: 80,
            maintainAspectRatio: false,
            animation: {
                animateRotate: true,
                animateScale: true,
            },
            labels: ["Facebook", "Youtube", "Google"],
        },
        options: {
            responsive: true,
            cutoutPercentage: 80,
            maintainAspectRatio: false,
            clip: 10,
            animation: {
                animateRotate: true,
                animateScale: true,
            },
            legend: {
                display: true,
                position: "bottom",
                labels: {
                    usePointStyle: true,
                    fontFamily: "Poppins",
                    fontSize: 12,
                    fontColor: "#464a53",
                    padding: 20,
                },
            },
        },
    });
}

$(document).ready(()=>{
    const ctx = document.getElementById("most-selling-items");
    var lastUpdate = JSON.stringify({})
    const form = new FormData();
    if(!globalThis.UpdateChart) form.append('line', '1');
    function getStatistik(){
        fetch('api/statistik.php', {
            method:'POST',
            body:form
        }).then(async (response)=>{
            const json = await response.json();
            if(JSON.stringify(json) !== lastUpdate){
                lastUpdate = JSON.stringify(json);
                if(json.chart){
                    setLineChart(json.chart);
                    globalThis.UpdateChart = 1;
                }
                document.getElementById('jumlahpengaduan').innerText = (function(){
                    var sum = 0;
                    Object.values(json.pengaduan).forEach((x)=>{
                        sum+=x
                    })
                    return sum
                })();
                document.getElementById('jumlahpengguna').innerText = json.pengguna;
                document.getElementById('jumlahproses').innerText = json.pengaduan.proses;
                document.getElementById('jumlahselesai').innerText = json.pengaduan.selesai;
                DonutChart(ctx, Object.keys(json.pengaduan), Object.values(json.pengaduan));
            }

        })
    }
    getStatistik();
    setInterval(getStatistik, 30000);
    //doughut chart
// ctx.height = 175;
// ["Selesai", "Proses", "0"]
// [16, 16, 16]


})