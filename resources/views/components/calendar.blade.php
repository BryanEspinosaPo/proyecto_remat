<div
    x-data="calendar()"
    x-init="init()"
    class="bg-white p-6 rounded-lg shadow-md shadow-gray-300  mt-12 "
>
    <!-- Navegación de meses -->
    <div class="flex justify-between items-center mb-4">
        <button @click="prevMonth" class="text-gray-500 hover:text-black">&lt;</button>
        <h3 class="text-lg font-semibold" x-text="monthNames[currentMonth] + ' ' + currentYear"></h3>
        <button @click="nextMonth" class="text-gray-500 hover:text-black">&gt;</button>
    </div>

    <!-- Días de la semana -->
    <div class="grid grid-cols-7 text-center text-sm font-medium text-gray-600 mb-2">
        <template x-for="day in weekDays" :key="day">
            <div x-text="day"></div>
        </template>
    </div>

    <!-- Días -->
    <div class="grid grid-cols-7 gap-2 text-center">
        <template x-for="blank in blanks" :key="'b' + blank">
            <div></div>
        </template>

        <template x-for="day in daysInMonth" :key="day">
            <div
                @click="selectDate(day)"
                class="cursor-pointer rounded p-1"
                :class="{
                    'bg-green-200 font-bold': isToday(day),
                    'bg-green-500 text-white': selectedDate === formatDate(day),
                    'hover:bg-green-100': isDateSelectable(day),
                    'text-gray-300 cursor-not-allowed': !isDateSelectable(day)
                }"
                x-text="day"
            ></div>
        </template>
    </div>

    <!-- Selector de rango horario -->
    <div class="mt-6">
        <label class="block font-medium mb-1">Rango Horario:</label>
        <select
            name="rango_horario"
            class="border border-gray-300 p-2 rounded w-full bg-lime-100 focus:ring focus:ring-green-200"
            x-model="selectedTime"
            @change="updateDateTime()"
        >
            <option value="">Seleccione un rango</option>
            <option>08:00 - 10:00</option>
            <option>10:00 - 12:00</option>
            <option>14:00 - 16:00</option>
        </select>
    </div>

    <!-- Input visible con fecha + hora -->
    <div class="mt-4">
        <label class="block font-medium mb-1">Fecha y Hora Seleccionada:</label>
        <input
            type="text"
            name="fecha_hora_recoleccion"
            class="border @error('fecha_hora_recoleccion') border-red-500 @enderror border-gray-300 p-2 rounded w-full"
            x-model="fullDateTime"
            readonly
            required
            x-bind:class="{'border-red-500': !isValid()}"
        >
        @error('fecha_hora_recoleccion')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
        <span x-show="!isValid() && (selectedDate || selectedTime)" class="text-red-500 text-sm">
            Debes seleccionar tanto la fecha como el rango horario
        </span>
    </div>
</div>

