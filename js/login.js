/* #####################################################################
   #
   #   Project       : Modal Login with jQuery Effects
   #   Author        : Rodrigo Amarante (rodrigockamarante)
   #   Version       : 1.0
   #   Created       : 07/29/2015
   #   Last Change   : 08/04/2015
   #
   ##################################################################### */
   
$(function() {
    
    var $formLogin = $('#login-form');
    var $formLost = $('#lost-form');
    var $formRegister = $('#register-form');
    var $divForms = $('#div-forms');
    var $modalAnimateTime = 300;
    var $msgAnimateTime = 150;
    var $msgShowTime = 2000;

    $("form").submit(function () {
        switch(this.id) {
            case "login-form":
                var data = {"login_email": $("#login_email").val(),
                            "login_password": $("#login_password").val()};

                $("#login_password").val("");

                $.post('server.php', data, function(resp){
                    resp = $.parseJSON(resp);
                    if (resp.status == "error") {
                        msgChange($('#div-login-msg'), $('#icon-login-msg'), $('#text-login-msg'), "error", "glyphicon-remove", "Login error");
                    } else {
                        msgChange($('#div-login-msg'), $('#icon-login-msg'), $('#text-login-msg'), "success", "glyphicon-ok", "Login OK");
                        window.location = "dashboard.php";
                    }
                });
                
                return false;
                break;
            case "lost-form":
                var $ls_email=$('#lost_email').val();
                if ($ls_email == "ERROR") {
                    msgChange($('#div-lost-msg'), $('#icon-lost-msg'), $('#text-lost-msg'), "error", "glyphicon-remove", "Send error");
                } else {
                    msgChange($('#div-lost-msg'), $('#icon-lost-msg'), $('#text-lost-msg'), "success", "glyphicon-ok", "Send OK");
                }
                return false;
                break;
            case "register-form":
                var $rg_email=$('#register_email').val();
                var $rg_password=$('#register_password').val();
                var data = {"register_password": $rg_password,
                            "register_email": $rg_email};

                $.post('server.php', data, function(resp){
                    resp = $.parseJSON(resp);


                    if (resp.status == "error") {
                    msgChange($('#div-register-msg'), $('#icon-register-msg'), $('#text-register-msg'), "error", "glyphicon-remove", "Register error");
                    } else {
                        msgChange($('#div-register-msg'), $('#icon-register-msg'), $('#text-register-msg'), "success", "glyphicon-ok", "Register OK");
                        window.location = "dashboard.php";
                    }
                });

                
                return false;
                break;
            default:
                return false;
        }
        return false;
    });
    
    $('#login_register_btn').click( function () { modalAnimate($formLogin, $formRegister) });
    $('#register_login_btn').click( function () { modalAnimate($formRegister, $formLogin); });
    $('#login_lost_btn').click( function () { modalAnimate($formLogin, $formLost); });
    $('#lost_login_btn').click( function () { modalAnimate($formLost, $formLogin); });
    $('#lost_register_btn').click( function () { modalAnimate($formLost, $formRegister); });
    $('#register_lost_btn').click( function () { modalAnimate($formRegister, $formLost); });
    
    function modalAnimate ($oldForm, $newForm) {
        var $oldH = $oldForm.height();
        var $newH = $newForm.height();
        $divForms.css("height",$oldH);
        $oldForm.fadeToggle($modalAnimateTime, function(){
            $divForms.animate({height: $newH}, $modalAnimateTime, function(){
                $newForm.fadeToggle($modalAnimateTime);
            });
        });
    }
    
    function msgFade ($msgId, $msgText) {
        $msgId.fadeOut($msgAnimateTime, function() {
            $(this).text($msgText).fadeIn($msgAnimateTime);
        });
    }
    
    function msgChange($divTag, $iconTag, $textTag, $divClass, $iconClass, $msgText) {
        var $msgOld = $divTag.text();
        msgFade($textTag, $msgText);
        $divTag.addClass($divClass);
        $iconTag.removeClass("glyphicon-chevron-right");
        $iconTag.addClass($iconClass + " " + $divClass);
        setTimeout(function() {
            msgFade($textTag, $msgOld);
            $divTag.removeClass($divClass);
            $iconTag.addClass("glyphicon-chevron-right");
            $iconTag.removeClass($iconClass + " " + $divClass);
      }, $msgShowTime);
    }

    $("#new_challenge").submit(function() {
        var challenge_id = $(".item.active").attr("id"),
            challenge_money = $("#challenge_money").val(),
            challenge_email = $("#challenge_email").val(),
            challenge_cause = $("#challenge_cause").val(),
            d = new Date(),
            data = {"challenge_id": challenge_id,
                    "challenge_money": challenge_money,
                    "challenge_email": challenge_email,
                    "challenge_cause": challenge_cause
                    };
        $("#challenge_success").html("Wainting for challenge to be sent..");
        $.post("server.php", data, function (resp) {
            $("#challenge_success").html("");
            resp = $.parseJSON(resp);
            if(resp.status == "error")
            {
                $("#challenge_error").html("Challenge sending failed. Please try again.");
            }
            else
            {
                var challenge_id = resp.data.challenge_id,
                    challenge_name = resp.data.challenge_name,
                    cause_desc = resp.data.cause_description,
                    challenge_desc = resp.data.challenge_description,
                    challenge_date = d.getDate() + '-' + d.getMonth() + '-' + d.getFullYear(),
                    challenge = $(document.createElement("DIV")),
                    ch_title = $(document.createElement("DIV")),
                    ch_body = $(document.createElement("DIV")),
                    h3 = $(document.createElement("H3")),
                    dte = $(document.createElement("P")),
                    aa = $(document.createElement("A")),
                    span = $(document.createElement("SPAN")),
                    footer = $(document.createElement("DIV"));

                challenge.addClass("card");
                challenge.attr("id", challenge_id);
                ch_title.addClass("card-title");
                ch_body.addClass("card-body");
                h3.html(challenge_name);
                dte.html(challenge_date);
                aa.attr("name", challenge_id);
                span.html("Sent to: " + challenge_email);
                span.addClass("pull-right");
                footer.addClass("card-footer");
                footer.html("If completed, I have to donate &pound;" + challenge_money + " for " + cause_desc);

                h3.append(span);
                ch_title.append(h3);
                ch_title.append(aa);
                ch_title.append(dte);
                challenge.append(ch_title);
                ch_body.html(challenge_desc);
                challenge.append(ch_body);
                challenge.append(footer);

                $("#the_list_active").append(challenge);
                $(".no-challenges").remove();
                window.location = "#" + challenge_id;
            }
        });
    });
    
    
   


    // $('#challenge_cause').searchbox({
    //   url: 'server.php',
    //   param: 'q',
    //   dom_id: '#results',
    //   delay: 250,
    //   loading_css: '#spinner'
    // })
    $("#challenge_cause").select2({
      placeholder: "Select a cause"
    });

});


