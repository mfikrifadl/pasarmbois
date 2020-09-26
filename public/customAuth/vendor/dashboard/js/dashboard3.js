/*
Template Name: Material Admin
Author: Wrappixel
Email: niravjoshi87@gmail.com
File: js
*/
$(function() {
    "use strict";
    // var total = [];
    // var increase = [];
    var month = [];
    var trx = [];
    var guest = [];

    graph.forEach(function(entry) {
        month.push(entry[0]);
        trx.push(entry[1]);
        guest.push(entry[2]);
    });
    // ==============================================================
    // sales ratio
    // ==============================================================

    var chart = new Chartist.Line(
        ".sales5",
        {
            labels: month,
            series: [trx]
        },
        {
            low: 0,
            // high: 100,
            showArea: true,
            fullWidth: false,
            plugins: [Chartist.plugins.tooltip()],
            axisY: {
                onlyInteger: true,
                scaleMinSpace: 40,
                offset: 20,
                labelInterpolationFnc: function(value) {
                    return value;
                }
            }
        }
    );
    var visitor = new Chartist.Line(
        ".visitor",
        {
            labels: month,
            series: [guest]
        },
        {
            low: 0,
            // high: 1500,
            showArea: true,
            fullWidth: true,
            lineSmooth: true,
            chartPadding: {
                right: 20,
                left: 30
            },
            plugins: [Chartist.plugins.tooltip()],
            axisY: {
                onlyInteger: true,
                scaleMinSpace: 40,
                offset: 20,
                labelInterpolationFnc: function(value) {
                    return value;
                }
            }
        }
    );

    // Offset x1 a tiny amount so that the straight stroke gets a bounding box
    // Straight lines don't get a bounding box
    // Last remark on -> http://www.w3.org/TR/SVG11/coords.html#ObjectBoundingBox
    chart.on("draw", function(ctx) {
        if (ctx.type === "area") {
            ctx.element.attr({
                x1: ctx.x1 + 0.001
            });
        }
    });

    // Create the gradient definition on created event (always after chart re-render)
    chart.on("created", function(ctx) {
        var defs = ctx.svg.elem("defs");
        defs.elem("linearGradient", {
            id: "gradient",
            x1: 0,
            y1: 1,
            x2: 0,
            y2: 0
        })
            .elem("stop", {
                offset: 0,
                "stop-color": "rgba(255, 255, 255, 1)"
            })
            .parent()
            .elem("stop", {
                offset: 1,
                "stop-color": "rgba(64, 196, 255, 1)"
            });
    });
    // visitor
    visitor.on("draw", function(ctx) {
        if (ctx.type === "area") {
            ctx.element.attr({
                x1: ctx.x1 + 0.001
            });
        }
    });

    // Create the gradient definition on created event (always after chart re-render)
    visitor.on("created", function(ctx) {
        var defs = ctx.svg.elem("defs");
        defs.elem("linearGradient", {
            id: "gradient",
            x1: 0,
            y1: 1,
            x2: 0,
            y2: 0
        })
            .elem("stop", {
                offset: 0,
                "stop-color": "rgba(255, 255, 255, 1)"
            })
            .parent()
            .elem("stop", {
                offset: 1,
                "stop-color": "rgba(64, 196, 255, 1)"
            });
    });

    // ==============================================================
    // campaign status
    // ==============================================================
    var chart = c3.generate({
        bindto: ".status",
        data: {
            columns: [
                ["Pending", chartstatus[0].pending],
                ["Failed", chartstatus[0].failed],
                ["Success", chartstatus[0].success]
            ],

            type: "donut"
        },
        donut: {
            label: {
                show: false
            },
            title: "Status",
            width: 35
        },

        legend: {
            hide: true
            //or hide: 'data1'
            //or hide: ['data1', 'data2']
        },
        color: {
            pattern: ["#137eff", "#5ac146", "#8b5edd"]
        }
    });
});
