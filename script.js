document.addEventListener("DOMContentLoaded", () => {
 
  const rows = document.querySelectorAll("#attendanceTable tbody tr");

  rows.forEach(row => {
    const inputs = row.querySelectorAll("input[type='checkbox']");
    const absCell = row.children[row.children.length - 3];
    const partCell = row.children[row.children.length - 2];
    const msgCell = row.children[row.children.length - 1];

    function update() {
      let presents = 0;
      let participations = 0;
      const totalSessions = 6;

      inputs.forEach((box, index) => {
        if (index % 2 === 0 && box.checked) presents++;
        if (index % 2 === 1 && box.checked) participations++;
      });

      const absences = totalSessions - presents;

      absCell.textContent = absences + " Abs";
      partCell.textContent = participations + " Par";

      if (absences < 3) {
        row.style.backgroundColor = "lightgreen";
        msgCell.textContent = "Good attendance – Excellent participation";
      } else if (absences <= 4) {
        row.style.backgroundColor = "lightyellow";
        msgCell.textContent = "Warning – attendance low – You need to participate more";
      } else {
        row.style.backgroundColor = "red";
        msgCell.textContent = "Excluded – too many absences";
      }
    }

    inputs.forEach(box => box.addEventListener("change", update));
  });
})
/*window.onload = function() {
    const table = document.getElementById('attendanceTable');
    const rows = table.tBodies[0].rows;

    /* We know attendance columns are:
      Columns 2 to 13 indices (0-based): 12 columns - alternating P and Pa
      Index:
      0-1: LastName, FirstName
      2: S1 P
      3: S1 Pa
      4: S2 P
      5: S2 Pa
      ...
      12: S6 P
      13: S6 Pa
      14: Absences (to fill)
      15: Participation (to fill)
      16: Message (to fill)
    */

   /* for (let row of rows) {
      let absences = 0;
      let participation = 0;

      for (let col = 2; col <= 13; col++) {
        const cell = row.cells[col];
        const hasCheck = cell.querySelector('.check') !== null;
        if (col % 2 === 0) {
          // Attendance columns at even indices: P (presence)
          if (!hasCheck) absences++;
        } else {
          // Participation columns at odd indices: Pa (participation)
          if (hasCheck) participation++;
        }
      }

      // Fill Absences and Participation columns
      row.cells[14].textContent = absences + (absences > 1 ? ' Abs' : ' Abs');
      row.cells[15].textContent = participation + (participation > 1 ? ' Par' : ' Par');

      // Highlight row based on absences
      if (absences < 3) {
        row.style.backgroundColor = '#d3e6d3'; // green
      } else if (absences >= 3 && absences <= 4) {
        row.style.backgroundColor = '#f9edc9'; // yellow
      } else {
        row.style.backgroundColor = '#f9cbcb'; // red
      }

      // Determine Message text
      let message = '';
      if (absences < 3 && participation >= 3) {
        message = 'Good attendance – Excellent participation';
      } else if (absences >=3 && absences <=4) {
        message = 'Warning – attendance low – You need to participate more';
      } else if (absences >= 5) {
        message = 'Excluded – too many absences – You need to participate more';
      }
      row.cells[16].textContent = message;
*/
 /*document.getElementById('StudentForm').addEventListener('submit', function(e) {
    e.preventDefault(); // prevent form submit by default

    // Clear previous errors
    let errors = false;
    const clearError = id => document.getElementById(id).textContent = '';
    clearError('studentIdError');
    clearError('lastNameError');
    clearError('firstNameError');
    clearError('emailError');

    // Values
    const studentId = document.getElementById('studentId').value.trim();
    const lastName = document.getElementById('lastName').value.trim();
    const firstName = document.getElementById('firstName').value.trim();
    const email = document.getElementById('email').value.trim();

    // Validation patterns
    const onlyNumbers = /^[0-9]+$/;
    const onlyLetters = /^[A-Za-zÀ-ÖØ-öø-ÿ '-]+$/; // letters plus accented and some punctuation
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    // Validate Student ID
    if (studentId === '') {
      document.getElementById('studentIdError').textContent = 'Student ID cannot be empty.';
      errors = true;
    } else if (!onlyNumbers.test(studentId)) {
      document.getElementById('studentIdError').textContent = 'Student ID must contain only numbers.';
      errors = true;
    }

    // Validate Last Name
    if (lastName === '') {
      document.getElementById('lastNameError').textContent = 'Last Name cannot be empty.';
      errors = true;
    } else if (!onlyLetters.test(lastName)) {
      document.getElementById('lastNameError').textContent = 'Last Name must contain only letters.';
      errors = true;
    }

    // Validate First Name
    if (firstName === '') {
      document.getElementById('firstNameError').textContent = 'First Name cannot be empty.';
      errors = true;
    } else if (!onlyLetters.test(firstName)) {
      document.getElementById('firstNameError').textContent = 'First Name must contain only letters.';
      errors = true;
    }

    // Validate Email
    if (email === '') {
      document.getElementById('emailError').textContent = 'Email cannot be empty.';
      errors = true;
    } else if (!emailPattern.test(email)) {
      document.getElementById('emailError').textContent = 'Invalid email format.';
      errors = true;
    }

    if(!errors) {
      alert('Form submitted successfully!');
      // you can proceed with form submit here, like:
      // e.target.submit();
      // or AJAX call
    }
  });*/
 // script.js