function getRandomInt(min, max) {
      return Math.floor(Math.random() * (max - min)) + min;
    }


 function modalFillSHIT(challenge) {
        challenge = $.parseJSON(challenge);

        reference = getRandomInt(10000000, 99999999);

        var url = "http://v3-sandbox.justgiving.com/4w350m3/donation/direct/charity/" + challenge.CauseId + "/" + "?amount=" + challenge.Amount + "&exitUrl=" + "http%3A%2F%2Flocalhost%2Fprojects%2Fguh%2Fsuccess.php%3FjgDonationId%3DJUSTGIVING-DONATION-ID%26dareId%3D" + challenge.DareId + "&currency=GBP" + "&reference=" + reference + "&defaultMessage=Message&utm_source=sdidirect&utm_medium=buttons&utm_campaign=buttontype";

        $("#donate_button").attr("href", url);
        $("#modal_money").html(challenge.Amount);
        $("#modal_cause_name").html(challenge.CauseName);
    }

    function shit() {
        $.post('server.php', {'link': $('#challenge_proof').val(), 'dare_id': $('#modal_proof_dare_id').val()}, function (resp){
                resp = $.parseJSON(resp);

                if(!resp || resp.status == "error")
                {
                    $('#modal_proof_error').html('Something wrong happened. Please try again.');
                }
                else 
                {
                    window.location.reload();
                }
            }
        );
    }