<section>
    <input type="text" id="myInput"  placeholder="Search for names.."><button onclick="myFunction();">Search</button>
    <div class="table-responsive">
        <table id="colleagueTable" class="table table-striped bg-light">
          <tr class="header">
              <th></th>
              <th ><a href="#"onclick="sortTable('1');"> Name</a></th>
              <th ><a href="#"onclick="sortTable('2');"> Country</a></th>
          </tr>
          <?php
          include_once 'modules/functions.php';
          $coleagueList = coleagueList();
          $tableContent = '';
          if(is_array($coleagueList)){
          $defaultImage = "foto/is.jpg";
          foreach ($coleagueList as $key => $value) {
              if(array_key_exists('userImage', $value) && isset($value->userImage)){$defaultImage = $value->userImage;}
              $tableContent = '<tr>
              <td><img src="'.$defaultImage.'" alt="colleague Image"></td>
            <td>'.$value->firstName.' '.$value->lastName.'</td><td>'.$value->cityName.'</td>
          </tr>';
              echo $tableContent;
          }}
          ?>
        </table>
    </div>
</section>
