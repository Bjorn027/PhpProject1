var up = true;
var value1 = 99;
var increment = 1;
var ceiling = 100;

function PerformCalc() {
  if (up == true && value1 <= ceiling) {
    value1 += increment

    if (value1 == ceiling) {
      up = false;
    }
  } 
}

setInterval(PerformCalc, 1000);

function refreshStam() {
    var data = {
        action: "refresh",
        value1
      }
      $.post(server, data, (res) => {
        $('#res').html(res)
                 
      })
      
    }