// script.js
// Get form elements
const studentIdInput = document.getElementById('studentId');
const lastNameInput = document.getElementById('lastName');
const firstNameInput = document.getElementById('firstName');
const emailInput = document.getElementById('email');

const studentIdError = document.getElementById('studentIdError');
const lastNameError = document.getElementById('lastNameError');
const firstNameError = document.getElementById('firstNameError');
const emailError = document.getElementById('emailError');
const confirmationMsg = document.getElementById('confirmationMsg');
const form = document.getElementById('addStudentForm');
const tableBody = document.querySelector('#attendanceTable tbody');

// 🧹 Function to clear error messages
function clearErrors() {
  studentIdError.textContent = '';
  lastNameError.textContent = '';
  firstNameError.textContent = '';
  emailError.textContent = '';
  confirmationMsg.textContent = '';
}

// ✅ Validation function
function validateForm() {
  clearErrors();
  let isValid = true;

  const onlyNumbers = /^[0-9]+$/;
  const onlyLetters = /^[A-Za-zÀ-ÖØ-öø-ÿ '-]+$/;
  const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

  // Student ID validation
  if (studentIdInput.value.trim() === '') {
    studentIdError.textContent = 'Student ID cannot be empty.';
    isValid = false;
  } else if (!onlyNumbers.test(studentIdInput.value.trim())) {
    studentIdError.textContent = 'Student ID must contain only numbers.';
    isValid = false;
  }

  // Last Name validation
  if (lastNameInput.value.trim() === '') {
    lastNameError.textContent = 'Last Name cannot be empty.';
    isValid = false;
  } else if (!onlyLetters.test(lastNameInput.value.trim())) {
    lastNameError.textContent = 'Last Name must contain only letters.';
    isValid = false;
  }

  // First Name validation
  if (firstNameInput.value.trim() === '') {
    firstNameError.textContent = 'First Name cannot be empty.';
    isValid = false;
  } else if (!onlyLetters.test(firstNameInput.value.trim())) {
    firstNameError.textContent = 'First Name must contain only letters.';
    isValid = false;
  }

  // Email validation
  if (emailInput.value.trim() === '') {
    emailError.textContent = 'Email cannot be empty.';
    isValid = false;
  } else if (!emailPattern.test(emailInput.value.trim())) {
    emailError.textContent = 'Invalid email format.';
    isValid = false;
  }

  return isValid;
}

// 🧮 Function to calculate absences and participation
function calculateAbsencesParticipation(row) {
  let absences = 0;
  let participation = 0;

  for (let i = 2; i <= 13; i++) {
    const cell = row.cells[i];
    const checkbox = cell.querySelector('input[type="checkbox"]');
    if (i % 2 === 0) { // Presence column
      if (!checkbox || !checkbox.checked) absences++;
    } else { // Participation column
      if (checkbox && checkbox.checked) participation++;
    }
  }
  return { absences, participation };
}

// 🎨 Function to update row color and message
function updateRowAppearance(row) {
  const { absences, participation } = calculateAbsencesParticipation(row);

  row.cells[14].textContent = `${absences} Abs`;
  row.cells[15].textContent = `${participation} Par`;

  // Reset row colors
  row.classList.remove('row-red', 'row-yellow', 'row-green');

  if (absences < 3) row.classList.add('row-green');
  else if (absences <= 4) row.classList.add('row-yellow');
  else row.classList.add('row-red');

  let message = '';
  if (absences < 3 && participation >= 3)
    message = 'Good attendance – Excellent participation';
  else if (absences >= 3 && absences <= 4)
    message = 'Warning – attendance low – You need to participate more';
  else if (absences >= 5)
    message = 'Excluded – too many absences – You need to participate more';

  row.cells[16].textContent = message;
}

// 🚀 Initialize table on page load
window.onload = () => {
  const rows = [...tableBody.rows];
  rows.forEach(updateRowAppearance);
};

// 🧾 Handle form submission
form.addEventListener('submit', (e) => {
  e.preventDefault();
  if (!validateForm()) return;

  // Create new row
  const newRow = document.createElement('tr');
  newRow.innerHTML = `
    <td>${lastNameInput.value.trim()}</td>
    <td>${firstNameInput.value.trim()}</td>
    <td><input type="checkbox"></td><td><input type="checkbox"></td>
    <td><input type="checkbox"></td><td><input type="checkbox"></td>
    <td><input type="checkbox"></td><td><input type="checkbox"></td>
    <td><input type="checkbox"></td><td><input type="checkbox"></td>
    <td><input type="checkbox"></td><td><input type="checkbox"></td>
    <td><input type="checkbox"></td><td><input type="checkbox"></td>
    <td></td><td></td><td></td>
  `;

  // Add row to table
  tableBody.appendChild(newRow);

  // Update its color/message
  updateRowAppearance(newRow);

  // Show success message
  confirmationMsg.textContent = `✅ Student ${lastNameInput.value.trim()} ${firstNameInput.value.trim()} added successfully!`;

  // Reset form
  form.reset();
});
// ✅ Wait until page is loaded
document.addEventListener("DOMContentLoaded", () => {

  // 🎯 --- Attendance Calculation on Checkbox Change ---
  const rows = document.querySelectorAll("#attendanceTable tbody tr");

  rows.forEach(row => {
    const inputs = row.querySelectorAll("input[type='checkbox']");
    const absCell = row.children[row.children.length - 3];
    const partCell = row.children[row.children.length - 2];
    const msgCell = row.children[row.children.length - 1];

    function update() {
      let presents = 0;
      let participations = 0;
      const totalSessions = 6;

      inputs.forEach((box, index) => {
        if (index % 2 === 0 && box.checked) presents++;
        if (index % 2 === 1 && box.checked) participations++;
      });

      const absences = totalSessions - presents;

      absCell.textContent = absences + " Abs";
      partCell.textContent = participations + " Par";

      if (absences < 3) {
        row.style.backgroundColor = "lightgreen";
        msgCell.textContent = "Good attendance – Excellent participation";
      } else if (absences <= 4) {
        row.style.backgroundColor = "lightyellow";
        msgCell.textContent = "Warning – attendance low – You need to participate more";
      } else {
        row.style.backgroundColor = "lightcoral";
        msgCell.textContent = "Excluded – too many absences";
      }
    }

    inputs.forEach(box => box.addEventListener("change", update));
  });


 // 🎯 --- Show Report Button ---
const showReportBtn = document.getElementById("showReportBtn");
const reportSection = document.getElementById("reportSection");
const chartCanvas = document.getElementById("reportChart");
let reportChart = null; // Chart instance to avoid duplicating on each click

showReportBtn.addEventListener("click", () => {
  const rows = document.querySelectorAll("#attendanceTable tbody tr");
  const totalStudents = rows.length;
  let totalPresent = 0;
  let totalParticipation = 0;

  // Count present and participation by checking checkboxes
  for (const row of rows) {
    const checkboxes = row.querySelectorAll("input[type='checkbox']");
    for (let i = 0; i < checkboxes.length; i++) {
      if (i % 2 === 0 && checkboxes[i].checked) totalPresent++;
      else if (i % 2 === 1 && checkboxes[i].checked) totalParticipation++;
    }
  }

  // 🧾 Display numeric report
  reportSection.innerHTML = `
    <h3>📊 Attendance Report</h3>
    <p><strong>Total Students:</strong> ${totalStudents}</p>
    <p><strong>Present:</strong> ${totalPresent}</p>
    <p><strong>Participated:</strong> ${totalParticipation}</p>
    <canvas id="reportChart" style="max-width:100%; height:300px;"></canvas>
  `;

  // Get the canvas again after replacing innerHTML
  const ctx = document.getElementById("reportChart").getContext('2d');

  // 🧹 Destroy previous chart if it exists
  if (reportChart) {
    reportChart.destroy();
  }

  // 📈 Create chart (bar chart)
  reportChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Total Students', 'Present', 'Participated'],
      datasets: [{
        label: 'Attendance Report',
        data: [totalStudents, totalPresent, totalParticipation],
        backgroundColor: ['#007bff', '#28a745', '#ffc107'],
        borderRadius: 4,
        barPercentage: 0.6,
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: { display: false },
        title: {
          display: true,
          text: 'Attendance & Participation Summary',
          font: { size: 18, weight: '600' },
          padding: { bottom: 10 }
        }
      },
      scales: {
        y: {
          beginAtZero: true,
          ticks: { stepSize: 1 }
        }
      }
    }
  });
});
 
 $(document).ready(function(){
    // Highlight row on mouse enter
    $('#attendanceTable tbody tr').mouseenter(function() {
      $(this).addClass('highlight');
    });

    // Remove highlight on mouse leave
    $('#attendanceTable tbody tr').mouseleave(function() {
      $(this).removeClass('highlight');
    });

    // On row click show message box with full name and absences count
    $('#attendanceTable tbody tr').click(function() {
      const lastName = $(this).children('td').eq(0).text();
      const firstName = $(this).children('td').eq(1).text();
      const absencesText = $(this).children('td').eq(14).text(); // "5 Abs" format

      alert(`Student: ${firstName} ${lastName}\nNumber of absences: ${absencesText}`);
    });
  });
  $(document).ready(function(){
  // Highlight row on hover
  $('#attendanceTable tbody').on('mouseenter', 'tr', function() {
    $(this).addClass('highlight');
  }).on('mouseleave', 'tr', function() {
    $(this).removeClass('highlight');
  });

  // When clicking a row
  $('#attendanceTable tbody').on('click', 'tr', function() {
    const lastName = $(this).children('td').eq(0).text();
    const firstName = $(this).children('td').eq(1).text();
    const absencesText = $(this).children('td').eq(14).text(); // adjust index if needed

    $('#studentName').text(`👩‍🎓 Student: ${firstName} ${lastName}`);
    $('#studentAbsences').text(`📅 Number of absences: ${absencesText}`);
    $('#studentInfoBox').css('display', 'flex'); // show modal
  });

  // Close button
  $('#closeInfo').click(function(){
    $('#studentInfoBox').hide();
  });

  // Hide box when clicking outside the content
  $(window).click(function(e){
    if ($(e.target).is('#studentInfoBox')) {
      $('#studentInfoBox').hide();
    }
  });
});


$(document).ready(function() {

  // 🔹 لما نضغط على الزر "Highlight Excellent Students"
  $('#highlightBtn').click(function() {
    $('#attendanceTable tbody tr').each(function() {
      const absText = $(this).children('td').eq(14).text();
      const absences = parseInt(absText);

      // 🔸 إذا عدد الغيابات أقل من 3 → الطالب ممتاز
      if (absences < 3) {
        const row = $(this);

        // تأثير تلّمع (fade out ثم fade in)
        row.fadeOut(300)
           .fadeIn(300)
           .css('background-color', '#a8e6cf'); // لون أخضر فاتح
      }
    });
  });

  // 🔹 لما نضغط على "Reset Colors"
  $('#resetBtn').click(function() {
    $('#attendanceTable tbody tr').each(function() {
      $(this).css('background-color', ''); // يرجع اللون الأصلي
    });
  });

});
// ==========================
// 🔍 EXO 7 — SEARCH BY NAME
// ==========================
$(document).ready(function() {

  $("#searchInput").on("keyup", function() {
    const value = $(this).val().toLowerCase();

    $("#attendanceTable tbody tr").filter(function() {
      const lastName = $(this).children('td').eq(0).text().toLowerCase();
      const firstName = $(this).children('td').eq(1).text().toLowerCase();

      $(this).toggle(
        lastName.includes(value) || firstName.includes(value)
      );
    });
  });

  // ======================================
  // 🔼 Sort by Absences (Ascending)
  // ======================================
  $("#sortAbsBtn").click(function() {
    const rows = $("#attendanceTable tbody tr").get();

    rows.sort(function(a, b) {
      const absA = parseInt($(a).children("td").eq(14).text());
      const absB = parseInt($(b).children("td").eq(14).text());
      return absA - absB;
    });

    $("#attendanceTable tbody").append(rows);
    $("#sortMessage").text("Currently sorted by absences (ascending)");
  });

  // =======================================
  // 🔽 Sort by Participation (Descending)
  // =======================================
  $("#sortPartBtn").click(function() {
    const rows = $("#attendanceTable tbody tr").get();

    rows.sort(function(a, b) {
      const partA = parseInt($(a).children("td").eq(15).text());
      const partB = parseInt($(b).children("td").eq(15).text());
      return partB - partA; 
    });

    $("#attendanceTable tbody").append(rows);
    $("#sortMessage").text("Currently sorted by participation (descending)");
  });

});



});
