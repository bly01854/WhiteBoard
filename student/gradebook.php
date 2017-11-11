<?php
include '../session/student-session.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>WhiteBoard</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/whiteboard.css" rel="stylesheet">

    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">

  </head>
  
  <?php
  include 'header.php';
  include '../functions/html_element.php';

  
?>

  <body style="background-color: <?php echo $session_primaryColor; ?>" >
    



<div class="container">
        <div class="row justify-content-md-center">
          <div class="col whiteboard whiteboard-main gradebook">
           <p class="lead grades"> My Grades <i class="fa fa-calculator" aria-hidden="true"></i></p>
            <div class="row">
              <div class="col" id="current">
                <?php
                
                //create html class objects
                $num_of_courses = count($courseArray);
    
                for ($i = 0; $i < $num_of_courses; $i++){
                  $sql = "SELECT SUM(grade), SUM(points) FROM Grade JOIN Submission
                          ON Grade.submissionID = Submission.id
                          JOIN Assignment ON Submission.assignmentId = Assignment.id WHERE studentID =" . $session_studentId . " AND courseID =" . $courseArray[$i]->get_id();
                  $result = mysqli_query($db, $sql) or die('error getting data');
                  $row = mysqli_fetch_array($result, MYSQLI_BOTH);
                  $totalGrade = $row[0];
                  $totalPoints = $row[1];
                  
                  $class = new html_element('p');
                  $class->set('class', 'lead ingrade');
                  $class->set('id', $i);
                  $class->set('onclick', "loadClass(this)");
                  $class->set('text',$courseArray[$i]->get_name() . " - " . $courseArray[$i]->get_description() . " - " . $totalGrade . " / " . $totalPoints);
                  $class->output();
                }
                
                /* Original Html
                <p class="lead ingrade" id="cs360" onclick="loadClass(this)"> Software Engineering I - 60%</p>
                <p class="lead ingrade" id="cs10" onclick="loadClass(this)"> Basic Computer Literacy - 20%</p>
                <p class="lead ingrade" id="cheese" onclick="loadClass(this)"> Cheese Production - Fail</p>
                <p class="lead ingrade" id="lib" onclick="loadClass(this)"> Liberal Arts - 200%</p>
                */
                
                ?>
              </div>
              <div class="col" id="courseinfo">
               <p class="lead ingrade" id="recent"></p>
                <a id="link1" style='color:inherit; text-decoration: none'><p class="lead" id="grade1"></p></a> 
                <a id="link2" style='color:inherit; text-decoration: none'><p class="lead" id="grade2"> </p></a> 
                <a id="link3" style='color:inherit; text-decoration: none'><p class="lead" id="grade3"></p></a> 
                <p class="lead" id="calculation"> </p>
              </div>
            </div>

          </div>
        </div>

        <script type="text/javascript">

        class Gradebook 
        {
          constructor(grades)
          {
            this.grades = grades;
          }
        }

        class Grade
        {
          constructor(name, assignments, grade)
          {
            this.name = name;
            this.assignments = assignments;
            this.grade = grade;
          }
        }


        var courses = new Array();
        var grades1 = new Array();
        var grades2 = new Array();
        var grades3 = new Array();
        var titles1 = new Array();
        var titles2 = new Array();
        var titles3 = new Array();
        var id1 = new Array();
        var id2 = new Array();
        var id3 = new Array();
        <?php 
        $num_of_courses = count($courseArray);
        for ($i = 0; $i < $num_of_courses; $i++){
          $sql = "SELECT grade, title, points, assignmentId FROM Grade JOIN Submission
                ON Grade.submissionID = Submission.id
                JOIN Assignment ON Submission.assignmentId = Assignment.id WHERE studentID =" . $session_studentId . " AND courseID =" . $courseArray[$i]->get_id() . " 
                ORDER BY Grade.timestamp DESC LIMIT 3";
          $result = mysqli_query($db, $sql) or die('error getting data');
          $row = mysqli_fetch_array($result, MYSQLI_BOTH);
          if(isset($row[0])){ ?>
            grades1.push('<?php echo $row['grade'] . " / " . $row['points']; ?>');
            id1.push('<?php echo $row['assignmentId']; ?>')
            titles1.push('<?php echo $row['title']; ?>');
          <?php }
          $row = mysqli_fetch_array($result, MYSQLI_BOTH);
          if(isset($row[0])){ ?>
            grades2.push('<?php echo $row['grade'] . " / " . $row['points']; ?>');
            id2.push('<?php echo $row['assignmentId']; ?>')
            titles2.push('<?php echo $row['title']; ?>');
          <?php }
          $row = mysqli_fetch_array($result, MYSQLI_BOTH);
          if(isset($row[0])){ ?>
            grades3.push('<?php echo $row['grade'] . " / " . $row['points']; ?>');
            id3.push('<?php echo $row['assignmentId']; ?>')
            titles3.push('<?php echo $row['title']; ?>');
          <?php }
          
          ?>
          courses.push('<?php echo $courseArray[$i]->get_name(); ?>');
        <?php } ?>
       
        var comments = ["1/3 of a page too short", "Nice", "", ""];
        //var need = ["","","N/A, just give up",""];



         var a = [1,2,3,4];

         var x = document.getElementById("cs360");

         //loads course information
         function loadClass(c)
         {
            recent.innerHTML = "Most recent grades for " + courses[c.id];
            if (typeof titles1[c.id] != 'undefined'){
              grade1.innerHTML = titles1[c.id] + ": " + grades1[c.id];
              document.getElementById("link1").href="assignment.php?id=" + id1[c.id];
            }
            else{
              grade1.innerHTML = "";
            }
            if (typeof titles2[c.id] != 'undefined'){
              grade2.innerHTML = titles2[c.id] + ": " + grades2[c.id];
              document.getElementById("link2").href="assignment.php?id=" + id2[c.id];
            }
            else{
              grade2.innerHTML = "";
            }
            if (typeof titles3[c.id] != 'undefined'){
              grade3.innerHTML = titles3[c.id] + ": " + grades3[c.id];
              document.getElementById("link3").href="assignment.php?id=" + id3[c.id];
            }
            else{
              grade3.innerHTML = "";
            }

            //calculation.innerHTML = "What you need on upcoming assignments to raise your grade: " + need[courses.indexOf(c.id)];
         }

         function selectClass(c) {
           c.className += " updated";

 //          document.querySelectorAll(".updated")

         }


        </script>

    <footer> <p>  </p> </footer>

    </div>

   


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="../../../../assets/js/vendor/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>