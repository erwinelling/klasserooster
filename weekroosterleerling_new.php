<?php error_reporting(0);session_start();?>
<?
  // SET VARIABLES

  //e.g. ll=261
  $leerling_id=$_GET['ll'];
  $_SESSION["leerlingID"]=$leerling_id;

  if(isset($_GET['docent'])) {
    // Don't use existing session var, but get var
    // e.g. docent=Administrator
    // e.g. docent=Laura
    $ingelogde_docent=$_GET['docent'];
  } else {
    $ingelogde_docent=$_SESSION["sUsername"];
  }
  $docent=$ingelogde_docent;

  if(isset($_GET['klas'])) {
    // Overwrite existing session var with get var
    // e.g. klas=1
    $_SESSION['klas']=$_GET['klas'];
  }

  if(isset($_GET['sCode'])) {
    // Overwrite existing session var with get var
    // e.g. sCode=JBR
    //TODO: Volgens mij gaat hier iets mee mis. Met Bram checken hoe dit zit!
    //TODO: Zorgen dat ik goed kan vergelijken met normale code!
    //TODO: Zorgen dat dit niet met sessievar hoeft.
    $_SESSION['sCode']=$_GET['sCode'];
  }

  $week=intval(date('W'))+1;
  // TODO: Check difference between $weeknummer and $week
?>


<!DOCTYPE html>

<html lang="nl">

    <head>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
<style>
      .center{
    position: absolute;
    height: 20px;
    width: 50px;
    z-index: 100;
    top:calc(50% - 50px/2);
    left:calc(50% - 50px/2);

}
</style>

<!--<script type="text/javascript" src="jspdf.debug.js"></script>-->

      <?php include ("header.inc") ;
         include("includes/functions.php");
         $_SESSION['weeknummer']=  intval(date('W'));

if ($_GET['test']==1){
    echo "<pre>";
    var_dump($_SESSION);
         echo "</pre>";
         echo getNameTeacher($_SESSION['sCode']);


        // $_SESSION['weeknummer']=$_GET['week'];
}
      ConnectSQLDatabase();


function haalAlgemeen($tijd)
{
    $sql="select * from algemene_activiteiten WHERE wanneer='".$tijd."'";
    //echo $sql2;
    while($row = mysql_fetch_array(mysql_query($sql)) )
       {
      return $row['omschrijving'];
       }


}


function getRemark($ll)
{
    $sSql = "SELECT * FROM student_opmerkingen where studentnr='".$ll."'";

           //echo $sSql;
     $result = mysql_query($sSql);

                                            while($row = mysql_fetch_array($result))
                                            {
                                                                    $opmerking= $row['opmerking'];
                                                 echo "Opmerking: ".$opmerking."<br>";
                                            }

}


        $split=  getINIT("split_rooster");
$tekst_grootte=  getINIT("font_size");
        // 25 jan split rooster is variabele die wordt gebruikt om het rooster 2-yolanke-A6 te splitsen
     /* TODO 26 oktober 2015
      huiswerk wordt bepaald op basis van instructiegroep aangegeven bij TAAL en REKENEN
      T1 tm T3 => werk B
      T4 tm T6 => werk C
      T7 => werk D
      Rekenen door midden eerste deel is 5 tweede deel is 6
      */

//      Vaklessen gym, Atelier en Natuur en Muziek en dans
//              In vakles aangeven welke vaklessen er gegeven worden en dan of docent of instructiegroep.
//                  Als er een instructiegroep is aangegeven dan volgt de leerling
//                  die les conform zijn instructiegroep anders volgt de leerling de docent.

//      done - stilwerkruimte alleen medewerker ->

//      TO VO L en S gaan weg en komt terug => waar ze werken. Bij niets invullen zijn ze niet speciaal.

//              //              Als er in het rooster geen instructieles gepland is en geen vakles voo rdie leerling dan moet deze naar zijn ruimte (van docent).
//    Additief vakje toevoegen dag of week taak
      //

      // 7/8
     // overzichttaken -> uitsplitsing alleen voor rekenen en taal. zelfstandig en instructie. instructiewerk komt in roosterhok.

