<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>    
    <form action="" method="POST">
        <br><input type="submit" name="tambah" value="Tambah Data">
    </form>

    <?php
        $tambahData = 0;
        if(isset($_POST['tambah'])){
            ?>
            <form action="" method="POST">
            Luas Bangunan/Orang : <input type="number" name="luasBangunan"><br>
            Bahan Bakar Memasak : <input list="bahanBakar" name="bahanBakar">
                    <datalist id="bahanBakar">
                        <option value="Kayu Bakar">
                        <option value="Gas LPG">
                    </datalist> <br>
            Jenis Lantai : <input list="jenisLantai" name="jenisLantai">
                    <datalist id="jenisLantai">
                        <option value="Ubin">
                        <option value="Plester">
                        <option value="Tanah">
                    </datalist> <br>
            Frekuensi Memakan Daging/Minggu : <input type='number' name='makanDaging'><br>
                <input type="submit" name="tambahData" value="TAMBAH PAK EKOOOO!!!">
            </form>
        <?php
                
        }
        
        function showData($bool){
            $dataTabel=array(array(9, "Kayu bakar", "Ubin", 3, "Sedang"),
                        array(10, "Gas LPG", "Ubin", 2, "Sedang"),
                        array(15, "Gas LPG", "Plester", 2, "Sedang"),
                        array(30, "Gas LPG", "Ubin", 4, "Kaya"),
                        array(16, "Kompor Listrik", "Ubin", 3, "Kaya"),
                        array(25, "Gas LPG", "Ubin", 5, "Kaya"),
                        array(9, "Gas LPG", "Plester", 0.5, "Miskin"),
                        array(8, "Kayu Bakar", "Tanah", 1, "Miskin"),
                        array(10, "Kayu Bakar", "Tanah", 2, "Miskin"),
                        array(14, "Gas LPG", "Tanah", 1, "Miskin"));
            
            if(isset($_POST['tambahData'])){
                array_push($dataTabel, array($_POST['luasBangunan'], $_POST['bahanBakar'], $_POST['jenisLantai'], $_POST['makanDaging'], "Miskin"));
            }

            echo "<table border='1'>
                    <th>Luas Bangunan/Orang</th> 
                    <th>Bahan Bakar Memasak</th> 
                    <th>Jenis Lantai</th>
                    <th>Frekuensi Memakan Daging/Minggu</th>
                    <th>Kategori</th>";

            for ($i=0; $i < count($dataTabel); $i++) {
                $j=0;
                echo "<tr><td>".$dataTabel[$i][$j++]."</td>".
                        "<td>".$dataTabel[$i][$j++]."</td>".
                        "<td>".$dataTabel[$i][$j++]."</td>".
                        "<td>".$dataTabel[$i][$j++]."</td>".
                        "<td>".$dataTabel[$i][$j]."</td>".
                    "</tr>";
            };
            echo "</table>";
        }
        showData($tambahData);
        $tambahData=0;
    ?>
</body>
</html>