
<script type="text/javascript">
    
    var sell_product_labels =  {{ Js::from($sell_product_labels) }};
    var sell_product_data =  {{ Js::from($sell_product_data) }};
    var sell_product_colours =  {{ Js::from($sell_product_colours) }};

    const top_sales_product = {
      labels: sell_product_labels,
      datasets: [{
        label: 'Top 5 Selling Product In This Month',
        backgroundColor: sell_product_colours,
          borderColor: sell_product_colours,
        data: sell_product_data,
        //data: [0, 10, 5, 2, 20, 30, 45],
      }]
    };

    const top_sales_product_config = {
      type: 'pie',
      data: top_sales_product,
      options: {
        responsive: false,
      }
    };

    const topSalesProduct = new Chart(
      document.getElementById('topSalesProduct'),
      top_sales_product_config
    );

</script>