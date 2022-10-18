// -> CONST CHECKs DAYS
const checkMonday = document.getElementById("check_monday");
const checkTuesday = document.getElementById("check_tuesday");
const checkWednesday = document.getElementById("check_wednesday");
const checkThrusday = document.getElementById("check_thursday");
const checkFriday = document.getElementById("check_friday");
const checkSaturday = document.getElementById("check_saturday");
const checkSunday = document.getElementById("check_sunday");
// <- CONST CHECKs DAYS

// -> CONST ADDRESS
const street = document.getElementById("street");
const nro = document.getElementById("nro");
// <- CONST ADDRESS

// -> CONST SIZE
const typeSize = document.getElementById("typeSize");
// <- CONST SIZE

// -> CONST COST
const cost = document.getElementById("cost");
// <- CONST COST

function enabledFields()
{    
   //alert("Guardian seleccionado!");
   checkMonday.disabled = false;
   checkTuesday.disabled = false;
   checkWednesday.disabled = false;
   checkThrusday.disabled = false;
   checkFriday.disabled = false;
   checkSaturday.disabled = false;
   checkSunday.disabled = false;
   street.disabled = false;
   nro.disabled = false;
   typeSize.disabled = false;
   cost.disabled = false;
}

function disabledFields()
{
    //alert("Dueño seleccionado!");
    checkMonday.disabled = true;
    checkTuesday.disabled = true;
    checkWednesday.disabled = true;
    checkThrusday.disabled = true;
    checkFriday.disabled = true;
    checkSaturday.disabled = true;
    checkSunday.disabled = true;
    street.disabled = true;
    nro.disabled = true;
    typeSize.disabled = true;
    cost.disabled = true;
}
