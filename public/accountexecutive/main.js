
document.addEventListener('DOMContentLoaded', function() {
    
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
    });
  
   
    const currentPage = window.location.pathname.split('/').pop() || 'index.html';
    document.querySelectorAll('.nav-link').forEach(link => {
      if (link.getAttribute('href') === currentPage) {
        link.classList.add('active');
      }
    });
  
   
    if (window.flatpickr) {
      flatpickr(".datepicker", {
        dateFormat: "Y-m-d",
        allowInput: true
      });
      
      flatpickr(".datetimepicker", {
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        allowInput: true
      });
    }
  });
  
  
  function confirmAction(message, callback) {
    if (confirm(message)) {
      callback();
    }
  }
  
  function toggleSection(sectionId) {
    const section = document.getElementById(sectionId);
    if (section) {
      section.classList.toggle('d-none');
    }
  }


// v Show Password v
function seeCharacters(field) {
    const passwordField = document.getElementById(field);
    if (passwordField.type === 'password') {
        passwordField.type = 'text';
    } else {
        passwordField.type = 'password';
    }
}

// v Make Visible v
function visible(id) {
  let dashboard = document.getElementById(id);
  dashboard.style.display = dashboard.style.display === 'block' ? 'none' : 'block';
}

// v Confirmation Window v
let text = '';
function confirmWindow(text){
    let confirmed = window.confirm(text);
    return confirmed;
}

// v Change Location v
function pages(linkhtml){
    let link = linkhtml;
    window.location.href = linkhtml;
}

// v Modal v
// function openModal(elementId,fogId){
//     let window = document.getElementById(elementId);
//     window.style.display = 'flex';
//     let fog = document.getElementById(fogId);
//     fog.style.display = 'block';
// }
// function collapseModal(elementId,fogId){
//     let window = document.getElementById(elementId);
//     window.style.display = 'none';
//     let fog = document.getElementById(fogId);
//     fog.style.display = 'none';
// }
