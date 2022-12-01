
<script type="text/javascript">
  
    var top_member_labels =  {{ Js::from($top_member_labels) }};
    var top_member_data =  {{ Js::from($top_member_data) }};
    var sales_orders_colours =  {{ Js::from($sales_orders_colours) }};

    const top_member = {
      labels: top_member_labels,
      datasets: [{
        label: 'Top 5 Member In This Month',
        backgroundColor: sales_orders_colours,
          borderColor: sales_orders_colours,
        data: top_member_data,
        //data: [0, 10, 5, 2, 20, 30, 45],
      }]
    };

    const top_member_config = {
      type: 'bar',
      data: top_member,
      options: {}
    };

    const topMember = new Chart(
      document.getElementById('topMember'),
      top_member_config
    );

</script>