

<?php
require_once "../Classes/Classes.php";

$classManager = new classmanager();
$urlarray = array();      
$searchvalue = '';
$status = '';

$urlarray = $classManager->geturldetails();
if (isset($_GET["id"])) {
   
    $id = $_GET["id"];
    $stat = $classManager->getshorturl($id);
    $urlarray = $classManager->geturldetails();
    header("Location: ".$stat."");
   
}

if (isset($_POST["submit"])) {
    if (isset($_REQUEST['value'])) {
        $searchvalue = $_REQUEST['value'];
    }
    $status = $classManager->addurl($searchvalue);
}


?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Project 01</title>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script type="text/javascript">
            function getclickcount(id) {
                
                    $.ajax({
                        url: 'click_count_ajax.php',
                        method: 'POST',
                        data: {  id: id },
                        success: function(response) {
                            if (response) {
                               //
                            }
                        },
                        error: function() {
                            alert('Error updating the table.');
                        }
                    });
            }
            
             $(document).ready(function () {
                  var status = $('#status').val();
                  if (status === 'added') {
                      alert('URL added successfully.');
                       status = '';
                      window.location.href = "project01.php";
                      return false;
                  } else  if (status === 'failed') {
                      alert('Error in the process.');
                      window.location.href = "index.php";
                  }
              });
</script>
<style>
    table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
        font-size: 16px;
        text-align: left;
    }
    th, td {
        padding: 12px 15px;
        border: 1px solid #ddd;
    }
    thead {
        background-color: #4CAF50;
        color: white;
    }
    tr:nth-child(even) {
        background-color: #f2f2f2;
    }
    tr:hover {
        background-color: #f1f1f1;
    }
    .tbhead {
        text-align: center;
    }
</style>
    </head>
    <body>
        <input type="hidden" name="status" id="status" value="<?php echo $status; ?>">
        <div id="div_content" align="center">
            <div id="div_body">
                <div id="div_body_content" align="center" >
                    <form method="post" action="project01.php" >
                        <div style=" width:990px; margin-top:20px;" class="boarder_radious">
                            <div style="text-align: center; margin-top: 20px;">
                                <input name="value"  style="width: 766px; height:20px;  margin-left: 100px; display: inline-block;" type="text" value="<?php  ?>" required />
                                <input class="input_button" type="submit" name="submit" style="margin-left: 20px; height:26px; width: 80px;  display: inline-block;" value="Add" onClick="javascript:return validateForm();" />
                            </div>
                        </div>
                    </form>
                        <div style="width:775px;margin-top:10px;" >
                            <table width="100%" border="1">
                                <tr class="tbhead">
                                    <td style="text-align: center;">ID</td>
                                    <td style="text-align: center;">Long URL</td>
                                    <td style="text-align: center;">URL</td>
                                    <td style="text-align: center;">Clicks</td>
                                </tr> 
                                <?php
                                $urlSize = sizeof($urlarray);
                                for ($i = 0; $i < $urlSize; $i++) {
                                    $url = $urlarray[$i];           
                                    ?>
                                    <tr>
                                        <td><?php echo $url['id']; ?></td>
                                        <td><?php echo $url['url']; ?></td>
                                        <td> <a href="http://localhost:8080/Myproject/views/project01.php?id=<?php echo $url['id']; ?>" target="_blank"><?php echo "http://localhost:8080/Myproject/views/project01.php?id=" . $url['id']; ?></a></td>
                                        <!--<td><a href="http://localhost/Myprojects/views/project01.php?=id<?php echo $url['id']; ?>" target="_blank"  onclick="getclickcount('<?php echo $url['id']; ?>')"><?php echo $url['url']; ?> </a></td>-->
                                        <td style="text-align: center;"><?php echo $url['clicks']; ?></td>
                                    </tr>
                                <?php }  ?>
                            </table>
                        </div>
                </div>
            </div>
            <div id="div_footer" align="center"></div>
        </div>

    </body>
</html>
