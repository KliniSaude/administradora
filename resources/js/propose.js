const allSelected = document.getElementById('all_selected');
const selectedProposes = document.querySelectorAll('#selected_propose');
const btnExportedPropose = document.getElementById('exportar_propostas');

function selectedPropose(checked){
  selectedProposes.forEach(item => {
    item.checked = checked
  })
}

if (allSelected) {
  allSelected.addEventListener('click', () => {
    if (allSelected.checked == true) {
      selectedPropose(true)
    }

    if (allSelected.checked == false) {
      selectedPropose(false)
    }
  })
}

/**
 * Exportação de Proposta
 */

if (btnExportedPropose) {
  btnExportedPropose.addEventListener('click', () => {
    if (selectedProposes) {
      let idsArray = [];
      selectedProposes.forEach( (item, value) => {
        if (item.checked == true) {
          idsArray[value] = item.value;
        }
      })

      const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
      const url = btnExportedPropose.getAttribute('data-route');
      const method = 'POST';

      const settings = {
        headers: {
          "Content-Type": "application/json",
          "Accept": "application/json, text-plain, */*",
          "X-Requested-With": "XMLHttpRequest",
          "X-CSRF-TOKEN": token
        },
        method: method,
        credentials: "same-origin",
        body: JSON.stringify({
          id: idsArray
        })
      }

      fetch(url, settings)
      .then(response => response.text())
      .then(result => {console.log(result)})

    }
  })
}
