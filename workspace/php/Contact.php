
<section>         
             <div class="row">
                <h1 class="text-primary"> Contact </h1>
                <div class="col-md-6">
                    <pre>
                    <strong>Primaria Municipiului Iasi</strong>
                    Bd. Stefan cel Mare si Sfant nr. 11, 700064 Iasi
                    tel: +40-232-267582; fax: +40-232-211200
                    Cont fiscal: 4541580
                    Banca: Trezoreria Iasi
                    
                    Centrul de Cartier Nicolina
                        Tel: +40-232-227517
                     
                    Centrul de Cartier Tatarasi
                        Tel: +40-232-277310 
                    
                    Centrul de Cartier Alexandru cel Bun
                        Tel:  +40-232-253160
                    
                    Centrul de Cartier Pacurari
                        Tel:  +40-232-276787
                     
                    Centru de Cartier Frumoasa
                         Tel: +40-0232-223 031
                    </pre>
                </div>
                 <div class="col-md-6">
                     <img src="img/pmi-contact.JPG" alt="Primaria Municipiului Iasi" class="img-responsive custom-map">
                     <div id="map"></div>
                    
                    <!-- map api-->
                        <script>
                              function initMap() {
                                var uluru = {lat: 47.161920, lng: 27.584165};
                                var map = new google.maps.Map(document.getElementById('map'), {
                                  zoom: 17,
                                  center: uluru
                                });
                                var marker = new google.maps.Marker({
                                  position: uluru,
                                  map: map
                                });
                              }
                            </script>
                            <script async defer
                            src="https://maps.googleapis.com/maps/api/js?key=replace_with_your_own_key&callback=initMap">
                        </script>

                     
                 </div>
            </div>
</section>