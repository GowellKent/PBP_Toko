function cari_nama() {
		
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("searchnama");
    filter = input.value.toUpperCase();
    table = document.getElementById("tabel");
    tr = table.getElementsByTagName("tr");

    
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[1];
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1){
                tr[i].style.display = "";
            } else{
                tr[i].style.display = "none";
            }
        }
    }
}

function cari_id() {

var input, filter, table, tr, td, i, txtValue;
input = document.getElementById("searchid");
filter = input.value.toUpperCase();
table = document.getElementById("tabel");
tr = table.getElementsByTagName("tr");


for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1){
            tr[i].style.display = "";
        } else{
            tr[i].style.display = "none";
        }
    }
}
}

function cari_nama_sup() {
		
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("searchnama-sup");
    filter = input.value.toUpperCase();
    table = document.getElementById("tabel-sup");
    tr = table.getElementsByTagName("tr");

    
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[1];
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1){
                tr[i].style.display = "";
            } else{
                tr[i].style.display = "none";
            }
        }
    }
}

function cari_id_sup() {

var input, filter, table, tr, td, i, txtValue;
input = document.getElementById("searchid-sup");
filter = input.value.toUpperCase();
table = document.getElementById("tabel-sup");
tr = table.getElementsByTagName("tr");


for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1){
            tr[i].style.display = "";
        } else{
            tr[i].style.display = "none";
        }
    }
}
}
