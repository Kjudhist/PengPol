# PengPol
delete soon

if(isset($_POST['tambahData'])){
                    $filename2 = "data.txt";
                    $data2 = file_get_contents($filename2);
        
                    $dataTabel2 = explode(";", $data2);
                    for ($i=0; $i < count($dataTabel2); $i++) { 
                        $dataTabel2[$i] = explode(",", $dataTabel2[$i]);
                    }
                    $ab = count($dataTabel2)-1;

                    echo"<h2>K = Miskin</h2>
                    <p>P = ( K = Miskin | L = ".$dataTabel2[$ab][0]." ,B = ".$dataTabel2[$ab][1]." ,JL = ".$dataTabel2[$ab][2]." ,M = ".$dataTabel2[$ab][3]." ) = P( L = ".$dataTabel2[$ab][0]." | K=Miskin )*P( B = ".$dataTabel2[$ab][1]." |K= Miskin )*P( JL = ".$dataTabel2[$ab][2]." |K= Miskin )*P(M = ".$dataTabel2[$ab][3]." |K= Miskin )*P(K= Miskin )</p>
                    <h2>K = Sedang</h2>
                    <p>P = ( K = Sedang | L = ".$dataTabel2[$ab][0]." ,B = ".$dataTabel2[$ab][1]." ,JL = ".$dataTabel2[$ab][2]." ,M = ".$dataTabel2[$ab][3]." ) = P( L = ".$dataTabel2[$ab][0]." | K=Sedang )*P( B = ".$dataTabel2[$ab][1]." |K= Sedang )*P( JL = ".$dataTabel2[$ab][2]." |K= Sedang )*P(M = ".$dataTabel2[$ab][3]." |K= Sedang )*P(K= Sedang )</p>
                    <h2>K = Kaya</h2>
                    <p>P = ( K = Kaya | L = ".$dataTabel2[$ab][0]." ,B = ".$dataTabel2[$ab][1]." ,JL = ".$dataTabel2[$ab][2]." ,M = ".$dataTabel2[$ab][3]." ) = P( L = ".$dataTabel2[$ab][0]." | K=Kaya )*P( B = ".$dataTabel2[$ab][1]." |K= Kaya )*P( JL = ".$dataTabel2[$ab][2]." |K= Kaya )*P(M = ".$dataTabel2[$ab][3]." |K= Kaya )*P(K= Kaya )</p>";
                }