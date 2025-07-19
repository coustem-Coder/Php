let edit = document.querySelectorAll('.edit');

Array.from(edit).forEach((element) => {

  element.addEventListener("click", (e) => {
    console.log("edit", e);

    let tr = e.target.parentNode.parentNode;
    let title = tr.getElementsByTagName("td")[1].innerText;
    let desc = tr.getElementsByTagName("td")[2].innerText;

    console.log(e, tr, title, desc);

    let editInTitle = document.querySelector("#title-name");
    let editInDesc = document.querySelector("#desc-text");

    editInTitle.value = title;
    editInDesc.innerText = desc;

    // let editInBtn = document.querySelector(".edit-in-edit-btn");
    // editInBtn.addEventListener("click", () => {
    //   title.innerText = editInTitle.value;
    //   desc.innerText = editInDesc.innerText;
    //   console.log("edit IN is clicked");;
    // })
    let idEdit = document.querySelector("#idEdit")
    idEdit.value = e.target.id;
    console.log(idEdit.value);

    // let idDelete = document.querySelector("#idDelete");
    // idDelete.value = e.target.id;
    // console.log(idDelete.value);
  })
})

let deleteBtn = document.querySelectorAll('.deleteBtn');

Array.from(deleteBtn).forEach((element) => {

  element.addEventListener("click", (e) => {


    let tr = e.target.parentNode.parentNode;
    let title = tr.getElementsByTagName("td")[1].innerText;
    let desc = tr.getElementsByTagName("td")[2].innerText;

    console.log(e, tr, title, desc);

    let idDelete = document.querySelector("#idDelete");
    idDelete.value = e.target.id;
    console.log(idDelete.value);

    let deleteAlertInnerDiv = document.querySelector(".alertInnerDiv");
    deleteAlertInnerDiv.innerHTML = ` Note Title : <p class="d-inline-flex gap-1">
                <button class="btn btn-warning" type="button" data-bs-toggle="collapse"
                  data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                  ${title}
                </button>
              </p> will be deleted.
              <div class="collapse" id="collapseExample">
                <div class="card card-body">
                  ${desc}
                </div>
              </div>`;

  })
})
