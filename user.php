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
        <form class="form-group" action="colleague.php" method="post">
            <input type="hidden" name="name" value="new">
            <label class="label">Voornaam</label> : <input class="form-control" type="text" name="firstName" value=""><br />
            <label class="label">Achternaam</label> : <input class="form-control" type="text" name="lastName" value=""><br />
            <label class="label">Geslacht</label> : <select class="form-control" name="gender">
                <option value="male">Man</option>
                <option value="female">Vrouw</option>
                <option value="neutral">Neutraal</option>
            </select><br />
            <label class="label">Straat</label> : <input class="form-control" type="text" name="streetAddress" value=""><br />
            <label class="label">Woonplaats</label> : <input class="form-control" type="text" name="cityName" value=""><br />
            <label class="label">Provincie</label> : <input class="form-control" type="text" name="stateName" value=""><br />
            <label class="label">Postcode</label> : <input class="form-control" type="text" name="zipCode" value=""><br />
            <label class="label">Loginnaam</label> : <input class="form-control" type="text" name="userName" value=""><br />
            <input type="submit" name="submit">
        </form>
    </div>
</section>
