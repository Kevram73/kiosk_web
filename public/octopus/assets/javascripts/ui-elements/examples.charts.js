
(function( $ ) {

	'use strict';
    var morrisBarData = [{
        y: 'Lundi',
        a: 35
    }, {
        y: 'Mardi',
        a: 92
    }, {
        y: 'Mercredi',
        a: 60
    }, {
        y: 'Jeudi',
        a: 75
    }, {
        y: 'Vendredi',
        a: 90
    }, {
        y: 'Samedi',
        a: 75
    },
    ];
	/*
	Flot: Basic
	*/

	/*
	Flot: Real-Time
	*/

	Morris.Bar({
		resize: true,
		element: 'morrisBar',
		data: morrisBarData,
		xkey: 'y',
		ykeys: ['a', 'b'],
		labels: ['Series A', 'Series B'],
		hideHover: true,
		barColors: ['#0088cc', '#2baab1']
	});

	/*
	Morris: Area
	*/

	/*
	Morris: Stacked
	*/


}).apply( this, [ jQuery ]);