function getStudentName($id)
{

  $sql="select * from student where iId='".$id."'";
// zoek voro desbetreffende leerling een instructieles in dit veld. Als je niets vindt dan moet er gezocht worden naar een instructieles in het standaard instructierooster
//echo $sql;
     $resultaat=mysql_query($sql);
                  while($row = mysql_fetch_array($resultaat))
                   {
                      $naam=$row['sNaam'];
                  }

                  return $naam;
                   }


                   function   makeDay($dag){
     echo "<table class=\"table table-striped table-bordered table-hover\">
                                        <thead>
                                            <tr>
                                                <th>WT</th>
                                                 <th>Wat</th>
                                                 <th>Plek</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            ";
                                               haalDagroosterOp($dag, "1");

                                               haalDagroosterOp($dag,"2");






                                               haalDagroosterOp($dag,"3");







                                           echo "

<tr>
                                                <td colspan=3 class='center-text' >".haalAlgemeen("eindeochtend")."</td>
                                              </tr>";

                                               haalDagroosterOp($dag,"4");



                                               haalDagroosterOp($dag,"5");




                                            echo "
                                            <tr>
                                                    <td colspan=3 class='center-text'>".haalAlgemeen("middag")."</td>
                                              </tr>

                                              ";
                                               haalDagroosterOp($dag,"6");




                                               haalDagroosterOp($dag,"7");






                                               haalDagroosterOp($dag,"8");

                                                 haalDagroosterOp($dag,"9");

                                           echo "
                                        </tbody>
                                </table>
                                ";
 }


  function makeoddDay($dag){
     echo "<table class=\"table table-striped table-bordered table-hover\">
                                        <thead>
                                            <tr>
                                                <th>WT</th>
                                                 <th>Wat</th>
                                                 <th>Plek</th>
                                            </tr>
                                        </thead>
                                        <tbody>";
      haalDagroosterOp($dag,"1");

                                               haalDagroosterOp($dag,"2");






                                               haalDagroosterOp($dag,"3");







                                           echo "
                                           <tr>
                                                <td colspan=3 class='center-text'>".haalAlgemeen("eindeochtend")."</td>
                                              </tr>";

                                               haalDagroosterOp($dag,"4");



                                               haalDagroosterOp($dag,"5");


                                                 haalDagroosterOp($dag,"6");

                                           haalDagroosterOp($dag,"7");











                                           echo "<tr>
                                                <td colspan=3 class='center-text'>".haalAlgemeen("einde_dag")."</td>
                                              </tr>
                                        </tbody>
                                </table>
                                ";
 }



 function getHomework($dag)
                  {


       echo "<table class=\"table table-striped table-bordered table-hover\">
                                        <thead>
                                            <tr>
                                                <th colspan='3'>Verplicht werk</th>

                                            </tr>
                                        </thead>
                                        <tbody>";
       // rooster voor volgende week
                                           $week=$_SESSION['weeknummer']+1;
                                           $klas_ll=$_SESSION['klas'];
                                            $sSql = "
                                                SELECT
                                                   *
                                                FROM
                                                    task WHERE iWeek='".intval($week)."' AND klas='".$klas_ll."' AND dag='".$dag."'";
if ($_GET['test']!=''){echo   $sSql; $_SESSION = array();}
// controle op course  AND iCourse='".$sss."'
                                            $result = mysql_query($sSql);
//echo $sSql;
                                            while($row = mysql_fetch_array($result))
                                            {
                                               $niveau_leerling=haalniveauop($_SESSION["leerlingID"],$row['iCourse'],1);
                                                $dag=$row['dag'];
                                                $klas=$row['klas'];
                                                 $niveau_taak=$row['sub'];
                                                $weeknummer=$row['iWeek'];

                                          //  echo haalNaamVak($row['iCourse'])."-".$klas."-".$niveau_taak."-".$niveau_leerling."<br>";

                                               $tekst_grootte=  getINIT("font_size");

                                                      // behalve rekenen, taal sw kien etc
                                                  if ($niveau_leerling==$niveau_taak )
                                                  {
                                                      //echo "YIO";

                                                    $td_array[]= "<tr><td style=\"font-size:".$tekst_grootte.";padding:3px\">".haalNaamVak($row['iCourse'])."</td><td style=\"font-size:".$tekst_grootte.";padding:3px\">".$niveau_taak."-".$row['sTask']."</td><td></td></tr>";
                                                  }
                                                   if ($niveau_leerling!=$niveau_taak )
                                                  {
                                                   if (
                                                            $row['iCourse']==41
                                                           || $row['iCourse']==32
                                                            || $row['iCourse']==42
                                                           || $row['iCourse']==33
                                                           || $row['iCourse']==34
                                                           || $row['iCourse']==40
                                                           || $row['iCourse']==26
                                                           || $row['iCourse']==16

                                                           )
                                                   {
                                                   $td_array[]= "<tr><td style=\"font-size:".$tekst_grootte.";padding:3px\">".haalNaamVak($row['iCourse'])."</td><td style=\"font-size:".$tekst_grootte.";padding:3px\">".$row['sTask']."</td><td></td></tr>";

                                                   }
//                                                       in principe wordt er alleen gekozen om de vakken van de leerling weg te schrijven boven aan de roosters

//                                                       if ($row['iCourse']==39)
//                                                   {
//
//                                                           $td_array[]= "<tr><td>".haalNaamVak($row['iCourse'])."</td><td>".$row['sTask']."</td><td></td></tr>";
//
//                                                   }


                                                   }


                                               }
                                              // wegschrijven van de tekst maar eerst dubbele eruit halen.
                                                        $ges_td=array_unique($td_array);
                                                        foreach ($ges_td as $key => $value) {
                                                               echo $value;
                                                               $context_aanwezig=1;
                                                      }




                                              if ($context_aanwezig==0){
                                                echo "<tr><td colspan=3>Geen werk voor vandaag</td></tr>";
                                            }


                                          echo "         </tbody>
                                </table>";



                                            }


