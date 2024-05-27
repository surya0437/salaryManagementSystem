function filterTable() {
  var salaryCalculationSection = document.getElementById('salaryCalculationSection');
  var selectedYear = document.getElementById("selectYear").value;
  var selectedMonth = document.getElementById("selectMonth").value;

  var errorMsg = document.getElementById("errorMsg");
  var workingDay = document.getElementById("workingDay");
  var presentDay = document.getElementById("presentDay");
  var absentDay = document.getElementById("absentDay");
  var getMonth = document.getElementById("getMonth");



  if (selectedYear === "" && selectedMonth === "") {
    errorMsg.classList.remove('d-none');
    errorMsg.innerHTML = "Please select both year and month.";
  } else if (selectedYear === "") {
    errorMsg.classList.remove('d-none');
    errorMsg.innerHTML = "Please select year.";
  } else if (selectedMonth === "") {
    errorMsg.classList.remove('d-none');
    errorMsg.innerHTML = "Please select month.";
  } else {
    errorMsg.classList.add('d-none');
    salaryCalculationSection.classList.remove('d-none')
    var table = document.getElementById('empDataTable');
    var rows = table.getElementsByTagName('tr');

    var totalDay = 0;
    var totalPresentDay = 0;

    for (var i = 0; i < (rows.length) - 1; i++) {
      var yearTD = rows[i].getElementsByTagName('td')[1];
      var monthTD = rows[i].getElementsByTagName('td')[2];
      var dayTD = rows[i].getElementsByTagName('td')[4];
      var statusTD = rows[i].getElementsByTagName('td')[5];

      var yearValue = yearTD ? (yearTD.textContent || yearTD.innerText).trim() : "";
      var monthValue = monthTD ? (monthTD.textContent || monthTD.innerText).trim() : "";

      var dayValue = monthTD ? (dayTD.textContent || dayTD.innerText).trim() : "";
      var statusValue = monthTD ? (statusTD.textContent || statusTD.innerText).trim() : "";

      if (yearValue === selectedYear && monthValue === selectedMonth) {

        rows[i].style.display = "";
        if (dayValue != 'Saturday') {
          totalDay++;
        }
        if (statusValue == 'Present') {
          totalPresentDay++;
        }
      } else {
        rows[i].style.display = "none";
      }
    }


    workingDay.innerHTML = totalDay;
    presentDay.innerHTML = totalPresentDay;
    absentDay.innerHTML = (totalDay - totalPresentDay);
    getMonth.innerHTML = selectedMonth;

    document.getElementById('setYear').value = selectedYear;
    document.getElementById('setMonth').value = selectedMonth;

  }
}

function calculateTotalSalary() {

  var total = 0;
  var netSalary = parseInt(document.getElementById("netSalary").innerHTML);
  var bonus = document.getElementById("bonus").value;
  var vatAmount = document.getElementById("vatAmount");
  var totalPayable = document.getElementById("totalPayable");
  var presentDay = document.getElementById("presentDay").innerHTML;

  if (parseInt(presentDay) == 0 || presentDay === "") {
    swal({
      title: "Error !",
      text: "Present days must be more than 0 !",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    });

  } else {
    if (bonus === "") {
      bonus = 0;
    } else {
      bonus = parseInt(bonus);

    }
    total = netSalary + bonus;
    var vat = (total * 0.13).toFixed(2);

    var totalPayableAmount = (total - vat).toFixed(2);

    vatAmount.innerHTML = vat;
    totalPayable.innerHTML = totalPayableAmount;



    var setSalaryamount = document.getElementById("setSalaryamount");
    var setBonus = document.getElementById("setBonus");
    var setVatAmount = document.getElementById("setVatAmount");
    var setPayableAmount = document.getElementById("setPayableAmount");

    setSalaryamount.value = netSalary;
    setBonus.value = bonus;
    setVatAmount.value = vat;
    setPayableAmount.value = totalPayableAmount

  }
}

