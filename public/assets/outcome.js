document.addEventListener('DOMContentLoaded', function () {
  const currentDate = new Date().toISOString().split('T')[0];
  document.getElementById('floatingDate').value = currentDate;

  const detailsDiv = document.getElementById('detailsDiv');
  const typedAmountInput = document.getElementById('typedAmount');
  const dateControl = document.getElementById('floatingDate');
  const selectedCategory = document.getElementById('chosenCategory');

  const limitInfoContainer = document.getElementById('limitInfo');
  const differenceInfoContainer = document.getElementById('differenceInfo');
  const leftAmountInfoContainer = document.getElementById('leftAmountInfo');
  const spentSumInfoContainer = document.getElementById('spentSumInfo');

  let currentApiData = {
      limit: null,
      sum: null
  };
  let currentDifference = 0;

  function updateLeftAmountInfo() {
      if (!typedAmountInput || currentApiData.limit === null) {
          leftAmountInfoContainer.style.display = 'none';
          return;
      }

      const typedValue = parseFloat(typedAmountInput.value) || 0;

      if (typedValue > 0) {
          leftAmountInfoContainer.style.display = 'block';
      } else {
          leftAmountInfoContainer.style.display = 'none';
          return;
      }

      const suggestedBalance = currentDifference - typedValue;

      leftAmountInfoContainer.classList.remove('limit-background-positive', 'limit-background-warning', 'limit-background-negative');

      if (suggestedBalance < 0) {
          leftAmountInfoContainer.classList.add('limit-background-negative');
      } else if (suggestedBalance > 0) {
          leftAmountInfoContainer.classList.add('limit-background-positive');
      } else {
          leftAmountInfoContainer.classList.add('limit-background-warning');
      }
      leftAmountInfoContainer.innerHTML = `<span class="my-0 fw-normal text-center">Po dodaniu tego wydatku balans wyniesie: <strong>${suggestedBalance.toFixed(2)} PLN</strong></span>`;
  }

  function fetchAndUpdateDetails() {
      const selectedCategoryId = selectedCategory.value;
      const selectedDate = dateControl.value;

      if (limitInfoContainer) limitInfoContainer.innerHTML = '';
      if (spentSumInfoContainer) spentSumInfoContainer.innerHTML = '';
      if (differenceInfoContainer) differenceInfoContainer.innerHTML = '';
      if (leftAmountInfoContainer) {
          leftAmountInfoContainer.innerHTML = '';
          leftAmountInfoContainer.style.display = 'none';
      }
      detailsDiv.style.display = 'none';
      currentApiData = { limit: null, sum: null };
      currentDifference = 0;


      if (selectedCategoryId !== "-1" && selectedDate) {
          const url = `/api/limit/${encodeURIComponent(selectedCategoryId)}/date/${encodeURIComponent(selectedDate)}`;
          console.log("Fetching URL:", url);
          fetch(url)
              .then(response => {
                  if (!response.ok) {
                      return response.json().then(errData => {
                          throw new Error(`Błąd ${response.status}: ${errData.error || response.statusText}`);
                      }).catch(() => {
                          throw new Error(`Błąd sieci lub serwera: ${response.status} ${response.statusText}`);
                      });
                  }
                  return response.json();
              })
              .then(data => {
                  console.log("API Data Received:", data);
                  if (data.limit !== null && data.limit !== undefined) {
                      detailsDiv.style.display = 'block';
                      const limit = parseFloat(data.limit);
                      const spentSum = parseFloat(data.sum) || 0;

                      currentApiData.limit = limit;
                      currentApiData.sum = spentSum;
                      currentDifference = limit - spentSum;

                      limitInfoContainer.innerHTML = `<span class="my-0 fw-normal text-center">Ustawiony limit miesięczny: <strong>${limit.toFixed(2)} PLN</strong></span>`;
                      spentSumInfoContainer.innerHTML = `<span class="my-0 fw-normal text-center">W tym miesiącu wydano: <strong>${spentSum.toFixed(2)} PLN</strong></span>`;

                      differenceInfoContainer.classList.remove('limit-background-positive', 'limit-background-warning', 'limit-background-negative');
                      if (currentDifference < 0) {
                          differenceInfoContainer.classList.add('limit-background-negative');
                          differenceInfoContainer.innerHTML = `<span class="my-0 fw-normal text-center">Przekroczono limit o: <strong>${Math.abs(currentDifference).toFixed(2)} PLN</strong></span>`;
                      } else if (currentDifference > 0) {
                          differenceInfoContainer.classList.add('limit-background-positive');
                          differenceInfoContainer.innerHTML = `<span class="my-0 fw-normal text-center">Pozostało do limitu: <strong>${currentDifference.toFixed(2)} PLN</strong></span>`;
                      } else {
                          differenceInfoContainer.classList.add('limit-background-warning');
                          differenceInfoContainer.innerHTML = `<span class="my-0 fw-normal text-center">Limit został osiągnięty.</span>`;
                      }
                      updateLeftAmountInfo();
                  } else {
                      detailsDiv.style.display = 'none';
                      limitInfoContainer.innerHTML = `<span class="text-warning">Brak ustawionego limitu dla tej kategorii.</span>`;
                  }
              })
              .catch(error => {
                  console.error("Błąd fetch:", error.message);
                  if (limitInfoContainer) {
                      limitInfoContainer.innerHTML = `<span class="text-danger">Błąd: ${error.message}</span>`;
                  }
                  detailsDiv.style.display = 'none';
              });
      } else {
          detailsDiv.style.display = 'none';
      }
  }

  selectedCategory.addEventListener('change', fetchAndUpdateDetails);
  dateControl.addEventListener('change', fetchAndUpdateDetails);

  if (typedAmountInput) {
      typedAmountInput.addEventListener('input', updateLeftAmountInfo);
  }
});