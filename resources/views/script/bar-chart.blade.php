<script>
    $(document).ready(function () {
        "use strict";

        if ($('#bar-chart-horizontal2').length > 0) {
            var ctx2 = document.getElementById("bar-chart-horizontal2").getContext("2d");
            var data2 = {
                labels: ["January", "February", "March", "April", "May", "June", "July"],
                datasets: [{
                        label: "My First dataset",
                        backgroundColor: "#689f38",
                        borderColor: "#689f38",
                        data: [10, 59, 40, 75, 50, 45, 80]
                    },
                    {
                        label: "My Second dataset",
                        backgroundColor: "#38649f",
                        borderColor: "#38649f",
                        data: [48, 88, 50, 58, 34, 67, 65]
                    }
                ]
            };

            var hBar = new Chart(ctx2, {
                type: "horizontalBar",
                data: data2,

                options: {
                    tooltips: {
                        mode: "label"
                    },
                    scales: {
                        yAxes: [{
                            stacked: true,
                            gridLines: {
                                color: "rgba(135,135,135,0)",
                            },
                            ticks: {
                                fontFamily: "Nunito Sans",
                                fontColor: "#878787"
                            }
                        }],
                        xAxes: [{
                            stacked: true,
                            gridLines: {
                                color: "rgba(135,135,135,0)",
                            },
                            ticks: {
                                fontFamily: "Nunito Sans",
                                fontColor: "#878787"
                            }
                        }],

                    },
                    elements: {
                        point: {
                            hitRadius: 40
                        }
                    },
                    animation: {
                        duration: 3000
                    },
                    responsive: true,
                    legend: {
                        display: false,
                    },
                    tooltip: {
                        backgroundColor: 'rgba(33,33,33,1)',
                        cornerRadius: 0,
                        footerFontFamily: "'Nunito Sans'"
                    }

                }
            });
        }

    }); // End of use strict

</script>
