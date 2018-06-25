window.changeTab = (el, tabName) => {
  let i = 0;
  let children = document.getElementById('trip-tabs').children;
  for (i = 0; i < children.length; i++) {
    children[i].classList.remove('selected');
  }
  el.classList.add('selected');
  children = document.getElementById('fragments').children;

  for (i = 0; i < children.length; i++) {
    console.log(children[i]);
    children[i].classList.add('hidden');
  }
  document.getElementById(tabName).classList.remove('hidden');
}
