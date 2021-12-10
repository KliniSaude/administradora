const allSelected = document.getElementById('all_selected');

if (allSelected) {
  allSelected.addEventListener('change', () => {
    console.log(allSelected.value);
  })
}
