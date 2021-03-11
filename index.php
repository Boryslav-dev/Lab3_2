<?php
require_once __DIR__ . "/vendor/autoload.php";
include ("database.php");
$coursor=$client->find([],['projection'=>['name'=>1, '_id'=>0]]);
?>

<!DOCTYPE HTML>
<html>
 <head>
  <meta charset="utf-8">
  <title>Lab First</title>
  <script>

  var ajax = new XMLHttpRequest()
  var prev;

  function recordToStorage(ajaxText){
      var temp = localStorage.getItem('form2');
      if(temp == null){
          localStorage.setItem('form2', null);
          prev = ajaxText;
      }
      else{
        localStorage.setItem('form2', prev);
        prev = ajaxText;
      }
  }

  function get1(){
        if (!ajax) {
            alert("Ajax не инициализирован"); return;
            }
            var s1val = document.getElementById("select1").value;
            ajax.onreadystatechange = UpdateSelect1;
            var params = 'select1=' + encodeURIComponent(s1val);
            ajax.open("GET", "processing2.php?"+params, true);
            ajax.send(null); 
        }
    function UpdateSelect1() {
        if (ajax.readyState == 4) {
            if (ajax.status == 200) { 
                var ajaxText = ajax.responseText;
                recordToStorage(ajaxText);
                var rows = JSON.parse(ajax.responseText);
                var result = "";
                var res = document.getElementById("getselect1");
                //document.getElementById("quantity").innerHTML=res.quantity; 
                for (var i = 0; i < rows.length; i++) {
                    result += "<tr>";
                    result += "<td>" + rows[i].balance + "</td>";
                    result += "</tr>";
                }
                res.innerHTML = result;
                }
            else alert(ajax.status + " - " + ajax.statusText);
            ajax.abort();
        }
    } 

    function get2(){
        if (!ajax) {
            alert("Ajax не инициализирован"); return;
            }
            ajax.onreadystatechange = UpdateSelect2;
            ajax.open("GET", "processing.php?", true);
            ajax.send(null); 
        }

    function UpdateSelect2() {
        if(ajax.readyState == 4) {
            if(ajax.status == 200) {
                var ajaxText = ajax.responseText;
                recordToStorage(ajaxText);
                var rows = JSON.parse(ajax.responseText);
                var result = "";
                var res = document.getElementById("getselect2");
                //document.getElementById("quantity").innerHTML=res.quantity; 
                for (var i = 0; i < rows.length; i++) {
                    result += "<tr>";
                    result += "<td>" + rows[i].name + "</td>";
                    result += "</tr>";
                }
                res.innerHTML = result;
                }
            else { alert(ajax.status + " - " + ajax.statusText);
            ajax.abort(); 
            }
        }
    }

    function get3(){
        if (!ajax) {
            alert("Ajax не инициализирован"); return;
            }
            ajax.onreadystatechange = UpdateSelect3;
            ajax.open("GET", "processing3.php?", true);
            ajax.send(null); 
        }

    function UpdateSelect3(){
        if (ajax.readyState == 4) {
            if (ajax.status == 200) {
                var ajaxText = ajax.responseText;
                var rows = JSON.parse(ajax.responseText);
                recordToStorage(ajaxText);
                var result = "";
                var res = document.getElementById("getselect3");
                //document.getElementById("quantity").innerHTML=res.quantity; 
                for (var i = 0; i < rows.length; i++) {
                    result += "<tr>";
                    result += "<td>" + rows[i].in_trafic + "</td>";
                    result += "<td>" + rows[i].out_trafic + "</td>";
                    result += "</tr>";
                }
                res.innerHTML = result;
                }
            else { alert(ajax.status + " - " + ajax.statusText);
            ajax.abort(); }
        }
    }
  </script>  
 </head>
 <body>
 
 <form name ="form1" method="get">
   <p><select id="select1" name="category_id">
   <option value="">Выбирите имя клиента:</option>
    <?php         
    foreach($coursor as $category) 
    { 
       echo '<option value="'. $category['name'] .'">'. $category['name'] .'</option>';
    }
    ?>
  </select>
   <p><input name="submit" type="button" value="Получить информацию" onclick="get1();"></p>
  </form>

  <div id="getselect1"></div>

 <form action="form2" method="get">
  <p>Введите диапазон времени:</p>
  <p><input type="button" value="Получить информацию" onclick="get3();"></p>
</form>

<table id="getselect3"></table>

<div id="getselect4"></div>

 <form  name="form3" method ="get">
  <input type="radio" id="balance" name="balance" value="balance">
  <label for="balance">Получить информацию об отрицательном счёте?</label><br>
  <p><input name = "submit" type="button" value="Получить информацию" onclick="get2();"/></p>
</form>

<table id="getselect2"></table>

</body>
</html>
