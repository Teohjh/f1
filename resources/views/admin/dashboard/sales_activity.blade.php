
<script type="text/javascript">
    
    var sales_activity_labels =  {{ Js::from($sales_activity_labels) }};
    var sales_activity_data =  {{ Js::from($sales_activity_data) }};
    var sales_activity_colours =  {{ Js::from($sales_activity_colours) }};

    const sales_activity = {
      labels: sales_activity_labels,
      datasets: [{
        label: 'Sales Activity',
        backgroundColor: sales_activity_colours,
          borderColor: sales_activity_colours,
        data: sales_activity_data,
        //data: [0, 10, 5, 2, 20, 30, 45],
      }]
    };

    const sales_activity_config = {
      type: 'bar',
      data: sales_activity,
      options: {}
    };

    const salesActivity = new Chart(
      document.getElementById('salesActivity'),
      sales_activity_config
    );

</script>