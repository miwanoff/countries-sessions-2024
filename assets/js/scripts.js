/*!
 * Start Bootstrap - Modern Business v5.0.7 (https://startbootstrap.com/template-overviews/modern-business)
 * Copyright 2013-2023 Start Bootstrap
 * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-modern-business/blob/master/LICENSE)
 */
// This file is intentionally blank
// Use this file to add JavaScript to your project

function verify(f) {
  if (f.login.value == "") {
    //alert("Input login!");
    document.getElementById("massage").innerHTML = "Input login!";
    return false;
  }
  let pass = f.pass.value;
  if (pass == "") {
    //alert("Input login!");
    document.getElementById("massage").innerHTML = "Input login!";
    return false;
  }
  let reg = /^\w{3,8}$/;
  if (!reg.test(pass)) {
    document.getElementById("massage").innerHTML = "Input correct password!";
    return false;
  }
  return true;
}
