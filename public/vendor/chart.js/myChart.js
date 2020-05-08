var myChart;
format_curency = money => {
  money = money.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
  return money + " VNĐ";
};
 

function genId(url) {
  try {
    const regex = /(i.)+[0-9]+(.)+[0-9]/g;
    const str = url;
    let m;

    while ((m = regex.exec(str)) !== null) {
      // This is necessary to avoid infinite loops with zero-width matches
      if (m.index === regex.lastIndex) {
        regex.lastIndex++;
      }

      // The result can be accessed through the `m`-variable.
      var ids = m[0].split(".");
      ids[0] = "1";
      var temp = ids[1];
      ids[1] = ids[2];
      ids[2] = temp;
      var id = ids.join("__");
      return id;
    }
  } catch (err) {
    console.log(err);
    return "";
  }
}

$("#xemlichsu").click(function(e) {
  e.preventDefault();
  $("#chart").show();
  $("#isLoading").hide();
  var product = $("#xemlichsu").val();
  console.log(product);
  // var url = $("#url").val();
  // if (url && url !== "") {
  //   var id = genId(url);
  //   if (id == undefined || id === "") {
  //     $("#err").show();
  //     $("#err").text(
  //       "Chọn vào chi tiết sản phẩm trên shopee -> xong coppy Url nhé 🤔 "
  //     );
  //     $("#chartRender").hide();
  //     $("#isLoading").show();
  //   } else {
  //     $("#err").hide();
  //     getData(id);
  //   }
  // }
});


var getData = function(product) {  
  $("#chart").show();
  $.ajax({
    url: "/Shopee/Log/" + product,
    success: function(rp) {
      if (rp.status) { 
        $("#chartRender").show();
        $("#isLoading").hide();
        renderChart(rp.data, rp.labels);
      } else {
        $("#chartRender").hide();
        $("#isLoading").show();
        if (myChart) {
          myChart.destroy();
        }
      }
      // re-render the chart
    }
  });
};

function renderChart(data, labels) {
  if (myChart) {
    myChart.destroy();
  }
  var ctx = document.getElementById("myChart").getContext("2d");
  myChart = new Chart(ctx, {
    type: "line",
    data: {
      labels: labels,
      datasets: [
        {
          label: "Giá sản phẩm",
          data: data,
          borderColor: "rgba(75, 192, 192, 1)",
          backgroundColor: "rgba(75, 192, 192, 0.2)"
        }
      ]
    },
    options: {
      scales: {
        yAxes: [
          {
            ticks: {
              beginAtZero: true,
              callback: function(value, index, values) {
                return format_curency(value);
              }
            }
          }
        ],
        xAxes: [
          {
            ticks: {
              beginAtZero: true,
              callback: function(value, index, values) {
                return value;
              }
            }
          }
        ]
      }
    }
  });
}