function getAdditionalCourse($blok_rooster,$blok_deel_rooster,$docent,$dag)
                {

        $week=$_SESSION['weeknummer']+1;



    $sSql="SELECT * FROM  `extra_vakken` WHERE blok='".$blok_rooster."' AND klas='".$docent."' AND week='".$week."' AND dag='".$dag."'";
                                         // echo $sSql;
                                            $result_v = mysql_query($sSql);
                                            while($row_v = mysql_fetch_array($result_v))
                                                {
                                                 return $row_v['omschrijving'];
                                                 //echo $row_v['sStage']."<br>";
                                                }
}

function haalniveauop($leerling_id,$course,$hw){
    // Engels = 7
    // taal = 1
    // REkenen = 13
    // op basis van
       $sql="select * from student where iId='".$leerling_id."'";
            //echo $sql."<br>";
             $resultaat=mysql_query($sql);
             while($row = mysql_fetch_array($resultaat))
               {

                 $instructiegroep=$row['iInstructiegroep'];
                $_SESSION['instructiegroep_leerling']=$instructiegroep;

               }

//    if ($course=="7")
//        {
//
//
//        if ($instructiegroep<4){return "B";}
//        if ($instructiegroep<6 && $instructiegroep >3 ){return "C";}
//        if ($instructiegroep=="7"){return "D";}
//
//        }

    if ($course=="37")
        {
        // taal laatste aanpassing mei 2016
        // uit database halen taal niveau op basis hiervan niveau teruggeven.
        // niveau uit tabel student_course_stage.

                $sql="select * from student_course_stage where iStudentId='".$_SESSION["leerlingID"]."'"
                        . " AND iCourseId='".$course."'";
            //echo $sql."<br>";
             $resultaat=mysql_query($sql);
             while($row = mysql_fetch_array($resultaat))
               {

                 $inst_taal=$row['sStage'];


               }
       if ($hw!=0)   {
        if ($inst_taal<6 ){return "B";}
        if ($inst_taal>5){
            if ($inst_taal<11){return "C";}
        }
        if ($inst_taal=="11"){return "D";}

       }

        if ($hw!=1)   {  return $inst_taal;}


        }
     if ($course=="39")
        {

         $sql="select * from student_course_stage where iStudentId='".$_SESSION["leerlingID"]."'"
                 . " AND iCourseId='".$course."'";
            //echo $sql."<br>";
             $resultaat=mysql_query($sql);
             while($row = mysql_fetch_array($resultaat))
               {

                 $inst_rekenen=$row['sStage'];


               }

        if ($hw!=0)   {

            if ($inst_rekenen<6){
         return "R5";}
        if ($inst_rekenen>5){return "R6";}
        }
           if ($hw!=1)   {  return $inst_rekenen;}


        }

    if ($course=="27")
        {

         $sql="select * from student_course_stage where iStudentId='".$_SESSION["leerlingID"]."'"
                 . " AND iCourseId='".$course."'";
          //  echo $sql."<br>";
             $resultaat=mysql_query($sql);
             while($row = mysql_fetch_array($resultaat))
               {

                 $inst_NB=$row['sStage'];
               return $inst_NB;

               }
               //echo "het niveau voor deze leerling is".$inst_rekenen;






        }
         if ($course=="20")
        {

         $sql="select * from student_course_stage where iStudentId='".$_SESSION["leerlingID"]."'"
                 . " AND iCourseId='".$course."'";
          //  echo $sql."<br>";
             $resultaat=mysql_query($sql);
             while($row = mysql_fetch_array($resultaat))
               {

                 $inst_S=$row['sStage'];
               return $inst_S;

               }
               //echo "het niveau voor deze leerling is".$inst_rekenen;






        }

          if ($course=="15")
        {

         $sql="select * from student_course_stage where iStudentId='".$_SESSION["leerlingID"]."'"
                 . " AND iCourseId='".$course."'";
          //  echo $sql."<br>";
             $resultaat=mysql_query($sql);
             while($row = mysql_fetch_array($resultaat))
               {

                 $inst_RK=$row['sStage'];
               return $inst_RK;

               }
               //echo "het niveau voor deze leerling is".$inst_rekenen;






        }

    else {
   return $instructiegroep;
    }

}
 function getTeacher($klas)
 {
   $sql="select sNaam from teachers where klas='".$klas."'";
   //echo $sql;
             $resultaat=mysql_query($sql);
             while($row = mysql_fetch_array($resultaat))
               {

                 return $row['sNaam'];
               }

 }

 function getNameTeacher($id)
 {
   $sql="select sNaam from teachers where sCode='".$id."'";
   //echo $sql;
             $resultaat=mysql_query($sql);
             while($row = mysql_fetch_array($resultaat))
               {

                return $row['sNaam'];
               }

 }


        function haalNaamVak($id)
        {
          $sql="select * from courses where id='".$id."'";

             $resultaat=mysql_query($sql);
             while($row = mysql_fetch_array($resultaat))
               {
                 return $row['naam'];
               }

        }

        function haalNaamstudent($id)
        {
            $sql="select * from student where iId='".$id."'";

             $resultaat=mysql_query($sql);
             while($row = mysql_fetch_array($resultaat))
               {
                 return $row['sNaam'];
               }
        }


        function haalExtraroosterop($dag,$blok){
            ConnectSQLDatabase();
            $week=date("W")+1;
            //echo "weeknummer".$week;
            $split=  getINIT("split_rooster");
            //dubbel
              $sql="select * from schedule_extra where weeknummer='".$week."' and dag='".$dag."' and blok='".$blok."'";

             $resultaat=mysql_query($sql);

             while($row = mysql_fetch_array($resultaat))
               {

               $locatie= array("paars", "blauw", "groen","oranje", "vloer","stilwerk","vakles");
               $wat_docent[].=$row['paars'];
               $wat_docent[].=$row['blauw'];
               $wat_docent[].=$row['groen'];
                $wat_docent[].=$row['geel'];
                $wat_docent[].=$row['vloer'];
                $wat_docent[].=$row['stilwerk'];
                $wat_docent[].=$row['vakles'];
                $klas_ll=$_SESSION['klas'];

               // $docent=getTeacher($klas_ll);

                for ($i=0;$i<count($wat_docent);$i++)
                {

                 $elementen = explode($split, $wat_docent[$i]);


                $vak_db=$elementen[0];
                $docent_db=trim($elementen[1]);
                $instructiegroep_rooster=$elementen[2];

                $niveau_leerling=haalniveauop($_SESSION["leerlingID"], $vak_db,0)   ;
                //echo $niveau_leerling."-".$instructiegroep_rooster;
            //var_dump($elementen);

                     if ($niveau_leerling==$instructiegroep_rooster)
                         {

                             $wat.= haalNaamVak($vak_db)." (".$docent_db.")<br>";

                             $plek.=$locatie[$i]."<br>";
                          }
                      // MAAR vaklessen hebben nu eenmaal geen instructiegroep dus
                          if ($instructiegroep_rooster=="" && $docent_db=="Karen"){$docent_db="Joyce";$docent_db_alternatief="Karen";}
                           if ($i==6 && $instructiegroep_rooster=="" && $docent_db== getNameTeacher($_SESSION['sCode']))
                         {
                             if ($docent_db_alternatief!=""){$docent_db="Karen";}
                             $wat.= haalNaamVak($vak_db)." (".$docent_db.")<br>";

                             $plek.=$locatie[$i]."<br>";
                             $docent_db_alternatief="";
                          }



                }
                $antwoord[0]=$blok;
                $antwoord[1]=$wat;
                $antwoord[2]=$plek;
               // var_dump($antwoord);
               }
            return $antwoord;

        }



         function haalDagroosterOp($dag,$blok)
                {
            // huidige week.
           ConnectSQLDatabase();
             $split=  getINIT("split_rooster");
           $week=intval(date('W'))+1;
             $sql="select * from schedule where weeknummer='".$week."' and dag='".$dag."' and blok='".$blok."'";
        // echo "<br><pre>".$sql."</pre>";


             $resultaat=mysql_query($sql);
             while($row = mysql_fetch_array($resultaat))
               {
               $docent_oud="";
               $locatie= array("paars", "blauw", "groen","oranje", "vloer","stilwerk","vakles");
                 $wat_docent[].=$row['paars'];
                 $wat_docent[].=$row['blauw'];
                $wat_docent[].=$row['groen'];
                $wat_docent[].=$row['geel'];
                $wat_docent[].=$row['vloer'];
                $wat_docent[].=$row['stilwerk'];
                $wat_docent[].=$row['vakles'];
                $klas_ll=$_SESSION['klas'];
                $docent=getNameTeacher($_SESSION['sCode']);

                for ($i=0;$i<count($wat_docent);$i++)
                {
               // wat docent is het rooster vak-naam-niveau

                 $elementen = explode($split, $wat_docent[$i]);
                 $instructiegroep_rooster=$elementen[2];
                 // bij vakles is het vakgevuld en de docent.. dan draait het zich om kijken naar docent
                 $vak_db=$elementen[0];

                $docent_db=trim($elementen[1]);




                $niveau_leerling=haalniveauop($_SESSION["leerlingID"], $vak_db,0)   ;
// if ($vak_db==27){
//                echo "<pre>";
//                var_dump($elementen);
//                  echo "</pre>";}



if ($_GET['test']!="" && $dag==5 && $blok=="1"){echo $niveau_leerling."-".$instructiegroep_rooster."-".$vak_db."<br>";}
                     // dit is variabel alleen als klassen twee docenten hebben .
                     if ($docent_db=="Karen"){$docent_db="Joyce";$docent_oud="Karen";}

                     if ($niveau_leerling==$instructiegroep_rooster)
                         {
                          if($docent_oud!=""){$docent_db=$docent_oud;}

                             $wat.= haalNaamVak($vak_db)." (".$docent_db.")<br>";
                             $plek.=$locatie[$i]."<br>";

                          }

                            if ($instructiegroep_rooster=="" && (trim($docent_db)==trim($docent)) && $i==6)
                              {
                                 if($docent_oud!=""){$docent_db=$docent_oud;}
                                      $wat.= haalNaamVak($vak_db)." (".$docent_db.")<br>";
                                      $plek.=$locatie[$i]."<br>";

                          }
                  // een beetje slordige oplossing.
                          if (haalNaamVak($vak_db)=="Lezen" && $algebruikt==0)
                              {

                                         $algebruikt=1;
                                         $wat.= haalNaamVak($vak_db)."<br>";

                             $plek.=""."<br>";
                          }




//                           if (($docent_db==$docent))
//                         {
//
//                             $wat.= $docent_db."<br>";
//                             $plek.=$locatie[$i]."<br>";
//                          }
//                    }


                $extrataak=haalExtraroosterop($dag,$blok);
              //echo "Bram".$blok;
                $docent_oud="";

                }


                if (($blok=="9" || $blok=="1")&& $wat=="" && $extrataak[1]=="")
                {
                    if ($blok=="9"){$moment="einde_dag";}
                    if ($blok=="1"){$moment="ochtend";}
                    $td_wat_plek.= "<tr><td colspan=3 class='center-text'>".haalAlgemeen($moment)."</td></tr>";

                }





               else
                {

                    if ( $wat=="" && $extrataak[1]=="")
                       {
                           $omschrijving=getAdditionalCourse($blok,$blok_deel_rooster,$_SESSION['sCode'],$dag);
                          //echo "dsf";
                         // exit();
                           // als er geen informatie wordt gevonden dan alleen blok laten zien.
                          $td_wat_plek.="<tr><td>".$blok."</td><td>".$omschrijving."</td><td></td></tr>";
                       }
                   if ( $wat!="" || $extrataak[1]!="")
                      {
                       $td_wat_plek.= "<tr><td>".$blok."</td><td>".$wat.$extrataak[1]."</td><td>".$plek.$extrataak[2]."</td></tr>";
                      }
                 if ($blok=="9")
                {
                $td_wat_plek.= "<tr><td colspan=3 class='center-text'>".haalAlgemeen("einde_dag")."</td></tr>";


                }

               }

               // $td_wat_plek.= "<tr><td>".$blok."</td><td>".$wat.$extrataak[1]."</td><td>".$plek.$extrataak[2]."</td></tr>";





                }











                echo $td_wat_plek;
                $td_wat_plek="";
        }


        ?>
    </head>

    <body>
  <div class="center" id='loadingimg'><img src="img/pdfloader.gif"></div>
        <div id="wrapper">
         <?php include ("menutop.inc"); ?>
 		 <?php include ("menu.inc") ;?>

            <!-- Page Content -->
            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <ol class="breadcrumb text-xs">
                            <li><a href="#">Home</a></li>
                            <li class="active">Medewerker</li>
                               <li class="active">Weekrooster</li>
                        </ol>

                        <div class="panel panel-default">
                            <div class="panel-heading">

                        <div class="pull-right">


                                      <div class="btn-group">
                                      <form method="post" action="test_tmp.php" id="leerlingentabel" ajax="true">
                                      <input type=text id='test' hidden>
                                      <input type=text id='test_restweek' hidden>

                                           <button type="submit" class="btn btn-default dropdown-toggle">
                                            <i class="fa fa-file-pdf-o"></i>
                                        </button>
                                      </form>




                                    </div>


                                </div>
                                 <h4 class="margin-none">
                                    <i class="fa fa-calendar"></i> Weektaak <span id="leerlingnaam"><?php echo getStudentName($_SESSION['leerlingID']);?> </span>, week <?php if ($week=="17"){echo $week+2;}else {echo $week;}?>
                                </h4>
                               <p class="text-muted text-xs margin-none"><?php echo date("d-m-yy");?></p>
                            </div>


                        </div>


                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
