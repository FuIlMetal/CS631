function finalBill(form)
{
  var ajax=new XMLHttpRequest();
  var name;
  ajax.onreadystatechange = function()
  {
    if(ajax.readyState == 4 && ajax.status == 200)
    {
      var response = JSON.parse(this.responseText);
    
        var info = document.getElementById("response");
        info.innerHTML = "First Name: " + response["FirstName"];
        info.innerHTML += "<br>Last Name: " + response["LastName"];
        
        //table for all the parts
        var table = document.getElementById("Ptable");
        var row;
        var cellA;
        var cellB;
      
       
        row = table.insertRow(-1);
        
        cellA = document.createElement("th");
        cellA.innerHTML = "Part Name";
        cellB = document.createElement("th");
        cellB.innerHTML = "Cost";
        
        
        row.appendChild(cellA);
        row.appendChild(cellB);
       
        
        
        for (var i=0; i<response["Parts"].length; i++) {
          // (C2) ROWS & CELLS
          row = table.insertRow(-1);
          
          cellA = document.createElement("td");
          cellB = document.createElement("td");
          
          // (C3) KEY & VALUE
          cellA.innerHTML = response["Parts"][i]["Name"];
          cellB.innerHTML = response["Parts"][i]["Cost"];
      
          row.appendChild(cellA);
          row.appendChild(cellB);
        }
        
        //table for all the tests
        var table = document.getElementById("Ttable");
        var row;
        var cellA;
        var cellB;
      
       
        row = table.insertRow(-1);
        
        cellA = document.createElement("th");
        cellA.innerHTML = "Test Name";
        cellB = document.createElement("th");
        cellB.innerHTML = "Cost";
        
        
        row.appendChild(cellA);
        row.appendChild(cellB);
       
        
        
        for (var i=0; i<response["Tasks"].length; i++) {
          // (C2) ROWS & CELLS
          row = table.insertRow(-1);
          
          cellA = document.createElement("td");
          cellB = document.createElement("td");
          
          // (C3) KEY & VALUE
          cellA.innerHTML = response["Tasks"][i]["Name"];
          cellB.innerHTML = response["Tasks"][i]["Cost"];
      
          row.appendChild(cellA);
          row.appendChild(cellB);
        }
        
        info = document.getElementById("Total");
        info.innerHTML = "Total Parts Cost: " + response["PartsCost"];
        info.innerHTML += "<br>Total Tests Cost: " + response["TestCost"];
        info.innerHTML += "<br>Total Cost: " + response["TotalCost"];
    }
  }
 
  var AID = form.AID.value;

  if(AID =="" )
  {
    alert("You Must Enter Values for AID");
  }
  else{
    ajax.open("POST", "https://web.njit.edu/~aa2296/631/finalBill.php", true);
    ajax.setRequestHeader("Content-type", "application/json");
    var userInfo = JSON.stringify({'AID': AID}); 
    
    ajax.send(userInfo);
  }

}

function stats(form)
{
  var ajax=new XMLHttpRequest();
  var name;
  ajax.onreadystatechange = function()
  {
    if(ajax.readyState == 4 && ajax.status == 200)
    {
      var response = JSON.parse(this.responseText);
      var status = response[0].status;
      if(status == "Successful Select")
      {
        var table = document.getElementById("table");
        var row;
        var cellA;
        var cellB;
        var cellC;
        var cellD;
        var cellE;
        var CellF;
       
        row = table.insertRow(-1);
        
        cellA = document.createElement("th");
        cellA.innerHTML = "Make";
        cellB = document.createElement("th");
        cellB.innerHTML = "Model";
        cellC = document.createElement("th");
        cellC.innerHTML = "Year";
        cellD = document.createElement("th");
        cellD.innerHTML = "Purchase Year";
        cellE = document.createElement("th");
        cellE.innerHTML = "Count";
        cellF = document.createElement("th");
        cellF.innerHTML = "Profit";
        
        row.appendChild(cellA);
        row.appendChild(cellB);
        row.appendChild(cellC);
        row.appendChild(cellD);
        row.appendChild(cellE);
        row.appendChild(cellF);
        
        
        for (var i=1; i<response.length; i++) {
          // (C2) ROWS & CELLS
          row = table.insertRow(-1);
          
          cellA = document.createElement("td");
          cellB = document.createElement("td");
          cellC = document.createElement("td");
          cellD = document.createElement("td");
          cellE = document.createElement("td");
          cellF = document.createElement("td");
          
          // (C3) KEY & VALUE
          cellA.innerHTML = response[i]["Make"];
          cellB.innerHTML = response[i]["Model"];
          cellC.innerHTML = response[i]["Year"];
          cellD.innerHTML = response[i]["DateOfPurchase"];
          cellE.innerHTML = response[i]["Count"];
          cellF.innerHTML = response[i]["Profit"];
          
          row.appendChild(cellA);
          row.appendChild(cellB);
          row.appendChild(cellC);
          row.appendChild(cellD);
          row.appendChild(cellE);
          row.appendChild(cellF);
        
        }
        
      }
      else
        document.getElementById("response").innerHTML = status;
    }
  }
 
  var startDate = form.startDate.value;
  var endDate = form.endDate.value;
  
  if(startDate =="" || endDate =="" )
  {
    alert("You Must Enter Values for Every Box");
  }
  else{
    ajax.open("POST", "https://web.njit.edu/~aa2296/631/stats.php", true);
    ajax.setRequestHeader("Content-type", "application/json");
    var userInfo = JSON.stringify({'startDate': startDate, 'endDate': endDate}); 
    
    ajax.send(userInfo);
  }


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

