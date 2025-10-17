import { defineStore } from 'pinia'

export const useAuthStotre = defineStore('authStore', {
  state: () => {
    return {
      user: 'seb',
    }
  },

  getters: {},

  actions: {
    async authenticate(apiRoute, formData) {
     try{
      const res = fetch(`/api/${apiRoute}`, {
        method: 'post',
        body: JSON.stringify(formData),
      })
      const data = await res.json()
      console.log(data);

      if (!res.ok) {

            const errorData = (await res).json();
            throw new Error(errorData.message || 'Authentication failed');
        }
     }catch(error){
      console.error('Authentication error:', error);
     }

    },
  },
})
