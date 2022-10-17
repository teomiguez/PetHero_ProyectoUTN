
function EnabledFields()
{
    // RADIOs
    const radio_dueño = document.querySelector('#radio_dueño');
    const radio_guardian = document.querySelector('#radio_guardian');

    // INPUTs
    const input_street = document.querySelector('#street');
    const input_nro = document.querySelector('#nro');
    const input_monday = document.querySelector('#check_monday');
    const input_tuesday = document.querySelector('#check_tuesday');
    const input_wednesday = document.querySelector('#check_wednesday');
    const input_thursday = document.querySelector('#check_thursday');
    const input_friday = document.querySelector('#check_friday');
    const input_saturday = document.querySelector('#check_saturday');
    const input_sunday = document.querySelector('#check_sunday');
    const input_tipo = document.querySelector('#tipo_perro');
    const input_costo = document.querySelector('#cost');

    if (radio_guardian.checked == true) {
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
    }
    else if (radio_dueño.checked == true) {
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
