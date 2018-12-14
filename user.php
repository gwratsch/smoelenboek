<section class="row">
    <div class="col-sm-5"> 
        <input type="text" id="myInput"  placeholder="Search for names.."><button onclick="myFunction();">Search</button>
        <div class="table-responsive">
            <table id="colleagueTable" class="table table-striped">
              <tr class="header">
                  <th></th>
                  <th ><a href="#"onclick="sortTable('1');"> Name</a></th>
                  <!--<th ><a href="#"onclick="sortTable('2');"> Country</a></th>-->
              </tr>
              <?php
              include_once 'modules/functions.php';
              $coleagueList = coleagueList();
              $tableContent = '';
              foreach ($coleagueList as $key => $value) {
                  $tableContent = '<tr>
                  <td><img src="foto/is.jpg" alt="colleague Image"></td>
                <td>'.$value->firstName.' '.$value->lastName.'</td>
              </tr>';
                  echo $tableContent;
              }
              ?>
            </table>
        </div>
    </div>
    <div class="col-sm-7"> 
        <form class="form" action="colleague.php" method="post">
            <input type="hidden" name="name" value="new">
            <label class="label"> firstName</label> : <input type="text" name="firstname" value=""><br />
            <label class="label"> lastName</label> : <input type="text" name="lastName" value=""><br />
            <label class="label"> gender</label> : <select name="gender">
                <option value="male">Man</option>
                <option value="female">Vrouw</option>
                <option value="neutral">neutraal</option>
            </select><br />
            <label class="label"> streetAddress</label> : <input type="text" name="streetAddress" value=""><br />
            <label class="label"> cityName</label> : <input type="text" name="cityName" value=""><br />
            <label class="label"> stateName</label> : <input type="text" name="stateName" value=""><br />
            <label class="label"> zipCode</label> : <input type="text" name="zipCode" value=""><br />
            <label class="label"> userName</label> : <input type="text" name="userName" value=""><br />
            <input type="submit" name="submit">
        </form>
    </div>
</section>
