function getSection(sectionName){
    $.post("colleague.php",
        {
          name: sectionName
        },
        function(data,status){
          $('section').replaceWith(data);
        }
    );
}

function getUserInfo(editUserName){
    $.post("jsonResult.php",
        {
          name: 'read',
          userName: editUserName
        },
        function(data,status,xhr){
            console.log("ontvangen data: ");
            console.log(data);
            console.log(status);
            document.getElementById('firstName').value=data.firstName;
            document.getElementById('lastName').value=data.lastName;
            document.getElementById('gender').value=data.gender;
            document.getElementById('streetAddress').value=data.streetAddress;
            document.getElementById('cityName').value=data.cityName;
            document.getElementById('stateName').value=data.stateName;
            document.getElementById('zipCode').value=data.zipCode;
            document.getElementById('userName').value=data.userName;
            if("userImage" in data && data.userImage.length >0){
                document.getElementById('userImage').src =data.userImage;
                document.getElementById('userImage').style.display ='block';
                document.getElementById('inputUserImage').style.display ='none';
                document.getElementById('imageRemove').style.display ='block';
            }
        },
        'json'
    );
}
function removeUserInfo(userName){
    $.post("colleague.php",
        {
          name: 'remove',
          userName: userName
        },
        function(data,status){
          removeUserFromPage(userName);
        }
    );
}
function removeUserFromPage(userName) {
  var input, filter, table, tr, td, i, txtValue;
  input = userName;
  filter = input.toUpperCase();
  table = document.getElementsByClassName(userName);
  table[0].style.display = "none";
}

function loadNewImage(){
    document.getElementById('userImage').style.display ='none';
    document.getElementById('inputUserImage').style.display ='block';
    document.getElementById('imageRemove').style.display ='none';
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