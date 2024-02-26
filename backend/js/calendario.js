$(function($){
    $.datepicker.regional['es'] = {
        closeText: 'Cerrar',
        prevText: '<Anterior',
        nextText: 'Siguiente>',
        currentText: 'Hoy',
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort: ['Enero','Febrero','Marzo','Abril', 'Mayo','Junio','Julio','Agosto','Septiembre', 'Octubre','Noviembre','Diciembre'],
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
        dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
        dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'],
        weekHeader: 'Sem',
		showWeek: true,
        dateFormat: 'yy-mm-dd',
        firstDay: 1,
		changeMonth: false,
		changeYear: false,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: '',
    };
    $.datepicker.setDefaults($.datepicker.regional['es']);

    $.timepicker.regional['es'] = {
        timeOnlyTitle: 'Horario',
        timeText: 'Horario',
        hourText: 'Hrs',
        minuteText: 'Min',
        secondText: 'Seg',
        timezoneText: 'Zona',
        currentText: 'Ahora',
        closeText: 'Aceptar',
        amNames: ['AM', 'A'],
        pmNames: ['PM', 'P'],
        isRTL: false,
        timeFormat: 'HH:mm:ss',
        stepMinute: 15,
        stepSecond: 60,
        //controlType: 'select',
        hourMin: 6,
        hourMax: 24,
        //minDate: new Date(), // No activar: al hacerlo no dejará cargar la fecha y hora que hayas guardado. Sólo la que está en curso.
        timeInput: true,
        //oneLine: true,
        showSecond: true,
        useCurrent: false,
        defaultDate: new Date(),
    };
    $.timepicker.setDefaults($.timepicker.regional['es']);

});/*	Para el rango puede ser yearRange: "-100:+0" ó yearRange: '1950:2013'	*/
