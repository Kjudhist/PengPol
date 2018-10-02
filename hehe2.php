<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PENGPOOOOOL</title>
</head>
<body>
    <?php showData();?>    
    <form action="" method="POST">
        <br><input type="submit" name="tambah" value="Tambah Data">
        <input type="submit" name="resetData" value="Reset Data">
    </form>

    <?php
        if(isset($_POST['tambah'])){
            ?>
            <form action="" method="POST">
            Luas Bangunan/Orang : <input type="number" name="luasBangunan" required><br>
            Bahan Bakar Memasak : <input list="bahanBakar" name="bahanBakar" required>
                    <datalist id="bahanBakar">
                        <option value="Kayu Bakar">
                        <option value="Kompor Listrik">
                        <option value="Gas LPG">
                    </datalist> <br>
            Jenis Lantai : <input list="jenisLantai" name="jenisLantai" required>
                    <datalist id="jenisLantai">
                        <option value="Ubin">
                        <option value="Plester">
                        <option value="Tanah">
                    </datalist> <br>
            Frekuensi Memakan Daging/Minggu : <input type='number' name='makanDaging' required><br>
                <input type="submit" name="tambahData" value="TAMBAH DATA BARU">
            </form>
        <?php
        }
        if(isset($_POST['tambahData'])){
            $kategori = getKategori($_POST['luasBangunan'], $_POST['bahanBakar'], $_POST['jenisLantai'], $_POST['makanDaging']);
            $filename = "data.txt";
            $fh = fopen($filename, 'a') or die("can't open file");
            $stringData = ";".$_POST['luasBangunan'].",".$_POST['bahanBakar'].",".$_POST['jenisLantai'].",".$_POST['makanDaging'].",".$kategori;
            fwrite($fh, $stringData);
            fclose($fh);
            header("Refresh:0");
        }

        if(isset($_POST['resetData'])){
            resetData();
        }

        function showData(){            
            $filename = "data.txt";
            $data = file_get_contents($filename);

            $dataTabel = explode(";", $data);
            
            for ($i=0; $i < count($dataTabel); $i++) { 
                $dataTabel[$i] = explode(",", $dataTabel[$i]);
            }

            echo "<table border='1'>
                    <th>No</th>
                    <th>Luas Bangunan/Orang</th> 
                    <th>Bahan Bakar Memasak</th> 
                    <th>Jenis Lantai</th>
                    <th>Frekuensi Memakan Daging/Minggu</th>
                    <th>Kategori</th>";

            for ($i=0; $i < count($dataTabel); $i++) {
                $j=0;
                echo "<tr><td>".($i+1)."</td>".
                        "<td>".$dataTabel[$i][$j++]."</td>".
                        "<td>".$dataTabel[$i][$j++]."</td>".
                        "<td>".$dataTabel[$i][$j++]."</td>".
                        "<td>".$dataTabel[$i][$j++]."</td>".
                        "<td>".$dataTabel[$i][$j]."</td>".
                    "</tr>";
            };
            echo "</table>";
        }

        function resetData(){
            $filename = "data.txt";
            $fh = fopen($filename, 'w+') or die("can't open file");
            $stringData = "9,Kayu Bakar,Ubin,3,Sedang;10,Gas LPG,Ubin,2,Sedang;15,Gas LPG,Plester,2,Sedang;30,Gas LPG,Ubin,4,Kaya;16,Kompor Listrik,Ubin,3,Kaya;25,Gas LPG,Ubin,5,Kaya;9,Gas LPG,Plester,0.5,Miskin;8,Kayu Bakar,Tanah,1,Miskin;10,Kayu Bakar,Tanah,2,Miskin;14,Gas LPG,Tanah,1,Miskin";
            fwrite($fh, $stringData);
            fclose($fh);
            header("Refresh:0");
        }

        function getKategori($luasBangunan, $bahanBakar, $jenisLantai, $makanDaging){
            $posterionMiskin = hitungPosterion("Miskin", $luasBangunan, $bahanBakar, $jenisLantai, $makanDaging);
            $posterionSedang = hitungPosterion("Sedang", $luasBangunan, $bahanBakar, $jenisLantai, $makanDaging);
            $posterionKaya = hitungPosterion("Kaya", $luasBangunan, $bahanBakar, $jenisLantai, $makanDaging);

            if($posterionMiskin > $posterionSedang){
                if($posterionMiskin > $posterionKaya){
                    return 'Miskin';
                } else {
                    return 'Kaya';
                }
            }else {
                if($posterionSedang > $posterionKaya){
                    return 'Sedang';
                }else {
                    return 'Kaya';
                }
            }
        }

        function hitungLikelihood($item, $colomn, $kategori){
            $filename = "data.txt";
            $data = file_get_contents($filename);
            $dataTabel = explode(";", $data);
            
            for ($i=0; $i < count($dataTabel); $i++) { 
                $dataTabel[$i] = explode(",", $dataTabel[$i]);
            }

            $total = 0; //total disini maksudnya banyaknya nilai item yang bernilai sesuai dengan data
            $totalItem=0;
            for ($i=0; $i < count($dataTabel); $i++) {
                if($colomn==0 || $colomn==3){
                    $totalItem += $dataTabel[$i][$colomn];
                } 
                if(($item == $dataTabel[$i][$colomn]) && ($kategori == $dataTabel[$i][4])){
                    $total+=1;
                }
            }
            
            
            //hitung likelihood
            if($total == 0){
                if($colomn==0 || $colomn==3){
                    //hitung varian
                    //digunakan untuk menghitung likelihood data kontinyu
                    $rataItem = (Double)$totalItem/count($dataTabel);
                    $nilaiAtas = 0;
                    for ($i=0; $i < count($dataTabel); $i++) {
                        $nilaiAtas += (Double)pow((Double)($dataTabel[$i][$colomn]/$rataItem), 2);
                    }
                    $varian = (Double)$nilaiAtas/(count($dataTabel)-1);

                    return (Double)pow(exp(1), (-1*pow((Double)($item-$rataItem), 2))) / (Double)sqrt(2*pi()*$varian);
                }else{
                    return 0;
                }                
            }else{
                return (Double)$total/count($dataTabel);
            }
        }
        
        function hitungPrior($kategori){
            $filename = "data.txt";
            $data = file_get_contents($filename);
            $dataTabel = explode(";", $data);
            
            for ($i=0; $i < count($dataTabel); $i++) { 
                $dataTabel[$i] = explode(",", $dataTabel[$i]);
            }

            $banyakKategori = 0;
            for ($i=0; $i < count($dataTabel); $i++) { 
                if($kategori === $dataTabel[$i][4]){
                    $banyakKategori++;
                }
            }

            return (Double)$banyakKategori/count($dataTabel);
        }

        function hitungPosterion($kategori, $luasBangunan, $bahanBakar, $jenisLantai, $makanDaging){
            $prior = hitungPrior($kategori);
            $likelihoodLuasBangunan = hitungLikelihood($luasBangunan, 0, $kategori);
            $likelihoodBahanBakar = hitungLikelihood($bahanBakar, 1, $kategori);
            $likelihoodJenisLantai = hitungLikelihood($jenisLantai, 2, $kategori);
            $likelihoodMakanDaging = hitungLikelihood($makanDaging, 3, $kategori);

            return (Double)$likelihoodLuasBangunan*$likelihoodBahanBakar*$likelihoodJenisLantai*$likelihoodMakanDaging*$prior;
        }
    ?>
</body>
</html>