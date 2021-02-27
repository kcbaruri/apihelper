$(function () {

	/* Morris Area Chart */
	var months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
	window.mA = Morris.Area({
		element: 'morrisArea',
		data: [
			{ y: '2013-01', a: 6000 },
			{ y: '2013-02', a: 10000 },
			{ y: '2013-03', a: 24000 },
			{ y: '2013-04', a: 12000 },
			{ y: '2013-05', a: 8000 },
			{ y: '2013-06', a: 10000 },
			{ y: '2013-07', a: 30000 },
		],
		xkey: 'y',
		ykeys: ['a'],
		labels: ['Revenue'],
		xLabelFormat: function (x) { // <--- x.getMonth() returns valid index
			var month = months[x.getMonth()];
			return month;
		},
		dateFormat: function (x) {
			var month = months[new Date(x).getMonth()];
			return month;
		},
		lineColors: ['#1b5a90'],
		lineWidth: 2,

		fillOpacity: 0.5,
		gridTextSize: 10,
		hideHover: 'auto',
		resize: true,
		redraw: true
	});

	/* Morris Line Chart */

	window.mL = Morris.Line({
		element: 'morrisLine',
		data: [
			{ y: '2015-01', a: 100, b: 30 },
			{ y: '2015-02', a: 20, b: 60 },
			{ y: '2015-03', a: 90, b: 120 },
			{ y: '2015-04', a: 50, b: 80 },
			{ y: '2015-05', a: 120, b: 150 },
		],
		xkey: 'y',
		ykeys: ['a', 'b'],
		labels: ['Doctors', 'Patients'],
		xLabelFormat: function (x) { // <--- x.getMonth() returns valid index
			var month = months[x.getMonth()];
			return month;
		},
		dateFormat: function (x) {
			var month = months[new Date(x).getMonth()];
			return month;
		},
		lineColors: ['#1b5a90', '#ff9d00'],
		lineWidth: 1,
		gridTextSize: 10,
		hideHover: 'auto',
		resize: true,
		redraw: true
	});
	$(window).on("resize", function () {
		mA.redraw();
		mL.redraw();
	});

});