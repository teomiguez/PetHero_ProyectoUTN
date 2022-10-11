
function enabledFields()
{
    // RADIOs
    var radio_dueño = document.getElementById('radio_dueño');
    var radio_guardian = document.getElementById('radio_guardian');

    // INPUTs
    var input_street = document.getElementById('street');
    var input_nro = document.getElementById('nro');
    var input_monday = document.getElementById('check_monday');
    var input_tuesday = document.getElementById('check_tuesday');
    var input_wednesday  = document.getElementById('check_wednesday');
    var input_thursday = document.getElementById('check_thursday');
    var input_friday = document.getElementById('check_friday');
    var input_saturday = document.getElementById('check_saturday');
    var input_sunday = document.getElementById('check_sunday');
    var input_tipo = document.getElementById('tipo_perro');
    var input_costo = document.getElementById('cost');

    if (radio_guardian.checked == true)
    {
        input_street.disabled = false;
        input_nro.disabled = false;
        input_monday.disabled = false;
        input_tuesday.disabled = false;
        input_wednesday.disabled = false;
        input_thursday.disabled = false;
        input_friday.disabled = false;
        input_saturday.disabled = false;
        input_sunday.disabled = false;
        input_tipo.disabled = false;
        input_costo.disabled = false;
    } else if (radio_dueño.checked == true) {
        input_street.disabled = true;
        input_nro.disabled = true;
        input_monday.disabled = true;
        input_tuesday.disabled = true;
        input_wednesday.disabled = true;
        input_thursday.disabled = true;
        input_friday.disabled = true;
        input_saturday.disabled = true;
        input_sunday.disabled = true;
        input_tipo.disabled = true;
        input_costo.disabled = true;
    }
}