<div class="row" id="tabel_rooster" name="">

                    <div class="col-lg-4">
                        <div class="panel panel-default">
                            <div class="panel-body" style="height:850px" id="tabel_rooster_maandag">
                                <h5>Maandag</h5>

                                           <?php
                                                   getHomework("1");





                               makeDay("1");?>

                            </div>
                        </div>
                    </div>
<!--     einde maandag-->

<!--begin dinsdag-->
  <div class="col-lg-4">
                       <div class="panel panel-default">
                            <div class="panel-body" style="height:850px" id="tabel_rooster_dinsdag">
                                <h5>Dinsdag</h5>

                                           <?php
                                                   getHomework("2");





                               makeoddDay("2");
                               getRemark($leerling_id);
                               ?>

                            </div>
                        </div>
                    </div>

<!--eind dinsdag-->
<!--begin woensdag-->
  <div class="col-lg-4">
                        <div class="panel panel-default">
                            <div class="panel-body" style="height:850px" id="tabel_rooster_woensdag">
                                <h5>Woensdag</h5>

                                           <?php
                                                   getHomework("3");





                               makeDay("3");?>

                            </div>
                        </div>
                    </div>
<!--eind woensdag-->
<!--begin donderdag-->
  <div class="col-lg-4">
                         <div class="panel panel-default">
                            <div class="panel-body" style="height:850px" id="tabel_rooster_donderdag">
                                <h5>Donderdag</h5>

                                           <?php
                                                   getHomework("4");





                               makeoddDay("4");?>

                            </div>
                        </div>
                    </div>
