<!DOCTYPE html>
<html lang="es">
<head>
<title>ajaxreload</title>
<style>
</style>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="bootstrap/4.6.0/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Bootstrap CSS fin -->


    <!-- Optional JavaScript -->
    <script src="bootstrap/4.6.0/dist/js/jquery-3.5.1.js" type="text/javascript"></script>
    <script src="bootstrap/4.6.0/dist/js/popper.min.js" type="text/javascript"></script>
    <script src="bootstrap/4.6.0/dist/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- Optional JavaScript -->

</head>
<body>
<div class="container">
    <center>
        <h1>CONSULTAR FABRICANTE</h1>
    </center>
    <br>

    <div class="form-group">
        <label for="exampleFormControlTextarea1">MAC separarar las macs con (|)</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        <br>
        <button type="button" class="btn btn-primary" onclick="sendRequest();$('#resultsTable tbody').empty();">Consultar</button>
    </div>  
    <br><div id="results"></div><br>
    <table id="resultsTable" name="resultsTable" class="table table-striped table-sm text-align-center table-hover" style="TEXT-ALIGN: center;">
    <thead>
        <tr>
            <th>MAC</th>
            <th>Vendors</th>
        </tr>
    </thead>
    <tbody></tbody>
    </table>
</div>    
</body>

<script>

var indActual = 0;
function sendRequest() {

    var text = $("#exampleFormControlTextarea1").val();
    // console.log(text);
    const myArray = text.split("|");
    
    // console.log(myArray);

    indActual = indActual + 1;
    // console.log(myArray.length);


    var total = myArray.length;

	$.each(myArray, function(index, value) {
        index = index++;
        if(indActual === total){
            console.log(indActual);
            console.log(total);
            
            petition(value);
            $("#results").append("<center>Termino</center>");
            
            console.log(value);
            console.log('Termino..');
            indActual = 0;
            return false;
        }else if(index == indActual){
            console.log(indActual);
            console.log(total);

            setTimeout(function(){
                sendRequest();
            }, 10000);            
            petition(value);

            console.log(value);
            console.log('Sigue..');
            return false;
        }
        
	});
    
}// end function

petition = function(mac){   
        var data1 = {
            "mac": mac
        };
        
        $.ajax({
				type: "POST",
				url: "ajax/count.php",
				data: data1,
                dataType: "json",
				success: function(json) {
                    console.log(json);
					// $('#results').text(json);
                    // $("#results").append("<br>MAC:"+json.mac+" "+"Vendors:"+json.response);

                Html = "";
                // $("#resultsTable tbody").empty();
                Html += "<tr>";
                Html += "	<td>";
                Html += json.mac;
                Html += "	</td>";
                Html += "	<td>";
                Html += json.response;
                Html += "	</td>";                    
                Html += "<tr>";
                $("#resultsTable tbody").append(Html);                
            },
            error: function(xhr, status, errorThrown) {
					//Here the status code can be retrieved like;
					console.log('xhr.status');
					xhr.status;
					console.log('xhr.status');
                    
					console.log('status');
					console.log(status);
					console.log('status');
                    
					//The message added to Response object in Controller can be retrieved as following.
					console.log('xhr.responseText');
					xhr.responseText;
					console.log('xhr.responseText');
				}
                /*,complete: function() {
                    // solo una vez que la petición se completa (success o no success)
                    // pedimos una nueva petición en 3 segundos 
                setTimeout(function(){
                    sendRequest();
                }, 3000);
                }*/
			});
            
}

/* primera petición que echa a andar la maquinaria */
// $(function() {
    // sendRequest();
    // });
    
</script>
</html>
