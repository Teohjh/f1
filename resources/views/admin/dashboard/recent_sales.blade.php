
<script type="text/javascript">
    
    var recent_salest_labels =  {{ Js::from($recent_salest_labels) }};
    var recent_sales_data =  {{ Js::from($recent_sales_data) }};
    var recent_sales_colours =  {{ Js::from($recent_sales_colours) }};

    const recent_sales = {
      labels: recent_salest_labels,
      datasets: [{
        label: 'Recent Sales In This Last 7 days',
        backgroundColor: recent_sales_colours,
          borderColor: recent_sales_colours,
        data: recent_sales_data,
        //data: [0, 10, 5, 2, 20, 30, 45],
      }]
    };

    const recent_sales_config = {
      type: 'line',
      data: recent_sales,
      options: {}
    };

    const recentSales = new Chart(
      document.getElementById('recentSales'),
      recent_sales_config
    );

</script>