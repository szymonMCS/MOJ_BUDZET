document.addEventListener('DOMContentLoaded', function () {
    const lastActiveTab = localStorage.getItem('activeTab');

    if (lastActiveTab && !lastActiveTab.startsWith('#')) {
        localStorage.removeItem('activeTab');
    }

    if (lastActiveTab && lastActiveTab.startsWith('#')) {
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

            if (targetPane.startsWith('#')) {
                localStorage.setItem('activeTab', targetPane);
            }
        });
    });

    const incomesCategories = window.settingsData.incomesCategories || [];
    const outcomesCategories = window.settingsData.outcomesCategories || [];
    const successFlags = window.settingsData.successFlags || {};
    const {
      openEditModalAtStart = false,
      oldFormData = {},
      errors = {}
    } = window.settingsData;
    console.log("openEditModalAtStart: ", openEditModalAtStart);
    console.log("oldFormData.editCategoryType: ", oldFormData.editCategoryType);
    console.log("oldFormData.addInEditLimitInput: ", oldFormData.addInEditLimitInput);
    console.log("oldFormData.changedCategoryName: ", oldFormData.changedCategoryName);
    console.log("oldFormData.editLimitInput: ", oldFormData.editLimitInput);
    console.log("errors.changedCategoryName: ", errors.changedCategoryName);
    console.log("oldFormData: ", oldFormData);
    console.log("errors: ", errors);
    

    const addTypeSelect = document.getElementById('newCategoryType');    
    const removeTypeSelect = document.getElementById('removeCategoryType');
    const addCheckbox = document.getElementById('addLimitCheckbox');
    const removeCategorySelect = document.getElementById('removeCategoryName');
    const editTypeSelect = document.getElementById('editCategoryType');
    const editCategorySelect = document.getElementById('editCategoryName');
    const openDeleteModalButton = document.getElementById('openDeleteModal');
    const openEditModalButton = document.getElementById('openEditModal');
    const addLimitOptions = document.getElementById('addLimitOptions');
    const limitInputDiv = document.getElementById('limitInput');
    const addLimitInputContainer = document.getElementById('limitInput');
    const changedCategoryNameInput = document.getElementById('changedCategoryName');
    const editLimitOptions = document.getElementById('editLimitOptions');
    const editLimitCheckbox = document.getElementById('editLimitCheckbox');
    const addInEditLimitInputDiv = document.getElementById('addInEditLimitInput');
    const editLimitInputDiv = document.getElementById('editLimitInput');

    

    function loadCategories(selectedElement, categories) {
        selectedElement.innerHTML = '<option value="-1" selected>Wybierz kategorię...</option>';
  
        categories.forEach(category => {
          const option = document.createElement('option');
          option.value = category.id;
          option.textContent = category.name;
          option.dataset.limit = category.limit;
          selectedElement.appendChild(option);
        });
    }

    function handleEditLimitCheckboxChange() {
        const addLimitInput = addInEditLimitInputDiv.querySelector('input');

        if (this.checked) {
            addInEditLimitInputDiv.style.display = 'block';
            editLimitInputDiv.style.display = 'none';
        } else {
            addInEditLimitInputDiv.style.display = 'none';
            addLimitInput.value = '';
            editLimitInputDiv.style.display = 'none';
        }
    } 

    function showSuccessModal(modalId) {
        const modalElement = document.getElementById(modalId);
        const myModal = new bootstrap.Modal(modalElement);
        myModal.show();
    }

    addTypeSelect.addEventListener('change', function() {
      if (this.value === 'outcomes') {
        addLimitOptions.style.display = 'block';
      } else if (this.value === 'incomes') {
        addLimitOptions.style.display = 'none';
        if(addCheckbox) addCheckbox.checked = false;
        if(limitInputDiv) limitInputDiv.style.display = 'none';
        const limitInputField = limitInputDiv.querySelector('input');
        if(limitInputField) limitInputField.value = null;
      }
    });

    addCheckbox.addEventListener('change', function() {
      if (this.checked) {
        limitInputDiv.style.display = 'block';
      } else {
        limitInputDiv.style.display = 'none';
        const limitInputField = limitInputDiv.querySelector('input');
        if(limitInputField) limitInputField.value = null;
      }
    });

    removeTypeSelect.addEventListener('change', function() {
      if (this.value === 'incomes') {
        loadCategories(removeCategorySelect, incomesCategories);
      } else if (this.value === 'outcomes') {
        loadCategories(removeCategorySelect, outcomesCategories);
      }
    });

    editTypeSelect.addEventListener('change', function() {
      if (this.value === 'incomes') {
        loadCategories(editCategorySelect, incomesCategories);
      } else if (this.value === 'outcomes') {
        loadCategories(editCategorySelect, outcomesCategories);
      }
    });

    openDeleteModalButton.addEventListener('click', function() {
        const modalElement = document.getElementById('delAccountModal');
        const myModal = new bootstrap.Modal(modalElement);
        myModal.show();
    });


    if(openEditModalAtStart){
      editTypeSelect.value = oldFormData.editCategoryType || '-1';
      editTypeSelect.dispatchEvent(new Event('change'));

      editCategorySelect.value = oldFormData.editCategoryName || '-1';
      changedCategoryNameInput.value = oldFormData.changedCategoryName || '';
  
      if (oldFormData.addInEditLimitInput) {
        editLimitOptions.style.display = 'block';
        editLimitCheckbox.checked = true;
        addInEditLimitInputDiv.style.display = 'block';
        addInEditLimitInputDiv.querySelector('input').value = oldFormData.addInEditLimitInput;
      } else if (oldFormData.editLimitInput) {
        editLimitOptions.style.display = 'block';
        editLimitInputDiv.style.display = 'block';
        editLimitInputDiv.querySelector('input').value = oldFormData.editLimitInput;
      }

      if (errors.changedCategoryName) {
        const errDiv = document.getElementById('modalError');
        if (errDiv) {
          errDiv.textContent = errors.changedCategoryName;
          errDiv.style.display = 'block';
        }
      }
      const modalElement = document.getElementById('editCategoryModal');
      const myModal = new bootstrap.Modal(modalElement);
      myModal.show();
    }


    if (openEditModalButton) {
      openEditModalButton.addEventListener('click', function() {
        const selectedCategoryOption = editCategorySelect.options[editCategorySelect.selectedIndex];
        const selectedTypeOption = editTypeSelect.options[editTypeSelect.selectedIndex];
        const selectedTypeValue = selectedTypeOption.value;
        const selectedCategoryValue = selectedCategoryOption.value;

        if (selectedTypeValue === "-1" || selectedCategoryValue === "-1") {
          return;
        }

        
        const selectedTypeName = editTypeSelect.value;
        const selectedCategoryName = selectedCategoryOption.textContent;
        const limitRaw = selectedCategoryOption.dataset.limit;
        const limit = (limitRaw !== null && limitRaw !== '' && !isNaN(parseFloat(limitRaw))) ? parseFloat(limitRaw) : null;
        const editorBox = document.getElementById('editorBox');
        
        
        
        const addLimitInput = addInEditLimitInputDiv.querySelector('input');
        const editLimitInput = editLimitInputDiv.querySelector('input');

        changedCategoryNameInput.value = selectedCategoryName;

        if (selectedTypeName === 'outcomes') {
          editLimitOptions.style.display = 'block';

          editLimitCheckbox.removeEventListener('change', handleEditLimitCheckboxChange);

          if (limit !== null && limit >= 0) {
            editorBox.style.display = 'none';
            addInEditLimitInputDiv.style.display = 'none';
            editLimitInputDiv.style.display = 'block';
            editLimitInput.value = limit;
            addLimitInput.value = '';
            editLimitCheckbox.checked = false;
          } else {
            editorBox.style.display = 'block';
            editLimitCheckbox.checked = false;
            addInEditLimitInputDiv.style.display = 'none';
            editLimitInputDiv.style.display = 'none';
            addLimitInput.value = '';
            editLimitInput.value = '';
            editLimitCheckbox.addEventListener('change', handleEditLimitCheckboxChange);
            handleEditLimitCheckboxChange.call(editLimitCheckbox);
          }
        } else {
          editLimitOptions.style.display = 'none';
          editorBox.style.display = 'none';
          editLimitCheckbox.checked = false;
          addInEditLimitInputDiv.style.display = 'none';
          addLimitInput.value = '';
          editLimitInputDiv.style.display = 'none';
          editLimitInput.value = '';
          editLimitCheckbox.removeEventListener('change', handleEditLimitCheckboxChange);
        }
        
        const modalElement = document.getElementById('editCategoryModal');
        const myModal = new bootstrap.Modal(modalElement);
        myModal.show();
      });

      if (successFlags.profileUpdate) showSuccessModal('usernameModal');
      if (successFlags.passwordUpdate) showSuccessModal('passwordModal');
      if (successFlags.categoryAdded) showSuccessModal('addCategoryModal');
      if (successFlags.categoryRemoved) showSuccessModal('removeCategoryModal');
      if (successFlags.categoryEdited) showSuccessModal('succesCategoryEditModal');
    }
});




    
