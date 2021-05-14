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

function dropOff(form)
{


}

function book(form)
{


}

