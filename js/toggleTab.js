var viewTab = function viewTab(id) {
  let tabs = document.getElementsByClassName(id);
  if (tabs[0].style.display == "table-row") {
    for (i=0; i<tabs.length; i++) {
      tabs[i].style.display = "none";
    }
  } else {
    for (i=0; i<tabs.length; i++) {
      tabs[i].style.display = "table-row";
    }
  }
}
