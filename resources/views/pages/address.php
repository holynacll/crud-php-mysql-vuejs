<div id="app">
  <input hidden id="userId" value="<?php echo $_GET['id']; ?>">
  <div class="flex p-2 mb-12 items-center w-full space-x-3">
    <a
      class="bg-sky-500 text-white active:bg-sky-600 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
      href="../../index.php"
    >
    HOME
    </a>
   <h2 class="text-xl">Manage Address From {{ user.name }}</h2>
  </div>
 
  <div>
    <button class="bg-pink-500 text-white active:bg-pink-600 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" 
      v-on:click="openModalNewAddress()">
      Add New Address
    </button>
    <div v-if="showModal" class="overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center flex">
      <div class="relative w-auto my-6 mx-auto max-w-3xl">
        <!--content-->
        <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
          <!--header-->
          <div class="flex items-start justify-between p-5 border-b border-solid border-slate-200 rounded-t">
            <h3 class="text-3xl font-semibold">
              {{ modal.title }}
            </h3>
            <button class="p-1 ml-auto bg-transparent border-0 text-black opacity-5 float-right text-3xl leading-none font-semibold outline-none focus:outline-none" v-on:click="toggleModal()">
              <span class="bg-transparent text-black opacity-5 h-6 w-6 text-2xl block outline-none focus:outline-none">
                ×
              </span>
            </button>
          </div>
          <!--body-->
          <form action="../../app/Actions/User/StoreAddressAction.php" @submit.prevent="modal.action">
            <div class="relative p-6 flex-auto">
              <div>
                <label for="logradouro">Logradouro:</label>
                <input v-model="address.logradouro"class="p-2 m-2 border border-gray-600 rounded-lg" name="logradouro" type="text">
              </div>
              <div>
                <label for="bairro">Bairro:</label>
                <input v-model="address.bairro" class="p-2 m-2 border border-gray-600 rounded-lg" name="bairro" type="text">
              </div>
              <div>
                <label for="cep">CEP:</label>
                <input v-model="address.cep" class="p-2 m-2 border border-gray-600 rounded-lg" name="cep" type="text">
              </div>
            </div>
            <!--footer-->
            <div class="flex items-center justify-end p-6 border-t border-solid border-slate-200 rounded-b">
              <button class="text-red-500 bg-transparent border border-solid border-red-500 hover:bg-red-500 hover:text-white active:bg-red-600 font-bold uppercase text-sm px-6 py-3 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" v-on:click="toggleModal()">
                Close
              </button>
              <button
                type="submit"
                class="text-red-500 background-transparent font-bold uppercase px-6 py-2 text-sm outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button"
              >
                {{ modal.description }}
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div v-if="showModal" class="opacity-25 fixed inset-0 z-40 bg-black"></div>
  </div>

  <div>
  <table class="table-auto w-full text-center text-sm font-light">
      <thead>
        <tr class="border-b font-medium dark:border-neutral-500 dark:text-neutral-800">
          <th scope="col" class="px-6 py-4">Logradouro</th>
          <th scope="col" class="px-6 py-4">Bairro</th>
          <th scope="col" class="px-6 py-4">CEP</th>
          <th scope="col" class="px-6 py-4">Cadastrado Em</th>
          <th scope="col" class="px-6 py-4">Status</th>
          <th scope="col" class="px-6 py-4">Actions</th>
        </tr>
      </thead>
      <tbody class="border-b bg-gray-50 dark:border-neutral-500">
        <tr
          class="hover:bg-gray-200"
          v-for="address in addresses"
          :key="address.id"
        >
          <!-- <td class="whitespace-nowrap px-6 py-4 font-medium">{{ showEvent.id }}</td> -->
          <td class="px-6 py-4">{{ address.logradouro }}</td>
          <td class="px-6 py-4">{{ address.bairro }}</td>
          <td class="px-6 py-4">{{ address.cep }}</td>
          <td class="px-6 py-4">{{ address.created_at }}</td>
          <td class="px-6 py-4">{{ address.active ? 'active' : 'inactive' }}</td>
          <td class="whitespace-nowrap px-6 py-4 space-x-3">
            <button
              @click="openModalEditAddress(address)"
              class="bg-green-800 hover:bg-green-700 text-white font-bold py-2 px-4 rounded inline-flex items-center"
            >
              Edit
            </button>
            <button
              @click="deleteAddress(address.id)"
              class="bg-red-800 hover:bg-red-700 text-white font-bold py-2 px-4 rounded inline-flex items-center"
            >
              Delete
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
<script>
const { createApp, ref, onMounted } = Vue
createApp({
  setup() {
  const showModal = ref(false)
  const addresses = ref({});
  const address = ref({
    logradouro: '',
    bairro: '',
    cep: '',
    user_id: '',
  })
  const user = ref({
    id: '',
    name: '',
    cpf: '',
    sex: ''
  });
  const modal = ref({
    title: '',
    action: '',
    description: '',
  })
  const urlStore = "../../app/Actions/Address/StoreAddressAction.php"
  const urlUpdate = "../../app/Actions/Address/UpdateAddressAction.php"
  const urlDelete = "../../app/Actions/Address/DeleteAddressAction.php"
  const urlGet = "../../app/Actions/Address/GetAddressesByUserIdAction.php"
  const urlGetUser = "../../app/Actions/User/GetUserByIdAction.php"

  const toggleModal = async () => showModal.value = !showModal.value
  
  const openModalNewAddress = () => {
    modal.value.title = "New Address"
    modal.value.action = createAddress
    modal.value.description = "SAVE"
    toggleModal()
  }
  const openModalEditAddress = (a) => {
    address.value = a
    modal.value.title = `Edit Address: ${address.value.logradouro} - ${address.value.bairro}`
    modal.value.action = editAddress
    modal.value.description = "UPDATE"
    toggleModal()
  }

  const editAddress = async () => {
    if(!window.confirm('Are you sure?')) {
      return;
    }
    address.value.user_id = user.value.id
    const data = {
      'address': address.value
    }
    address.value = {}
    try {
      const response = await fetch(urlUpdate, {
        method: "POST",
        body: JSON.stringify(data),
        headers: {
          "Content-Type":  'application/x-www-form-urlencoded',
        }
      })
      .then(() => getAddressesByUserId())
      .then(() => toggleModal())
    } catch(error) {
      console.log(error) //doing something into msg flash
    }
  }

  const deleteAddress = async (addressId) => {
    if(!window.confirm('Are you sure?')) {
      return;
    }
    const data = {
      address:{
        id: addressId
      } 
    }
    try {
      const response = await fetch(urlDelete, {
        method: "POST",
        body: JSON.stringify(data),
        headers: {
          "Content-Type":  'application/x-www-form-urlencoded',
        }
      })
      .then(() => getAddressesByUserId())
    } catch(error) {
      console.log(error) //doing something into msg flash
    }
  }

  const createAddress = async () => {
    address.value.user_id = user.value.id
    const data = {
      'address': address.value
    }
    address.value = {}
    try {
      const response = await fetch(urlStore, {
        method: "POST",
        body: JSON.stringify(data),
        headers: {
          "Content-Type":  'application/x-www-form-urlencoded',
        }
      })
      await response.json()
        .then(() => getAddressesByUserId())
        .then(() => toggleModal())
    } catch(error) {
      console.log(error) //doing something into msg flash
    }
  }
  
  const getAddressesByUserId = async () => {
    const url = urlGet+'?id='+user.value.id
    try {
      const response = await fetch(url)
      const data = await response.json()
      addresses.value = data.addresses
      // console.log(await response.json()) // doing something into msg flash
    } catch(error) {
      console.log(error) //doing something into msg flash
    }
  }

  const initUser = async () => {
    const e = document.getElementById("userId")
    const id = e.value
    try {
      const response = await fetch(urlGetUser+'?id='+id)
      // console.log(await response.json())
      const data = await response.json()
      user.value = data.user
      // console.log(await response.json()) // doing something into msg flash
    } catch(error) {
      console.log(error) //doing something into msg flash
    }
  }

  onMounted(() => {
    initUser()
      .then(() => getAddressesByUserId())
  })
  return {
    showModal,
    toggleModal,
    openModalNewAddress,
    openModalEditAddress,
    modal,
    address,
    addresses,
    user,
    deleteAddress,
  }
  }
}).mount('#app')
</script>
