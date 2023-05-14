<?php

const MyConst = true;

require "connection.php";
require "funkce.php";
$_POST = json_decode(file_get_contents('php://input'), true);
if (array_key_exists("id", $_POST)) {
    $conn = DbCon();
    $sql = "SELECT p.Nazev , Poce_kusu , p.ID_P ,p.Cena_Bez_DPH 
                FROM  objednavka_predmet 
                left join predmety p on p.ID_P = objednavka_predmet.ID_P 
                WHERE ID_OB = ?";

    $res = mysqli_fetch_all(mysqli_execute_query($conn, $sql, [$_POST["id"]]), ASSERT_ACTIVE);
    echo "<div class='table-group'>";
    echo "<div> 
                <span>Předměty</span>
                <table> 
                <thead>
                    <tr>
                        <th>ID produktu</th>
                        <th>Nazev</th>
                        <th>Pocet</th>
                        <th>Cena za kus</th>
                    
                    </tr>
                </thead>
                <tbody>";
    foreach ($res as $item) {
        $cena = number_format(intval($item["Cena_Bez_DPH"]), thousands_separator: ' ');
        echo "<tr>
                    <td>{$item["ID_P"]}</td>
                    <td>{$item["Nazev"]}</td>
                    <td>{$item["Poce_kusu"]}</td>
                    <td>$cena Kč/ks</td>
                  </tr>";
    }
    echo "</tbody></table></div>";

    $sql = "SELECT du.Telefon , du.Email , du.Jmeno,du.Přijmeni ,du.Mesto,du.Ulice_Cp,du.PSC
                FROM  objednavka 
                left join dodaci_udaje du on du.ID_DU = objednavka.ID_DU 
                WHERE ID_OB = ?";

    $res = mysqli_fetch_all(mysqli_execute_query($conn, $sql, [$_POST["id"]]), ASSERT_ACTIVE)[0];
    echo "<div> 
                <span>Kontaktní údaje</span>
                <table> 
                <thead>
                    <tr>
                        <th>Jméno</th>
                        <th>Přijmení</th>
                        <th>Email</th>
                        <th>Telefon</th>
                    
                    </tr>
                </thead>
                <tbody>
                <tr>
                    <td>{$res["Jmeno"]}</td>
                    <td>{$res["Přijmeni"]}</td>
                    <td>{$res["Email"]}</td>
                    <td>{$res["Telefon"]}</td>
              </tr>
        
        </tbody>
        </table>
         </div>
         <div>
        <span>Dodací údaje</span>
        <table> 
                <thead>
                    <tr>
                        <th>Mesto</th>
                        <th>Ulice</th>
                        <th>PSČ</th>      
                    </tr>
                </thead>
                <tbody>
                <tr>
                    <td>{$res["Mesto"]}</td>
                    <td>{$res["Ulice_Cp"]}</td>
                    <td>{$res["PSC"]}</td>
              </tr>
        
        </tbody></table>
        </div>";
    echo "</div>";
}
