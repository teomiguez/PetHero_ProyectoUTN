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
    street.disabled = false;
    nro.disabled = false;
    typeSize.disabled = false;
    cost.disabled = false;
}

function disabledFields()
{
    street.disabled = true;
    nro.disabled = true;
    typeSize.disabled = true;
    cost.disabled = true;
}
