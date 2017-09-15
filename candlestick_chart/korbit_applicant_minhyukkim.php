<!DOCTYPE html>
<html>

<!--Using papaparse.min.js-->
<script src="./papa_parse/PapaParse-master/papaparse.min.js"></script> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


<body>

<script>
  var data;

  function handleFileSelect(evt) {
    var file = evt.target.files[0];

    Papa.parse(file, {
	      header: true,
	      dynamicTyping: true,
	      complete: function(results) {
  

       		 //printing the data on console
       		 console.log("Finished:", results.data);
       		 //alert(results.data[4]['size']);


       		 /* Output (start)*/
       		 /* 
       		 	Information about Output 
				
				Output format : JSON Array


				The specific values in the JSON Array

				    open: string Price (in KRW) at the start of the period.

				    close: string Price (in KRW) at the end of the period.

				    high: string Highest price (in KRW) during the period.

				    low: string Lowest price (in KRW) during the period.

				    (completed) start: integer Start time (in UNIX timestamp) of the period.

				    (completed) end: integer End time (in UNIX timestamp) of the period. 

				    average: string Average price per trade (in KRW) during the period.

				    weighted_average: string Weighted average price (in KRW) during the period.

				    volume: string Total volume traded during the period (in BTC).

       		 */
     

		  	var output = { output_JSON: [] };   // initially empty



       	    /* Getting the total number of the JSON Array parsed from the selected file */
       		var totalNumOfParsedData = results.data.length;



		  	/* Getting the very first 'Timestamp' */
		  	var veryFirstStart = results.data[0]['timestamp'];




		  	/* Getting the very last 'Timestamp' */
		  	var veryFirstEnd = results.data[totalNumOfParsedData-1]['timestamp'];




		  	/* Getting the total number of band to be able to make devided by period (100s) */

		  	// Setting the period
		  	var period = 100;
		  	period = parseInt(period); //convert to int type

		  	/* Getting the subtracted value between veryFirstEnd and veryFirstStart */
		  	var subtractedValue = veryFirstEnd - veryFirstStart;

		  	/* Getting the total band number devided by period */
		  	var bandNumber = subtractedValue / period;
		  	var totalBandNumber = Math.ceil(bandNumber)
		  	alert(totalBandNumber);
		  	

	  		// Calculating the 'start' in a band
	  		var initial_Start_InBand = veryFirstStart;	// initializing with the very first start_InBand  	
	  		var current_Start_InBand = '';
	  		var current_End_InBand = '';
	  		var previous_End_InBand = '';
	  		var current_price = results.data[0]['price']; //initializing with the very first price
	  		var previous_price = ''; 
	  		var low_InBand = ''; //initializing with the very first price;


		  	/* Making the band set */
		  	var band = [];
		  	for (var j=0; j<=totalBandNumber-1; j++){


		  		// Getting the 'start', 'end' values in a band (beginning) --------------- Completed
		  		if(j==0){
		  			current_Start_InBand = initial_Start_InBand;
		  			//alert(current_Start_InBand);
		  		}else{
		  			current_Start_InBand = previous_End_InBand + 1;
		  		}		  	
		  		current_End_InBand = current_Start_InBand + (period-1);
		  		previous_End_InBand = current_End_InBand;
		  		// Getting the 'start' and 'end' values in a band (ending)

	

		  		/*Getting the'low' value in a band (beginning)	--------------- Incomplete
		  		if( j == 0){
		  			low_InBand = current_price;

		  		}
		  		if(j != 0){
		  			
		  			//previous_price = results.data[j-1]['price'];
			  		
			  		//previous_price = parseInt(previous_price);
			  		current_price = parseInt(current_price);	

		  			if(current_price < low_InBand){
		  				
			  			low_InBand = current_price;

			  		} 
			  		if(current_price >= low_InBand){

			  			low_InBand = low_InBand;
			  		}
		  				
			  				
		  		}
		  		


		  		......

				......

				......


				I am sorry, did not complete.



		  		// Getting the'low' value in a band (ending) */





		  		band[j] = 
		  			output.output_JSON.push( {
		  		    // adding 'start'	
			       "start" : current_Start_InBand + "_band_" + j, 	

			       //adding 'end'
			       "end" : current_End_InBand + "_band_" + j,	

			       //adding 'low'
			       "low" : low_InBand + "_band_" + j


			    }); 		
		  	}
		  	alert(band);

		  	

		  	var myJSON = JSON.stringify(output);

			alert(myJSON);













		  	// Getting the 'start' in the band 
		  	




























       		 //alert(output[0].end);


/*
       		 for (var i=0; i<=totalNumOfParsedData-1;  i++){

	       		 /* get the 'open' values */ 
	       		 /* get the 'close' values */
	       		 /* get the 'high' values */
	       		 /* get the 'low' values */
	       		 /* get the 'start' values */
/*
	       		
	       		// get the 'start' value to be used in Ouput JSON Array
	       		var start_parsed = results.data[i]['timestamp'];	

	       		// get the 'end' value to be used in Ouput JSON Array
	       		//var end_parsed = results.data[i]['timestamp'] + 100;
	       		var end_parsed = results.data[i]['timestamp'] + (100 * (i + 1) );
	     
   		 	    output.output_JSON.push( {
			       "start" : start_parsed, 	// get the 'start' value to be used in Ouput JSON Array
			       "end" : end_parsed		// get the 'end' value to be used in Ouput JSON Array
			    }); 
			    //alert(output.output_JSON[i].end);






















	       	




	       		 /* get the 'end' values*/
	       		 /* get the 'average' values*/
	       		 /* get the 'weighted_average' values*/
	       		 /* get the 'volume' values*/ 

       		//}

       		







       		 /* Making the Output JSON Array (end) */

       		 /* Output 값 구하기  (end)*/


 		 }
 	});	
  }

  $(document).ready(function(){
    $("#csv-file").change(handleFileSelect);
  });
</script>
<input type="file" id="csv-file" name="files"/>


</body>
</html>


