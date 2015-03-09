<?php include "../includes/header.php"; ?>
    <div id="global">
        <div id="tchat">
            <div class="container">
                    <h3 class="title">Chat</h3>
                    <div id="box-tchat">
                        <div id="box-tchat-corps"></div>
                        <div id="box-tchat-speak"><input type="text" placeholder="Votre message..."/></div>
                        <script>
                            $("#box-tchat-speak").ready(function(){
                                chatTable = new Array();
                            })

                            $("#box-tchat-speak").keyup(function(event){
                                if(event.keyCode == 13){
                                    if( $('#box-tchat-speak input').val() != ""){
                                        var d = new Date();
                                        var hours = d.getHours();
                                        var minutes = d.getMinutes();
                                        if(hours.toString().length < 2){
                                            hours = "0" + hours.toString();
                                        }
                                        if(minutes.toString().length < 2){
                                            minutes = "0" + minutes.toString();
                                        }
                                        var html = "<span class='datemessage moi' style='background-color: transparent;'>" + hours + ":" + minutes + "</span><span class='tchatmessage moi'>" + $('#box-tchat-speak input').val() + "</span><br>";
                                        //var html = "<span class='authormessage moi'>Kestrel</span><span class='tchatmessage moi'>" + $('#box-tchat-speak input').val() + "</span><br>";
                                        $('#box-tchat-corps').append(html);
                                        chatTable.push(html);
                                        $('#box-tchat-speak input').val("");
                                    }
                                }
                            });
                        </script>
                    </div>
            </div>
        </div>
        <div id="corpus">
            <div class="container">
                <div class="row">
                    <div id="listecours" class="col-md-8">
                        <h3 class="title">Cours</h3>
                        <?php
                            $nbrresultcours = -1;
                            $coursliste = $cours->listAllCours($nbrresultcours);
                            foreach ($coursliste as $coursvignette) {
                                echo '<div class="col-md-4">';
                                echo '<a href="#"><figure class="figurecours'.$coursvignette["id"].'">';
                                echo '<div class="backgroundcours'.$coursvignette["id"].' backgroundcours" style="background: url(\'' . $coursvignette["vignette"] . '\'); background-size: cover; -webkit-background-size: cover; background-position-x: 0%;"></div>';
                                echo '<figcaption></figcaption>';
                                echo '</figure></a>';
                                echo '</div>';
                        ?>
                        <script type="text/javascript">
                            $(".figurecours<?php echo $coursvignette["id"];?>").hover(function(){
                                $(".figurecours<?php echo $coursvignette["id"];?> figcaption").addClass("active");
                                $(".backgroundcours<?php echo $coursvignette["id"];?>").addClass("active");
                                $(".backgroundcours<?php echo $coursvignette["id"];?>").css("background-position-x", "100%");
                                $(".figurecours<?php echo $coursvignette["id"];?> figcaption").html("<?php echo $coursvignette["nom"]; ?>");
                            },function(){
                                $(".figurecours<?php echo $coursvignette["id"];?> figcaption").removeClass("active");
                                $(".backgroundcours<?php echo $coursvignette["id"];?>").removeClass("active");
                                $(".backgroundcours<?php echo $coursvignette["id"];?>").css("background-position-x", "0%");
                                $(".figurecours<?php echo $coursvignette["id"];?> figcaption").html("");
                            });
                        </script>
                        <?php
                            }
                        ?>
                    </div>
                    <div class="col-md-1"><div class="spacer"></div></div>
                    <div id="infodroiteaccueil" class="col-md-3">
                        <h3 class="title">Informations</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include "../includes/footer.php"; ?>