<!--eind donderdag-->
<!--begin vrijdag-->
<div class="col-lg-4">
                           <div class="panel panel-default">
                            <div class="panel-body" style="height:850px" id="tabel_rooster_vrijdag">
                                <h5>Vrijdag</h5>

                                           <?php
                                                   getHomework("5");





                               makeDay("5");?>

                            </div>
                        </div>
                    </div>
<!--eind vrijdag-->
  <div class="col-lg-4">
                        <div class="panel panel-default">
                            <div class="panel-body" style="height:850px" id="tabel_rooster_werk">

                                <table class="table table-striped table-bordered table-hover" >
                                        <thead>
                                            <tr>
                                                <th colspan='3'>Weekopdrachten</th>

                                            </tr>
                                        </thead>
                                        <tbody>

                                           <?php
                                           // Bekijk naar rijen in het rooster
                                           // controle op dag 0=ma 1 di
                                           // en op klas
                                           $td_array="";
                                           $week=$_SESSION['weeknummer']+1;
                                           $klas_ll=$_SESSION['klas'];


                                                    $sSqle = "
                                                SELECT
                                                    *
                                                FROM
                                                    task WHERE iWeek=".$week." AND klas='".$klas_ll."' AND (iCourse='36')"

                                                        ;
                                               // echo "1 ".$sSqle."<br>";

                                                 $resulte = mysql_query($sSqle);
                                                 while($rowe = mysql_fetch_array($resulte))
                                                        {

                                                   //echo "vergelijk -".haalniveauop($leerling_id,$rowe['iCourse'])."-".$rowe['sub']."<br>";

                                                    $td_array[]= "<tr><td colspan=\"2\">".preg_replace('/\n/', "</td><td> </td></tr><tr><td colspan=\"2\">", $rowe['sTask'])."</td><td> </td></tr>";







                                                        }
                                              // wegschrijven van de tekst maar eerst dubbele eruit halen.
                                                        $ges_td=array_unique($td_array);
                                                       // var_dump($ges_td);
                                                        foreach ($ges_td as $key => $value) {
                                                   echo $value;
                                                   $context_aanwezig=1;
                                               }




                                              if ($context_aanwezig==0){
                                                echo "<tr><td colspan=3>Geen werk voor deze week</td></tr>";
                                            }
                                            ?>

                                        </tbody>
                                </table>



                                <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th colspan='3'>Extra werk</th>

                                            </tr>
                                        </thead>
                                        <tbody>

                                          <?php
                                           // Bekijk naar rijen in het rooster
                                           // controle op dag 0=ma 1 di
                                           // en op klas
                                          $td_array="";
                                           $week=$_SESSION['weeknummer']+1;
                                           $klas_ll=$_SESSION['klas'];


                                                    $sSqle = "
                                                SELECT
                                                    *
                                                FROM
                                                    task WHERE iWeek=".$week." AND klas='".$klas_ll."' AND (iCourse='38')"

                                                        ;
                                                //echo "1 ".$sSqle."<br>";

                                                 $resulte = mysql_query($sSqle);
                                                 while($rowe = mysql_fetch_array($resulte))
                                                        {

                                                   //echo "vergelijk -".haalniveauop($leerling_id,$rowe['iCourse'])."-".$rowe['sub']."<br>";

                                                    $td_array[]= "<tr><td colspan=\"2\">".preg_replace('/\n/', "</td><td> </td></tr><tr><td colspan=\"2\">", $rowe['sTask'])."</td><td> </td></tr>";







                                                        }
                                              // wegschrijven van de tekst maar eerst dubbele eruit halen.
                                                        $ges_td=array_unique($td_array);
                                                      // var_dump($ges_td);
                                                        foreach ($ges_td as $key => $value) {
                                                   echo $value;
                                                   $context_aanwezig=1;
                                               }




                                              if ($context_aanwezig==0){
                                                echo "<tr><td colspan=2>Geen werk voor deze week</td></tr>";
                                            }
                                            ?>

                                        </tbody>
                                </table>


                            </div>
                        </div>
                    </div>

                    <!-- /.col-lg-12 -->
                </div>












