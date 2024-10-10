document.addEventListener('DOMContentLoaded', function () {
  const lastActiveTab = localStorage.getItem('activeTab');
  
  if (lastActiveTab) {
      document.querySelectorAll('.nav-link').forEach(function (tab) {
          tab.classList.remove('active');
      });
      document.querySelectorAll('.tab-pane').forEach(function (pane) {
          pane.classList.remove('active');
      });

      const activeTab = document.querySelector(`a[href="${lastActiveTab}"]`);
      const activePane = document.querySelector(lastActiveTab);
      
      if (activeTab) activeTab.classList.add('active');
      if (activePane) activePane.classList.add('active');
  }

  document.querySelectorAll('.nav-link').forEach(function (tab) {
      tab.addEventListener('click', function () {
          const targetPane = this.getAttribute('href');

          localStorage.setItem('activeTab', targetPane);
      });
  });
});
