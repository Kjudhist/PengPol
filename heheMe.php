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
                
                            /* echo "<table border='1'>
                                    <th>No</th>
                                    <th>Luas Bangunan/Orang</th> 
                                    <th>Bahan Bakar Memasak</th> 
                                    <th>Jenis Lantai</th>
                                    <th>Frekuensi Memakan Daging/Minggu</th>
                                    <th>Kategori</th>"; */
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
            <div class= centered>
                <?php
                echo"<h2>K = Miskin</h2>
                <p>P = ( K = Miskin | L =  ,B =  ,JL =  ,M =  ) = P(L= |K=Miskin)*P(B= |K=Miskin)*P(JL= |K=Miskin)*P(M= |K=Miskin)*P(K=Miskin)</p>
                <h2>K = Sedang</h2>
                <p>P = ( K = Sedang | L =  ,B =  ,JL =  ,M =  ) = P(L= |K=Sedang)*P(B= |K=Sedang)*P(JL= |K=Sedang)*P(M= |K=Sedang)*P(K=Sedang)</p>
                <h2>K = Kaya</h2>
                <p>P = ( K = Kaya | L =  ,B =  ,JL =  ,M =  ) = P(L= |K=Kaya)*P(B= |K=Kaya)*P(JL= |K=Kaya)*P(M= |K=Kaya)*P(K=Kaya)</p>";
                ?>
              
            </div>
          </div>
    </body>
</html>