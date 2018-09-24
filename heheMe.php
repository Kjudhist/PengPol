<html lang="en">
    <head>
            <link rel="stylesheet" type="text/css" href="split.css">
    </head>
    <body>
        <div class="split1 left">
            <div class="center">
                    <?php showData();?>    
                    <form action="" method="POST">
                        <br><input type="submit" name="tambah" value="Tambah Data">
                        <input type="submit" name="resetData" value="Reset Data">
                    </form>
                
                    <?php
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
                        if(isset($_POST['tambahData'])){
                            $filename = "data.txt";
                            $fh = fopen($filename, 'a') or die("can't open file");
                            $kategori = getKategori($_POST['luasBangunan'], $_POST['bahanBakar'], $_POST['jenisLantai'], $_POST['makanDaging']);
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
                            echo '<table id="main-table" class="table exotic-table">
                                    <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Luas Bangunan/Orang</th>
                                        <th>Bahan Bakar Memasak</th>
                                        <th>Jenis Lantai</th>
                                        <th>Frekuensi Memakan Daging/Minggu</th>
                                        <th>Kategori</th>
                                    </tr>
                                    </thead>
                                    <tbody class="text-center">';
                
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
                            echo "</tbody>
                                    </table>";
                        }
                
                        function resetData(){
                            $filename = "data.txt";
                            $fh = fopen($filename, 'w+') or die("can't open file");
                            $stringData = "9,Kayu bakar,Ubin,3,Sedang;10,Gas LPG,Ubin,2,Sedang;15,Gas LPG,Plester,2,Sedang;30,Gas LPG,Ubin,4,Kaya;16,Kompor Listrik,Ubin,3,Kaya;25,Gas LPG,Ubin,5,Kaya;9,Gas LPG,Plester,0.5,Miskin;8,Kayu Bakar,Tanah,1,Miskin;10,Kayu Bakar,Tanah,2,Miskin;14,Gas LPG,Tanah,1,Miskin";
                            fwrite($fh, $stringData);
                            fclose($fh);
                            header("Refresh:0");
                        }
                
                        function getKategori($luasBangunan, $bahanBakar, $jenisLantai, $makanDaging){
                            $filename = "data.txt";
                            $data = file_get_contents($filename);
                            $dataTabel = explode(";", $data);
                            
                            for ($i=0; $i < count($dataTabel); $i++) { 
                                $dataTabel[$i] = explode(",", $dataTabel[$i]);
                            }
                
                            $likelihoodLuasBangunan=0;
                            $likelihoodBahanBakar=0;
                            $likelihoodJenisLantai=0;
                            $likelihoodMakanDaging=0;
                
                            for ($i=0; $i < count($dataTabel[0]); $i++) { 
                                if($luasBangunan === $dataTabel[0][$i]){
                                    $likelihoodLuasBangunan++;
                                }
                                if($bahanBakar === $dataTabel[1][$i]){
                                    $likelihoodBahanBakar++;
                                }
                                if($jenisLantai === $dataTabel[2][$i]){
                                    $likelihoodJenisLantai++;
                                }
                                if($luasBangunan === $dataTabel[3][$i]){
                                    $likelihoodMakanDaging++;
                                }
                            }
                
                            if($likelihoodLuasBangunan === 0){
                                
                            }
                        }
                    ?>
            </div>
          </div>
          <div class="split2 right">
            <div class= centered >
                <?php
                $filename2 = "data.txt";
                $data2 = file_get_contents($filename2);
    
                $dataTabel2 = explode(";", $data2);
                for ($i=0; $i < count($dataTabel2); $i++) { 
                    $dataTabel2[$i] = explode(",", $dataTabel2[$i]);
                }
                if(count($dataTabel2) > 10){
                $ab = count($dataTabel2)-1;
                echo"<h2>K = Miskin</h2>
                <p>P = ( K = Miskin | L = ".$dataTabel2[$ab][0]." ,B = ".$dataTabel2[$ab][1]." ,JL = ".$dataTabel2[$ab][2]." ,M = ".$dataTabel2[$ab][3]." ) = P( L = ".$dataTabel2[$ab][0]." | K=Miskin )*P( B = ".$dataTabel2[$ab][1]." |K= Miskin )*P( JL = ".$dataTabel2[$ab][2]." |K= Miskin )*P(M = ".$dataTabel2[$ab][3]." |K= Miskin )*P(K= Miskin )</p>
                <h2>K = Sedang</h2>
                <p>P = ( K = Sedang | L = ".$dataTabel2[$ab][0]." ,B = ".$dataTabel2[$ab][1]." ,JL = ".$dataTabel2[$ab][2]." ,M = ".$dataTabel2[$ab][3]." ) = P( L = ".$dataTabel2[$ab][0]." | K=Sedang )*P( B = ".$dataTabel2[$ab][1]." |K= Sedang )*P( JL = ".$dataTabel2[$ab][2]." |K= Sedang )*P(M = ".$dataTabel2[$ab][3]." |K= Sedang )*P(K= Sedang )</p>
                <h2>K = Kaya</h2>
                <p>P = ( K = Kaya | L = ".$dataTabel2[$ab][0]." ,B = ".$dataTabel2[$ab][1]." ,JL = ".$dataTabel2[$ab][2]." ,M = ".$dataTabel2[$ab][3]." ) = P( L = ".$dataTabel2[$ab][0]." | K=Kaya )*P( B = ".$dataTabel2[$ab][1]." |K= Kaya )*P( JL = ".$dataTabel2[$ab][2]." |K= Kaya )*P(M = ".$dataTabel2[$ab][3]." |K= Kaya )*P(K= Kaya )</p>";
                }

                ?>
            </div>
          </div>
    </body>
</html>