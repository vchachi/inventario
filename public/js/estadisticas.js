const filterElement = document.querySelector('.filter');
const afterClickDiv = document.querySelector('.after-click');
function toggleFilters() {
  afterClickDiv?.classList.toggle('active');
}
if(filterElement) {
  filterElement.addEventListener('click', toggleFilters);
}