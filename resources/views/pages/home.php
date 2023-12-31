<div id="app">
  <div class="flex p-2 items-center w-full space-x-3">
    Manage Users
  </div>
 
  <div>
    <button class="bg-pink-500 text-white active:bg-pink-600 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" 
      v-on:click="openModalNewUser()">
      Add New User
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
          <form action="../../app/Actions/User/StoreUserAction.php" @submit.prevent="modal.action">
            <div class="relative p-6 flex-auto">
              <div>
                <label for="name">Name:</label>
                <input v-model="user.name"class="p-2 m-2 border border-gray-600 rounded-lg" name="name" type="text">
              </div>
              <div>
                <label for="cpf">CPF:</label>
                <input v-model="user.cpf" class="p-2 m-2 border border-gray-600 rounded-lg" name="cpf" type="text">
              </div>
              <div>
                <label for="sex">Sex</label>
                <select v-model="user.sex" class="p-2 m-2 border border-gray-600 rounded-lg" name="sex">
                  <option value="" disabled selected>Selecione</option>
                  <option value="0">Feminino</option>
                  <option value="1">Masculino</option>
                </select>
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
          <th scope="col" class="px-6 py-4">Nome</th>
          <th scope="col" class="px-6 py-4">CPF</th>
          <th scope="col" class="px-6 py-4">Sexo</th>
          <th scope="col" class="px-6 py-4">CEP</th>
          <th scope="col" class="px-6 py-4">Logradouro</th>
          <th scope="col" class="px-6 py-4">Bairro</th>
          <th scope="col" class="px-6 py-4">Cadastrado Em</th>
          <th scope="col" class="px-6 py-4">Status</th>
          <th scope="col" class="px-6 py-4">Actions</th>
        </tr>
      </thead>
      <tbody class="border-b bg-gray-50 dark:border-neutral-500">
        <tr
          class="hover:bg-gray-200"
          v-for="user in users"
          :key="user.id"
        >
          <!-- <td class="whitespace-nowrap px-6 py-4 font-medium">{{ showEvent.id }}</td> -->
          <td class="px-6 py-4">{{ user.name }}</td>
          <td class="px-6 py-4">{{ user.cpf }}</td>
          <td class="px-6 py-4">{{ user.sex ? 'Masculino' : 'Feminino' }}</td>
          <td class="px-6 py-4">{{ user.cep ?? '-' }}</td>
          <td class="px-6 py-4">{{ user.logradouro ?? '-' }}</td>
          <td class="px-6 py-4">{{ user.bairro ?? '-' }}</td>
          <td class="px-6 py-4">{{ user.created_at }}</td>
          <td class="px-6 py-4">{{ user.active ? 'active' : 'inactive' }}</td>
          <td class="whitespace-nowrap px-6 py-4 space-x-3">
            
            <a
              :href=`address.php?id=${user.id}`
              class="bg-sky-800 hover:bg-sky-700 text-white font-bold py-2 px-4 rounded inline-flex items-center"
            >
              Manage Address
            </a>
            <button
              @click="openModalEditUser(user)"
              class="bg-green-800 hover:bg-green-700 text-white font-bold py-2 px-4 rounded inline-flex items-center"
            >
              Edit
            </button>
            <button
              @click="deleteUser(user.id)"
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
  const users = ref({});
  const user = ref({
    name: '',
    cpf: '',
    sex: ''
  });
  const modal = ref({
    title: '',
    action: '',
    description: '',
  })
  const urlStore = "../../app/Actions/User/StoreUserAction.php"
  const urlUpdate = "../../app/Actions/User/UpdateUserAction.php"
  const urlDelete = "../../app/Actions/User/DeleteUserAction.php"
  const urlGet = "../../app/Actions/User/GetUsersAction.php"

  const toggleModal = async () => showModal.value = !showModal.value
  
  const openModalNewUser = () => {
    modal.value.title = "New User"
    modal.value.action = createUser
    modal.value.description = "SAVE"
    toggleModal()
  }
  const openModalEditUser = (u) => {
    user.value = u
    modal.value.title = `Edit User: ${user.value.name}`
    modal.value.action = editUser
    modal.value.description = "UPDATE"
    toggleModal()
  }

  const editUser = async () => {
    if(!window.confirm('Are you sure?')) {
      return;
    }
    const data = {
      'user': user.value
    }
    user.value = {}
    try {
      const response = await fetch(urlUpdate, {
        method: "POST",
        body: JSON.stringify(data),
        headers: {
          "Content-Type":  'application/x-www-form-urlencoded',
        }
      })
      .then(() => getUsers())
      .then(() => toggleModal())
    } catch(error) {
      console.log(error) //doing something into msg flash
    }
  }

  const deleteUser = async (userId) => {
    if(!window.confirm('Are you sure?')) {
      return;
    }
    const data = {
      user:{
        id: userId
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
      .then(() => getUsers())
    } catch(error) {
      console.log(error) //doing something into msg flash
    }
  }

  const createUser = async () => {
    const data = {
      'user': user.value
    }
    user.value = {}
    try {
      const response = await fetch(urlStore, {
        method: "POST",
        body: JSON.stringify(data),
        headers: {
          "Content-Type":  'application/x-www-form-urlencoded',
        }
      })
      await response.json()
        .then(() => getUsers())
        .then(() => toggleModal())
    } catch(error) {
      console.log(error) //doing something into msg flash
    }
  }


  
  const getUsers = async () => {
    try {
      const response = await fetch(urlGet)
      users.value = await response.json()
      // console.log(await response.json()) // doing something into msg flash
    } catch(error) {
      console.log(error) //doing something into msg flash
    }
  }

  onMounted(() => {
    getUsers()
  })
  return {
    showModal,
    toggleModal,
    openModalNewUser,
    openModalEditUser,
    modal,
    users,
    user,
    deleteUser,
  }
  }
}).mount('#app')
</script>
