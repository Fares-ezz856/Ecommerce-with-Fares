<div id="result-container"></div>
<script>
    document.addEventListener("DOMContentLoaded",function(){
      const resultcontainer = document.getElementById('result-container');
      const apiurl="http://127.0.0.1:8000/api/fares/getallproducts";
      fetch(apiurl)
      .then(response => response.json())


      .then(data =>{
                       console.log(data);
            if(Array.isArray(data.products)){
                 resultContainer.innerHTML = renderResult(data.products);
        }

    })
    .catch(error =>{
                        console.error("Error fetching data:",error);
                        resultContainer.innerHTML= "Error fetching data";
    });
});


</script>
