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

window.filter = function(value) {
  var filter = value.toUpperCase();
  var lis = document.getElementsByClassName('transport_item');
  for (var i = 0; i < lis.length; i++) {
    var name = lis[i].getElementsByClassName('type')[0].innerHTML;
    if (name.toUpperCase().indexOf(filter) == 0)
      lis[i].style.display = 'list-item';
    else
      lis[i].style.display = 'none';
  }

}
