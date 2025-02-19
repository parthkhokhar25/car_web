function btnc_click() {
    var name = document.getElementById('t1').value;
    var email = document.getElementById('t2').value;
    var msg = document.getElementById('t3').value;
    //name validation
    if (name == "") {
        var vnm = "false";
        var x = "Name cannot be empty";
        document.getElementById('p1').innerHTML = x;
        document.getElementById('p1').style.color = "red";
        document.getElementById('t1').style.borderColor = "red";
    }
    else {
        var b = /^[a-zA-Z]{2,30}$/;
        var a = b.test(name);
        if (a == false) {
            var vnm = "false";
            var x = "Please Enter Your name like (John)";
            document.getElementById('p1').innerHTML = x;
            document.getElementById('p1').style.color = "red";
            document.getElementById('t1').style.borderColor = "red";
        }
        else {
            vnm = "true";
            var x = "";
            document.getElementById("p1").innerHTML = x;
            document.getElementById("t1").style.borderColor = "green";
        }
    }
    //email validation
    if (email == "") {
        var vem = "false";
        var x = "Email cannot be empty";
        document.getElementById('p2').innerHTML = x;
        document.getElementById('p2').style.color = "red";
        document.getElementById('t2').style.borderColor = "red";
    }
    else {
        var b = /^[a-z0-9]+@[a-z]+\.[a-z]+$/;
        var a = b.test(email);
        if (a == false) {
            var vem = "false";
            var x = "Please Enter Valid Email";
            document.getElementById('p2').innerHTML = x;
            document.getElementById('p2').style.color = "red";
            document.getElementById('t2').style.borderColor = "red";
        }
        else {
            vem = "true";
            var x = "";
            document.getElementById('p2').innerHTML = x;
            document.getElementById('t2').style.borderColor = "green";
        }
    }
    //massage validation
    if (msg == "") {
        var vmsg = "false";
        var x = "Massage cannot be empty";
        document.getElementById('p3').innerHTML = x;
        document.getElementById('p3').style.color = "red";
        document.getElementById('t3').style.borderColor = "red";
    }
    else {
        var b = /^[a-zA-Z\s]{20,500}$/;
        var a = b.test(msg);
        if (a == false) {
            var vmsg = "false";
            var x = "Please Enter minimum 20 or less than 500 letter.";
            document.getElementById('p3').innerHTML = x;
            document.getElementById('p3').style.color = "red";
            document.getElementById('t3').style.borderColor = "red";
        }
        else {
            vmsg = "true";
            var x = "";
            document.getElementById('p3').innerHTML = x;
            document.getElementById('t3').style.borderColor = "green";
        }
    }
    if (vnm == "true" && vem == "true" && vmsg == "true") {
        return true;
    }
    else {
        return false;
    }
}