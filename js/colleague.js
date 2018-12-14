function getSection(sectionName){
$.post("colleague.php",
    {
      name: sectionName
    },
    function(data,status){
        console.log(data);
      $('section').replaceWith(data);
    });
}
function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("colleagueTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
function sortTable(columNum) {
    var othercolumNum = columNum == 1? 2:1;
  var table, rows, switching, i, x, y, shouldSwitch;
  table = document.getElementById("colleagueTable");
  switching = true;
  while (switching) {
    switching = false;
    rows = table.rows;
    for (i = 1; i < (rows.length - 1); i++) {
      shouldSwitch = false;
      x = rows[i].getElementsByTagName("td")[columNum];
      y = rows[i + 1].getElementsByTagName("td")[columNum];
      xo = rows[i].getElementsByTagName("td")[othercolumNum];
      yo = rows[i + 1].getElementsByTagName("td")[othercolumNum];
      if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
        shouldSwitch = true;
        break;
      }
      if (x.innerHTML.toLowerCase() == y.innerHTML.toLowerCase()) {
        if (xo.innerHTML.toLowerCase() > yo.innerHTML.toLowerCase()) {
          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
    }
  }
}