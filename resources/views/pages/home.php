<div id="app">
  <div class="flex p-2 items-center w-full space-x-3">
    Manage Users
  </div>
 
  <div>
    <button class="bg-pink-500 text-white active:bg-pink-600 font-bold uppercase text-sm px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" v-on:click="toggleModal()">
      Add New User
    </button>
    <div v-if="showModal" class="overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center flex">
      <div class="relative w-auto my-6 mx-auto max-w-3xl">
        <!--content-->
        <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
          <!--header-->
          <div class="flex items-start justify-between p-5 border-b border-solid border-slate-200 rounded-t">
            <h3 class="text-3xl font-semibold">
              Modal Title
            </h3>
            <button class="p-1 ml-auto bg-transparent border-0 text-black opacity-5 float-right text-3xl leading-none font-semibold outline-none focus:outline-none" v-on:click="toggleModal()">
              <span class="bg-transparent text-black opacity-5 h-6 w-6 text-2xl block outline-none focus:outline-none">
                ×
              </span>
            </button>
          </div>
          <!--body-->
          <div class="relative p-6 flex-auto">
            <p class="my-4 text-slate-500 text-lg leading-relaxed">
              I always felt like I could do anything. That’s the main
              thing people are controlled by! Thoughts- their perception
              of themselves! They're slowed down by their perception of
              themselves. If you're taught you can’t do anything, you
              won’t do anything. I was taught I could do everything.
            </p>
          </div>
          <!--footer-->
          <div class="flex items-center justify-end p-6 border-t border-solid border-slate-200 rounded-b">
            <button class="text-red-500 bg-transparent border border-solid border-red-500 hover:bg-red-500 hover:text-white active:bg-red-600 font-bold uppercase text-sm px-6 py-3 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" v-on:click="toggleModal()">
              Close
            </button>
            <button class="text-red-500 background-transparent font-bold uppercase px-6 py-2 text-sm outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" v-on:click="toggleModal()">
              Save Changes
            </button>
          </div>
        </div>
      </div>
    </div>
    <div v-if="showModal" class="opacity-25 fixed inset-0 z-40 bg-black"></div>
  </div>

  <div>
  <table class="table-auto w-full text-center text-sm font-light">
      <thead>
        <tr class="border-b font-medium dark:border-neutral-500 dark:text-neutral-800">
          <th scope="col" class="px-6 py-4">#</th>
          <th scope="col" class="px-6 py-4">Nome</th>
          <th scope="col" class="px-6 py-4">CPF</th>
          <th scope="col" class="px-6 py-4">Sexo</th>
          <th scope="col" class="px-6 py-4">CEP</th>
          <th scope="col" class="px-6 py-4">Logradouro</th>
          <th scope="col" class="px-6 py-4">Bairro</th>
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
          <td colspan="2" class="w-64 whitespace-nowrap px-6 py-4">
            <img 
             
            >
          </td>
          <td class="px-6 py-4"></td>
          <td class="px-6 py-4"></td>
          <td class="px-6 py-4"></td>
          <td class="px-6 py-4"></td>
          <td class="px-6 py-4"></td>
          <td class="px-6 py-4"></td>
          <td class="whitespace-nowrap px-6 py-4 space-x-3">
            
              Edit
            
            <a
              href="../../app/Actions/DeleteuserAction.php"
              class="bg-red-800 hover:bg-red-700 text-white font-bold py-2 px-4 rounded inline-flex items-center"
            >
              Delete
            </a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

</div>


<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>
const { createApp, ref } = Vue
createApp({
  setup() {
  const showModal = ref(false)
  const users = ref([]);

  const toggleModal = () => showModal.value = !showModal.value
  const getUsers = async () => {
   
    const ajax = new XMLHttpRequest();
    ajax.open("GET", 'app/Controllers/HomeController.php', true);

    ajax.onreadystatechange = function () {
        if (this.readyState == 4) {
            if (this.status == 200) {
                console.log(this.responseText);
            }
        }
    };

    const formData = new FormData(form);
    ajax.send(formData);
  }
  return {
    showModal,
    toggleModal,
    users
  }
  }
}).mount('#app')
</script>
