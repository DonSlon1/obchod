<!doctype html>
<html lang="cs">
<head>
    <meta name="description" content="Produkt">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="theme-color" content="white">
    <link rel="shortcut icon" href="images/icon-maskable.png"/>
    <link rel="apple-touch-icon" href="images/icon-apple.png">
    <link rel="manifest" href="manifest.json"/>
    <title>Document</title>

    <link rel="stylesheet" href="style/product.css" type="text/css">

    <link rel="stylesheet" href="/node_modules/bootstrap/dist/css/bootstrap.min.css"
          crossorigin="anonymous">
    <link rel="stylesheet" href="style/global.css" type="text/css">
    <link rel="stylesheet" href="style/hledat.css">
    <link rel="stylesheet" href="node_modules/nouislider/dist/nouislider.css">
    <script src="/node_modules/nouislider/dist/nouislider.min.js"></script>
    <script src="/service-worker.js"></script>
    <script src="/node_modules/axios/dist/axios.min.js"></script>
    <script src="/node_modules/jquery/dist/jquery.min.js" crossorigin="anonymous"></script>

    <script src="/node_modules/bootstrap/dist/js/bootstrap.min.js"
            crossorigin="anonymous"></script>


</head>
<?php
    const MyConst = true;

    require "pomoc/connection.php";
    require "pomoc/navigace.php";
    require "pomoc/funkce.php";

    navigace();
    $conn = DbCon();

    $page = isset($_GET['Stranka']) && is_numeric($_GET['Stranka']) ? $_GET['Stranka'] : 1;
    $num_results_on_page = 20;
    $sql = "SELECT COUNT(*) AS Pocet FROM predmety";

    $total_pages = mysqli_fetch_row(mysqli_execute_query($conn, $sql))[0] ?? 0;
    $calc_page = ($page - 1) * $num_results_on_page;
    $parametry[] = $calc_page;
    $parametry[] = $num_results_on_page;

    $sql = "SELECT p.ID_P AS  ID_P ,p.Nazev AS Nazev, Cena_Bez_DPH AS Cena ,H_Obrazek,
                    p.Popis AS Popis , COALESCE(SUM(r.Hodnoceni) / COUNT(r.ID_R),0) AS Hodnocení
                FROM predmety p
                LEFT JOIN recenze r on p.ID_P = r.ID_P 
                GROUP BY p.ID_P , p.Nazev
                ORDER BY p.Nazev
                LIMIT ?,?
                ";
    $predmety = mysqli_fetch_all(mysqli_execute_query($conn, $sql, $parametry), ASSERT_ACTIVE);

    $predmetysave = array();
    foreach ($predmety as $item) {
        $predmetysave[] = array_map('htmlspecialchars', $item);
    }
?>

<div class="container h_container searchh">
    <div class="lajna">

        <div class="main-obsah">
            <?php
                foreach ($predmetysave as $item) {
                    $hodnocei = $item["Hodnocení"] * 20;
                    $cenna = number_format($item["Cena"], thousands_separator: ' ').' Kč';
                    echo("
                <div class='predmet'>
            <a href='/produkt.php?ID_P={$item["ID_P"]}'>
                <div class='obrazek'>
                    <img src='images/{$item["H_Obrazek"]}' alt='{$item["Nazev"]}'>
                </div>

            </a>
            <div class='star-rating-wrapper hvezdy'>
                                    <div class='empty-stars-element'></div>
                                    <div class='stars-element' style='width:$hodnocei%'></div>
                                 </div>
            <div class='informace'>
                <a href='/produkt.php?ID_P={$item["ID_P"]}'>
                    <span class='nazev'>{$item["Nazev"]}</span>
                </a>
                <span class='cena-produkt'>$cenna</span>
            </div>
            <div class='popis'>
                {$item["Popis"]}
            </div>
        </div>");
                }

            ?>


        </div>
    </div>

    <?php if (ceil($total_pages / $num_results_on_page) > 0): ?>
        <ul class="muj-pagination">
            <?php if ($page > 1): ?>
                <li class="prev page" data-page="<?php echo $page - 1 ?>"><span></span></li>
            <?php endif; ?>

            <?php if ($page > 3): ?>
                <li class="start page" data-page="1"><span>1</span></li>
                <li class="dots">...</li>
            <?php endif; ?>

            <?php if ($page - 2 > 0): ?>
            <li class="page" data-page="<?php echo $page - 2 ?>"><span><?php echo $page - 2 ?></span>
                </li><?php endif; ?>
            <?php if ($page - 1 > 0): ?>
            <li class="page" data-page="<?php echo $page - 1 ?>"><span><?php echo $page - 1 ?></span>
                </li><?php endif; ?>

            <li class="currentpage page" id="currentpage" data-page="<?php echo $page ?>"><span
                ><?php echo $page ?></span></li>

            <?php if ($page + 1 < ceil($total_pages / $num_results_on_page) + 1): ?>
            <li class="page" data-page="<?php echo $page + 1 ?>"><span><?php echo $page + 1 ?></span>
                </li><?php endif; ?>
            <?php if ($page + 2 < ceil($total_pages / $num_results_on_page) + 1): ?>
            <li class="page" data-page="<?php echo $page + 2 ?>"><span><?php echo $page + 2 ?></span>
                </li><?php endif; ?>

            <?php if ($page < ceil($total_pages / $num_results_on_page) - 2): ?>
                <li class="dots">...</li>
                <li class="end page" data-page="<?php echo ceil($total_pages / $num_results_on_page) ?>"><span
                    ><?php echo ceil($total_pages / $num_results_on_page) ?></span>
                </li>
            <?php endif; ?>

            <?php if ($page < ceil($total_pages / $num_results_on_page)): ?>
                <li class="next page" data-page="<?php echo $page + 1 ?>"><span></span></li>
            <?php endif; ?>
        </ul>
    <?php endif; ?>

</div>

<script src="/js/global_funcion.js"></script>
<script src="/js/login.js"></script>
<script src="/js/Add_To_cart.js"></script>


</html>

