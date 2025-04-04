@extends('layouts')

@section('fonsPantalla')
    <div id="quisom" style="background-image: url('{{ url('image/200.gif') }}');">
        <h1 class="display-1 fw-bold text-center larger-title">CALENDARI</h1>
        <p class="display-5  text-center ">-</p>
        <p class="display-6 text-center"><strong>Sing&Drink</strong></p>

    </div>
@endsection



@section('Contenido_Adicional')
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.5/main.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.5/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.5/locales/es.js"></script>
    <style>
        #calendar a {
            text-decoration: none !important; /* Asegura que no haya subrayado */
        }

        .fc-daygrid-day, .fc-daygrid-day-number, .fc-daygrid-day-top {
            text-decoration: none !important; /* Deshabilita el subrayado en los dias */
        }
        #calendar {
            max-width: 900px;
            margin: 40px auto;
            padding: 10px;
            background: white;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        /* Estilos para la lista de conciertos agrupados por año */
        .calendar-list {
            max-width: 800px;
            margin: 20px auto;
        }

        .calendar-group {
            display: flex;
            margin-bottom: 20px;
        }

        .year-column {
            flex: 0 0 100px;
            font-size: 48px;
            font-weight: bold;
            color: #222E50;
            text-align: right;
            padding-right: 20px;
            border-right: 2px solid #222E50;
        }

        .concerts-column {
            flex: 1;
            padding-left: 20px;
        }

        .concert-item {
            padding: 10px 15px;
            border-left: 4px solid #EEC765;
            margin: 5px 0;
            background: white;
            border-radius: 5px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        }

        /* Estilos para los eventos del FullCalendar */
        .fc-daygrid-event {
            background-color: #EEC765 !important;
            border: none !important;
            color: #222E50 !important;
            border-radius: 5px;
            padding: 5px;
            font-size: 14px;
        }

        .fc-toolbar-title {
            font-size: 22px !important;
            font-weight: bold;
            color: #222E50;
        }

        .fc-button {
            background-color: #222E50 !important;
            border: none !important;
            color: white !important;
            border-radius: 5px !important;
            padding: 6px 12px !important;
        }

        .fc-button:hover {
            background-color: #1a1f37 !important;
        }

        .fc-toolbar-title {
            text-transform: capitalize;
        }

        /* Tooltip del evento */
        #eventTooltip {
            display: none;
            position: absolute;
            background-color: #0B1828;
            color: white;
            padding: 10px;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            font-size: 14px;
            z-index: 1000;
            border: 1px solid #ccc;
        }

        #eventTooltip::after {
            content: "";
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            border-width: 5px;
            border-style: solid;
            border-color: #0B1828 transparent transparent transparent;
        }

        .fc-toolbar-chunk .fc-button {
            margin-right: 5px;
        }

        .fc-toolbar-chunk .fc-button:last-child {
            margin-right: 0;
        }
    </style>
</head>

<body>

    <div id="calendar"></div>

    <div id="eventTooltip"></div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var tooltip = document.getElementById('eventTooltip');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                locale: 'es',
                initialView: 'dayGridMonth',
                events: '{{ url("/api/concerts") }}',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                titleFormat: { year: 'numeric', month: 'long' },

                eventClick: function(info) {
                var rect = info.el.getBoundingClientRect();

                tooltip.innerHTML = `
                <strong>${info.event.title}</strong><br>
                <strong>Estilo:</strong> ${info.event.extendedProps.style}<br>
                <strong>Ubicación:</strong> ${info.event.extendedProps.location}  <!-- Mostramos la ubicación -->
            `;

                tooltip.style.left = (rect.left + window.scrollX) + 'px';
                tooltip.style.top = (rect.top + window.scrollY - 55) + 'px';
                tooltip.style.display = 'block';
            }
            });

            calendar.render();

            document.addEventListener('click', function(event) {
                if (!event.target.closest('.fc-event')) {
                    tooltip.style.display = 'none';
                }
            });
        });
    </script>
@endsection
