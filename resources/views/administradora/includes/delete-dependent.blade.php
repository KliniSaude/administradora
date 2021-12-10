<script>
  const btnRemove = document.querySelectorAll('#removeDependent');
  const divMessage = document.querySelector('#message');
  if (btnRemove) {
    btnRemove.forEach(item => {
      item.addEventListener('click', () => {
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const url = `{{ route('admin.destroyDependent.proposta') }}`;
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
            id: item.getAttribute('data-remove')
          })
        }

        fetch(url, settings)
        .then(response => response.json())
        .then(data => {
          divMessage.innerText = data.message;
          divMessage.classList.remove('d-none');

          setTimeout(() => {
            document.location.reload();
          }, 2000);

        })
        .catch(error => console.log('error', error))
      })
    })
  }
</script>
