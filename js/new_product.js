//add event listener to H_Obrazky



const Add_Image = () =>{


    const num =document.getElementById("galerie").childElementCount;
    const div =document.createElement('div');
    div.className="child";
    let element =document.createElement('label');
    element.innerText="Obrázky do galerie ";
    element.htmlFor=num.toString();
    div.appendChild(element);

    element = document.createElement('input');
    element.className="galerie";
    element.id=num.toString();
    element.name=num.toString();
    element.type="file";
    element.accept="image/*";
    element.addEventListener("change", (ev) => {
        if (!ev.target.files[0]) return; // Do nothing.
        preview(ev.target.files[0],ev.target.id); //for file
    })
    div.appendChild(element);

    element =document.createElement('label');
    element.innerText="Nazev Obrázku ";
    element.htmlFor=num.toString()+"name";
    div.appendChild(element);

    element = document.createElement('input');
    element.id=num.toString()+"name";
    element.name=num.toString()+"name";
    element.type="text";
    div.appendChild(element);

    div.appendChild(document.createElement("br"));
    element = document.createElement("div");
    element.id = num.toString()+"pr"
    element.className = "preview"
    div.appendChild(element);
    div.appendChild(document.createElement("br"));

    console.log(div);
    document.getElementById("galerie").appendChild(div);

};

//Přidá Imput pro podrobné informace
const Add_Parameter = (help) =>{

    const number = document.getElementById("info"+help).childElementCount;
    const div = document.createElement('div');

    let element = document.createElement('label');
    element.innerText = 'Jmeno Paremetru';
    element.htmlFor = help+'J' + number.toString();
    div.appendChild(element);


    element = document.createElement('input');
    element.id = help+'J' + number.toString();
    element.name= help+'J[]';

    div.appendChild(element);


    element = document.createElement('label');
    element.innerText = 'Hodnota Paremetru';
    element.htmlFor = help+'H' + number.toString();
    div.appendChild(element);


    element = document.createElement('input');
    element.id =help+'H' + number.toString();
    element.name= help+'H[]';

    div.appendChild(element);

    document.getElementById("info"+help).appendChild(div);
};



//display image after upload on website
const preview = (file,id) => {

        if (document.getElementById(id.toString()+"pr").childElementCount !== 0){
            document.getElementById(id.toString()+"pr").innerHTML="";
        }


    console.log(file);
    const img = document.createElement("img");
    img.src = URL.createObjectURL(file);  // Object Blob
    img.alt = file.name;
    img.className = "preview";
    document.getElementById(id.toString()+"pr").append(img);
};

//funguje to jenom takto nemenit
const nefacha = (ev) =>{
    if (!ev.target.files[0]) return;
    preview(ev.target.files[0],ev.target.id);
}

const Add_Category = () =>{
    const number = document.getElementById("categorys").childElementCount;

    const div = document.createElement('div');
    div.id = "category"+number;

    let element = document.createElement('div');

    element.id = "info"+number;

    div.appendChild(element);

    element = document.createElement('button');
    element.id = "button,"+number;
    element.addEventListener("click",(ev) =>{
        Add_Parameter(((ev.target.id).split(","))[1]);
    });
    element.type = "button";
    element.innerText = "Add Parameter";

    div.appendChild(element);
    const label = document.createElement('legend');
    element = document.createElement('label');
    element.htmlFor = "name_of"+number;
    element.innerText = "Name of Category   ";

    label.appendChild(element);
    const fieldset = document.createElement('fieldset');

    element = document.createElement('input');
    element.type = "text";
    element.name = "name_of[]";
    element.id = "name_of"+number;


    label.appendChild(element);
    fieldset.appendChild(label);
    fieldset.appendChild(div);
    document.getElementById("categorys").appendChild(fieldset);

}