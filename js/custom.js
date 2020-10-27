
AOS.init();

$(document).ready(function() {
    $("#myslider").owlCarousel({
        items: 1,
        autoplay: true,
        autoplayTimeout: 3000,
        loop: true,
    });
});

function check()
{
    var err = document.getElementById('err');
    err.innerHTML;
    
    if (document.signupForm.firstname.value == "")
    {
        err.value = "Please Enter Firstname";
        document.signupForm.firstname.focus();
        return false;
    }

    if (document.signupForm.lastname.value == "")
    {
        alert("Please Enter Lastname");
        document.signupForm.lastname.focus();
        return false;
    }
    
    if (document.signupForm.email.value == "")
    {
        alert("Please Enter Email Address");
        document.signupForm.email.focus();
        return false;
    }
    e = document.signupForm.email.value;
    f1 = e.indexOf('@');
    f2 = e.indexOf('@', f1+1);
    e1 = e.indexOf('.');
    e2 = e.indexOf('.', e1+1);
    n = e.length;

    if (!(f1 > 0 && f2 == -1 && e1 > 0 && e2 == -1 &&  f1 != e1+1 && e1 != f1+1 && f1 != n-1 && e1 != n-1)) {
        alert("Please Enter valid Email");
        document.signupForm.email.focus();
        return false;
    }
    
    if (document.signupForm.type.value == "")
    {
        alert("Please Choose Account Type");
        document.signupForm.type.focus();
        return false;
    }

    if (document.signupForm.username.value == "")
    {
        alert("Please Enter Username");
        document.signupForm.username.focus();
        return false;
    }
    
    if (document.signupForm.password.value == "")
    {
        alert("Please Enter Password");
        document.signupForm.password.focus();
        return false;
    }
    
    if (document.signupForm.password.value.length < 6)
    {
        alert("Password must be at least 6 characters");
        document.signupForm.password.focus();
        return false;
    }

    return true;
}