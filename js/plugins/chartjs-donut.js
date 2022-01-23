//doughut chart
var ctx = document.getElementById("most-selling-items");
// ctx.height = 175;
// ["Selesai", "Proses", "0"]
// [16, 16, 16]
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