<script>
function calendar() {
    return {
        monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
        weekDays: ['LUN','MAR','MIÉ','JUE','VIE','SÁB','DOM'],
        currentMonth: new Date().getMonth(),
        currentYear: new Date().getFullYear(),
        daysInMonth: [],
        blanks: [],
        selectedDate: '',
        selectedTime: '',
        fullDateTime: '',

        isValid() {
            return this.selectedDate && this.selectedTime;
        },

        init() {
            this.getDays();
        },

        getDays() {
            const firstDay = new Date(this.currentYear, this.currentMonth, 1).getDay();
            const totalDays = new Date(this.currentYear, this.currentMonth + 1, 0).getDate();

            // Ajustar para que empiece en lunes
            const adjustedFirstDay = (firstDay + 6) % 7;
            this.blanks = Array.from({ length: adjustedFirstDay }, (_, i) => i + 1);
            this.daysInMonth = Array.from({ length: totalDays }, (_, i) => i + 1);
        },

        prevMonth() {
            if (this.currentMonth === 0) {
                this.currentMonth = 11;
                this.currentYear--;
            } else {
                this.currentMonth--;
            }
            this.getDays();
        },

        nextMonth() {
            if (this.currentMonth === 11) {
                this.currentMonth = 0;
                this.currentYear++;
            } else {
                this.currentMonth++;
            }
            this.getDays();
        },

        isToday(day) {
            const todayColombia = this.getColombiaTime();
            return (
                day === todayColombia.getDate() &&
                this.currentMonth === todayColombia.getMonth() &&
                this.currentYear === todayColombia.getFullYear()
            );
        },

        getColombiaTime() {
            // Crear fecha con la zona horaria de Colombia
            const options = { timeZone: 'America/Bogota' };
            const colombiaTime = new Date().toLocaleString('en-US', options);
            return new Date(colombiaTime);
        },

        isDateSelectable(day) {
            const selectedDate = new Date(this.currentYear, this.currentMonth, day);
            selectedDate.setHours(0, 0, 0, 0);

            const todayColombia = this.getColombiaTime();
            // Creamos la fecha mínima (día siguiente)
            const tomorrowColombia = new Date(todayColombia);
            tomorrowColombia.setDate(todayColombia.getDate() + 1);
            tomorrowColombia.setHours(0, 0, 0, 0);

            return selectedDate >= tomorrowColombia;
        },

        selectDate(day) {
            if (!this.isDateSelectable(day)) {
                alert('Solo puedes agendar a partir del día siguiente (Hora Colombia)');
                return;
            }
            this.selectedDate = this.formatDate(day);
            this.updateDateTime();
            // Reset time if the date changes
            if (this.selectedTime) {
                this.validateTimeRange();
            }
        },

        formatDate(day) {
            const d = String(day).padStart(2, '0');
            const m = String(this.currentMonth + 1).padStart(2, '0');
            return `${this.currentYear}-${m}-${d}`;
        },

        validateTimeRange() {
            if (!this.selectedDate || !this.selectedTime) return;

            const [startTime, endTime] = this.selectedTime.split(' - ');
            const [startHours, startMinutes] = startTime.split(':');
            const [endHours, endMinutes] = endTime.split(':');

            // Crear fecha con zona horaria de Colombia para el inicio y fin del rango
            const selectedStartDateTime = new Date(this.selectedDate);
            selectedStartDateTime.setHours(parseInt(startHours), parseInt(startMinutes), 0, 0);

            const selectedEndDateTime = new Date(this.selectedDate);
            selectedEndDateTime.setHours(parseInt(endHours), parseInt(endMinutes), 0, 0);

            const nowColombia = this.getColombiaTime();

            // Si es el mismo día, validar el rango horario completo
            if (this.formatDate(nowColombia.getDate()) === this.selectedDate) {
                // Si la hora actual es posterior a la hora de fin del rango
                if (nowColombia > selectedEndDateTime) {
                    alert('Este horario ya no está disponible para hoy');
                    this.selectedTime = '';
                    this.updateDateTime();
                    return;
                }

                // Si estamos dentro del rango horario (entre inicio y fin)
                if (nowColombia >= selectedStartDateTime && nowColombia <= selectedEndDateTime) {
                    alert('Este horario está disponible sin embargo si no podemos recoger la basura en este horario, se reprogramará automáticamente, para el dia de mañana en la misma franja horaria.');
                    return;
                }
            }
        },        updateDateTime() {
            if (this.isValid()) {
                this.validateTimeRange();
                if (this.selectedTime) {
                    const timeRange = this.selectedTime.split(' - ')[0];
                    this.fullDateTime = `${this.selectedDate} ${timeRange}`;
                    window.dispatchEvent(new CustomEvent('datetime-selected', {
                        detail: this.fullDateTime
                    }));
                } else {
                    this.fullDateTime = '';
                }
            } else {
                this.fullDateTime = '';
            }
        },
    }
}
</script>
