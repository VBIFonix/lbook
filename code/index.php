<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>index.php</title>
<!--<link rel="stylesheet" type="text/css" href="style.css">-->
</head>
<body>
<h1>lbook.php</h1>
<?php
$i = 1;
define (HOST, "localhost");
define (USER, "root");
define (PWD, "0312120213");
define (DB_NAME, "lbook_db");
$dbc = mysqli_connect(HOST, USER, PWD, DB_NAME) //Подключение
	or die ('Ошибка подключения к базе данных');
/*--ЗАПРОСЫ СВЯЗАННЫЕ С КОДИРОВКОЙ (НЕ МЕНЯТЬ, СТАВИТЬ СРАЗУ ПОСЛЕ ПОДКЛЮЧЕНИЯ К БАЗЕ ДАННЫЙ)--*/
$charset_1 = mysqli_query ($dbc, "SET CHARACTER SET 'utf8'")
	or die ('Ошибка кодировки');
$charset_2 = mysqli_query ($dbc, "SET NAMES 'utf8'")
	or die ('Ошибка кодировки');
$charset_3 = mysqli_query($dbc, 'SET character_set_database = utf8')
	or die ('Ошибка кодировки');
	if (!$_GET['weekid']) {
$query4 = ('SELECT MAX(weekid) FROM date;');
$result4 = mysqli_query($dbc, $query4);
while ($row4 = mysqli_fetch_array($result4, MYSQL_ASSOC)){
$weekid = $row4['MAX(weekid)'];
echo "<h3>Неделя №" . $weekid . "</h3>";
$query = ('SELECT * FROM dotw;');
$result = mysqli_query($dbc, $query);
while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)){
$dotw = $row["name"];
$dotw_id = $row ["id"];
echo  "<hr>" . $dotw . "<br>";
$query2 = "SELECT * FROM date WHERE dotw_id = $dotw_id HAVING weekid = $weekid;";
$result2 = mysqli_query ($dbc, $query2);
while ($row2 = mysqli_fetch_array($result2, MYSQL_ASSOC)) {
echo $row2['date'];
$dateid = $row2['id'];
$query3 = "SELECT * FROM lessons WHERE date_id = $dateid;";
$result3 = mysqli_query ($dbc, $query3);
while ($row3 = mysqli_fetch_array ($result3, MYSQL_ASSOC)) {
echo "<table><tr><td>" . $row3['name'] . "</td><td>" . $row3 ['subject']. "</td><td>" . $row3 ['hometask']. "</td><td>" . $row3 ['mark'] . "</td>";
}
echo "</table>";
}
}
echo "<hr>";
}
}
else {
echo "<h3>Неделя №" . $_GET['weekid'] . "</h3>";
$weekid = $_GET['weekid'];
$query = ('SELECT * FROM dotw;');
$result = mysqli_query($dbc, $query);
while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)){
$dotw = $row["name"];
$dotw_id = $row ["id"];
echo  "<hr>" . $dotw . "<br>";
$query2 = "SELECT * FROM date WHERE dotw_id = $dotw_id HAVING weekid = $weekid;";
$result2 = mysqli_query ($dbc, $query2);
while ($row2 = mysqli_fetch_array($result2, MYSQL_ASSOC)) {
echo $row2['date'];
$dateid = $row2['id'];
$query3 = "SELECT * FROM lessons WHERE date_id = $dateid;";
$result3 = mysqli_query ($dbc, $query3);
while ($row3 = mysqli_fetch_array ($result3, MYSQL_ASSOC)) {
echo "<table><tr><td>" . $row3['name'] . "</td><td>" . $row3 ['subject']. "</td><td>" . $row3 ['hometask']. "</td><td>" . $row3 ['mark'] . "</td>";
}
echo "</table>";
}
}
echo "<hr>";
}
$weekminusone = $weekid - $i;
$weekplusone = $weekid + $i;
if ($_GET['weekid'] == 1) {
echo "<a href=" . $_SERVER['PHP_SELF'] . "?weekid=" . $weekplusone . ">Следующая неделя>></a>";
}
else {
echo "<a href=" . $_SERVER['PHP_SELF'] . "?weekid=" . $weekminusone . "><<Предыдущая неделя</a> | ";
echo "<a href=" . $_SERVER['PHP_SELF'] . "?weekid=" . $weekplusone . ">Следующая неделя>></a>";
}
?>
</body>
</html>