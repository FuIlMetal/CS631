function finalBill(form)
{


}

function stats(form)
{


}

function sale(form)
{
   //  This code will ping the server for getting information from the DB
  var ajax=new XMLHttpRequest();
  var name;
  ajax.onreadystatechange = function()
  {
    if(ajax.readyState == 4 && ajax.status == 200)
    {
      var response = JSON.parse(this.responseText);
      var status = response.status;
      document.getElementById("response").innerHTML = status;
    }
  }
 
  var fname = form.fname.value;
  var lname = form.lname.value;
  var email = form.email.value;
  var color = form.color.value;
  var make = form.make.value;
  var model = form.model.value;
  var year = form.year.value;
  var salePrice = form.salePrice.value;
  
  if(fname =="" || lname =="" || email =="" || color =="" || make =="" || model =="" || year =="" || salePrice =="")
  {
    alert("You Must Enter Values for Every Box");
  }
  else{
    ajax.open("POST", "https://web.njit.edu/~aa2296/631/sale.php", true);
    ajax.setRequestHeader("Content-type", "application/json");
    var userInfo = JSON.stringify({'fname': fname, 'lname': lname, 'email': email, 'color': color, 'make': make, 'model': model, 'year': year, 'salePrice': salePrice}); 
    ajax.send(userInfo);
  }
}

function drop(form)
{
   //  This code will ping the server for getting information from the DB
  var ajax=new XMLHttpRequest();
  var name;
  ajax.onreadystatechange = function()
  {
    if(ajax.readyState == 4 && ajax.status == 200)
    {
      var response = JSON.parse(this.responseText);
      var status = response.status;
      if(status == "Successful Update")
        document.getElementById("response").innerHTML = status+"<br>New Pickup Time: "+response.Pickup;
      else
        document.getElementById("response").innerHTML = status;
    }
  }
 
  var AID = form.AID.value;
  var dropOff = form.dropOff.value;
  
  if(AID =="" || dropOff =="" )
  {
    alert("You Must Enter Values for Every Box");
  }
  else{
    ajax.open("POST", "https://web.njit.edu/~aa2296/631/dropOff.php", true);
    ajax.setRequestHeader("Content-type", "application/json");
    var userInfo = JSON.stringify({'AID': AID, 'dropOff': dropOff}); 
    ajax.send(userInfo);
  }

}

function book(form)
{
   //  This code will ping the server for getting information from the DB
  var ajax=new XMLHttpRequest();
  var name;
  ajax.onreadystatechange = function()
  {
    if(ajax.readyState == 4 && ajax.status == 200)
    {
      var response = JSON.parse(this.responseText);
      var status = response.status;
      if(status == "Successful Appointment")
        document.getElementById("response").innerHTML = status+"<br>Appointment ID: "+response.AID+"<br>New Pickup Time: "+response.Pickup;
      else
        document.getElementById("response").innerHTML = status;
    }
  }
 
  var fname = form.fname.value;
  var lname = form.lname.value;
  var email = form.email.value;
  var color = form.color.value;
  var make = form.make.value;
  var model = form.model.value;
  var year = form.year.value;
  var dropOff = form.dropOff.value;
  
  if(fname =="" || lname =="" || email =="" || color =="" || make =="" || model =="" || year =="" || dropOff =="")
  {
    alert("You Must Enter Values for Every Box");
  }
  else{
    ajax.open("POST", "https://web.njit.edu/~aa2296/631/booking.php", true);
    ajax.setRequestHeader("Content-type", "application/json");
    var userInfo = JSON.stringify({'fname': fname, 'lname': lname, 'email': email, 'color': color, 'make': make, 'model': model, 'year': year, 'dropOff': dropOff}); 
    ajax.send(userInfo);
  }

}

