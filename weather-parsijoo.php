<html>
<head>
    <title>
        weather
    </title>
    <style>
        ul {
            list-style-type: none;
        }

        ul li {
            display: inline-block;
            width: 250px;
            margin: 10px 10px;
            background: #DDD;
            padding: 20px 20px;
            color: #00b4ae;

        }

        ul li img {
            width: 100px;
            height: auto;
        }

        form {
            width: 500px;
            height: auto;
            margin: 5px 10px;

        }

        form p {
            color: #1e6abc;
            font-size: 18px;

        }

        form input[type="text"] {
            width: 280px;
            height: 30px;
            border: none;
            border-right: solid 2px #0c486c;
            color: #0c486c;
            padding: 0px 10px;
            font-size: 16px;
        }

        form input[type="text"]:focus {
            background: #DDD;
        }

        form input[type="submit"] {
            width: 120px;
            height: 30px;
            background: #0c486c;
            color: #FFF;
            cursor: pointer;
            border: none;
            transition: 0.4s;
        }

        form input[type="submit"]:hover {
            background: #2276d2;
        }

        i {
            font-size: 15px;
            color: #DD4A68;
            margin: 5px 20px;
        }
    </style>
</head>
<body dir="rtl">
<form action="" method="get">
    <p>نام شهر خود را وارد کنید</p>
    <input type="text" name="city" placeholder="نام شهر...">
    <input type="submit" value="جستجو"/>
</form>
<?php
if (isset($_GET['city'])) {
    if (empty($_GET['city'])) {
        echo "<i>لطفا شهر خود را وارد کنید</i>";
    } else {
        weather($_GET['city']);
    }
} else {
    weather('تاکستان');
}

?>
</body>


</html>

<?php
function weather($city)
{
    $url = "http://parsijoo.ir/api?serviceType=weather-API&q=$city";

    /************************/
    $doc = new DOMDocument();
    $doc->load($url);

    $days = $doc->getElementsByTagName("day");
    echo '<ul>';
    foreach ($days as $day) {
        echo '<li>';
        $daynames = $day->getElementsByTagName("day-name");
        @$dayname = $daynames->item(0)->nodeValue;


        $symbols = $day->getElementsByTagName("symbol");
        @$symbol = $symbols->item(0)->nodeValue;

        $statuss = $day->getElementsByTagName("status");
        @$status = $statuss->item(0)->nodeValue;

        $temps = $day->getElementsByTagName("temp");
        @$temp = $temps->item(0)->nodeValue;


        $citynames = $day->getElementsByTagName("city-name");
        @$cityname = $citynames->item(0)->nodeValue;


        $mintemps = $day->getElementsByTagName("min-temp");
        @$mintemp = $mintemps->item(0)->nodeValue;


        $maxtemps = $day->getElementsByTagName("max-temp");
        @$maxtemp = $maxtemps->item(0)->nodeValue;

        echo "<h1>$cityname</h1>";

        $link = 'http://cdn.parsijoo.ir/static/home/source/cdn/images/services/weather';
        echo '<img src="' . $link . '/' . $symbol . '.png"';

        echo "<p>روز:$dayname  &emsp14;  $status</p>";
        echo "<p>درجه:$temp سیسیوس</p>";
        echo "<p>کمترین دما:$mintemp درجه</p>";
        echo "<p>بیشترین دما:$maxtemp درجه</p>";


        echo '</li>';
    }
    echo '</ul>';
}

?>