<!--            // rooster voor pdf-->

<!--            // einde rooster pdf-->
            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->

<script>



  $(document).ready(function (){
      $("#loadingimg").hide();



     var leerling_naam=$("#leerlingnaam").html();
          var leerling_opmerking=$("#opmerking").html();
       var data_maandag=$("#tabel_rooster_maandag").html();
        var data_dinsdag=$("#tabel_rooster_dinsdag").html();
         var data_woensdag=$("#tabel_rooster_woensdag").html();

       var data_donderdag=$("#tabel_rooster_donderdag").html();
        var data_vrijdag=$("#tabel_rooster_vrijdag").html();
         var data_werk=$("#tabel_rooster_werk").html();

         var data='<table style=\'background-color:white;\'><tr style=\'background-color:white;\'><td style=\'background-color:white;width:325px;vertical-align: text-top;\'>'+data_maandag+'</td><td style=\'width:10px\'></td><td style=\'background-color:white;width:325px;vertical-align: text-top;\'>'+data_dinsdag+'Werkrooster van werker : '+leerling_naam+ ' (pagina 1/2)</td><td style=\'background-color:white;width:10px\'></td><td style=\'background-color:white;width:325px;vertical-align: text-top;\'>'+data_woensdag+'</td></tr></table>';
        //alert(data);
         $("#test").val(data);
        var data_restweek='<table style=\'background-color:white\'><tr style=\'background-color:white;\'><td style=\'background-color:white;width:325px;vertical-align: text-top;\'>'+data_donderdag+'Werkrooster van werker : '+leerling_naam+ ' (pagina 2/2)</td><td style=\'background-color:white;width:10px;vertical-align: text-top;\'></td><td style=\'background-color:white;width:325px;vertical-align: text-top;\'>'+data_vrijdag+'</td><td style=\'background-color:white;width:10px\'></td><td style=\'background-color:white;vertical-align:top;width:325px;vertical-align: text-top;\'>'+data_werk+'</td></tr></table>';
        //alert(data);
         $("#test_restweek").val(data_restweek);

    $('form').submit(function(e) {



        e.preventDefault();


        $("#loadingimg").show();
       window.location.href = "http://keesboeke.guifiontwikkelt.nl/dompdf";


    });





});





// wegschrijven van gegevens als de pagina is geladen.
$(document).ready(function (){
      $("#loadingimg").hide();


        var form_data = $("#test").val();
        var form_data_rest= $("#test_restweek").val();
         var form_url = "test_tmp.php";
        var form_method = "POST";
        //console.log($("#test").val());
       // $("#loadingimg").show();

        $.ajax({
            url: form_url,
            type: form_method,
            data: {q:form_data,r:form_data_rest},
            cache: false,
            success: function(returnhtml){
               // $("#output").html(returnhtml);
                //window.location.href = "http://keesboeke.guifiontwikkelt.nl/dompdf";


            }
        });

    });
        </script>
</script>
      <?php include ("footer.inc") ;?>

    </body>

</html>