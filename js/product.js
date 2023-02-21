const Switch_Image = (Switched) =>{

  const Main = document.getElementById("S_Image")
  Main.innerHTML = ''

  const Element = document.createElement("img")
  Element.title = Switched.title
  Element.alt = Switched.alt
  Element.src = Switched.src
  Element.className = "B_Image"
  Main.appendChild(Element)


  console.log(Switched)
};

