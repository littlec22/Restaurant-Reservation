<?php


    if(isset($_GET['p'])){
        
        if($_GET['p']=="Package 1"){
            ?>
                                <div class="form-group">
                                  <label for="sel1"  >Chicken:</label>
                                  <select class="form-control"  name="chickenPackage" >
                                    <option value = "chicken1"  >
                                       1</option>
                                    <option value = "chicken2">
                                        2</option>
                                    <option value=  "chicken3">
                                        3</option>
                                    <option value=  "chicken4">
                                        4</option>
                                    <option value=  "chicken5">
                                        6</option>

                                  </select>
                                </div>

                                <div class="form-group">
                                  <label for="sel1"  >Fish Fillet / Tahong:</label>
                                  <select class="form-control" name="fishPackage">
                                    <option value = "Fish Fillet"  >
                                       Fish Fillet</option>
                                    <option value = "Tahong">
                                        Tahong</option>

                                  </select>
                                </div>
                               <div class="form-group">
                                  <label for="sel1"  >Chopsuey / Pakbet:</label>
                                  <select class="form-control" name="vegetablePackage">
                                    <option value = "Chopsuey"  >
                                       Chopsuey</option>
                                    <option value = "Pakbet">
                                        Pakbet</option>

                                  </select>
                                </div>
                                <div class="form-group">
                                  <label for="sel1"  >Rice :</label>
                                  <select class="form-control" name="ricePackage">
                                    <option value = "Steamed Rice"  >
                                       Steamed Rice</option>
                                  </select>
                                </div>
                                <div class="form-group">
                                  <label for="sel1"  >Iced Tea:</label>
                                  <select class="form-control" name="icedteaPackage">
                                    <option value = "Iced Tea"  >
                                       Iced Tea</option>
                                  </select>
                                </div>
                              <div>
                                   <label for="sel1"  >Glass of lemon:</label>
                                  <select class="form-control" name="lemonPackage">
                                    <option value = "Glass of lemon"  >
                                       Glass of lemon</option>
                                  </select>
                                </div>
                                <div>
                                    <label for="sel1"  >Buko Pandan:</label>
                                      <select class="form-control" name="bukoPackage">
                                        <option value = "Buko Pandan"  >
                                           Buko Pandan</option>
                                      </select>
                                </div>
            <?php
        }else{
            ?>
                            <div class="form-group">
                              <label for="sel1"  >Pork:</label>
                              <select class="form-control" name="porkPackage">
                                <option value = "Pork1"  >
                                   1</option>
                                <option value = "Pork2">
                                    2</option>
                                <option value="Pork3">
                                    3</option>
                                <option value="Pork4">
                                    4</option>
                                <option value="Pork5">
                                    5</option>

                              </select>
                            </div>
                            <div class="form-group">
                                  <label for="sel1"  >Chicken:</label>
                                  <select class="form-control"  name="chickenPackage" >
                                    <option value = "chicken1"  >
                                       1</option>
                                    <option value = "chicken2">
                                        2</option>
                                    <option value=  "chicken3">
                                        3</option>
                                    <option value=  "chicken4">
                                        4</option>
                                    <option value=  "chicken5">
                                        6</option>

                                  </select>
                                </div>

                                <div class="form-group">
                                  <label for="sel1"  >Fish Fillet / Tahong:</label>
                                  <select class="form-control" name="fishPackage">
                                    <option value = "Fish Fillet"  >
                                       Fish Fillet</option>
                                    <option value = "Tahong">
                                        Tahong</option>

                                  </select>
                                </div>
                               <div class="form-group">
                                  <label for="sel1"  >Chopsuey / Pakbet:</label>
                                  <select class="form-control" name="vegetablePackage">
                                    <option value = "Chopsuey"  >
                                       Chopsuey</option>
                                    <option value = "Pakbet">
                                        Pakbet</option>

                                  </select>
                                </div>
                                <div class="form-group">
                                  <label for="sel1"  >Rice :</label>
                                  <select class="form-control" name="ricePackage">
                                    <option value = "Steamed Rice"  >
                                       Steamed Rice</option>
                                  </select>
                                </div>
                                <div class="form-group">
                                  <label for="sel1"  >Iced Tea:</label>
                                  <select class="form-control" name="icedteaPackage">
                                    <option value = "Iced Tea"  >
                                       Iced Tea</option>
                                  </select>
                                </div>
                              <div>
                                   <label for="sel1"  >Glass of lemon:</label>
                                  <select class="form-control" name="lemonPackage">
                                    <option value = "Glass of lemon"  >
                                       Glass of lemon</option>
                                  </select>
                                </div>
                                <div>
                                    <label for="sel1"  >Buko Pandan:</label>
                                      <select class="form-control" name="bukoPackage">
                                        <option value = "Buko Pandan"  >
                                           Buko Pandan</option>
                                      </select>
                                </div>
<?php
        }
    }
?>