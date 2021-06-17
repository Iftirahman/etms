function checkpass() {
                if(document.changepassword.newpassword.value!=document.changepassword.confirmpassword.value) {
                    alert('Confirm Password field does not match to New Password!');
                    document.changepassword.confirmpassword.focus();
                    return false;
                }else {
                    return true;
                }
            }