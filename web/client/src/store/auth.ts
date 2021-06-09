import { action, thunk } from 'easy-peasy';
import ApiClient from 'services/Api/ApiClient';

const auth = {
  token: null,

  // actions
  resetToken: action((state: any, token: string) => {
    sessionStorage.removeItem('token');
    state.token = null;
  }),

  setToken: action((state: any, token: string) => {

    if (token) {
        sessionStorage.setItem('token', token);
    } else {
        sessionStorage.removeItem('token');
    }

    ApiClient.setToken(token);
    state.token = token;
  }),

  init: thunk(async (actions:any) => {
    actions.setToken(
      sessionStorage.getItem('token')
    );
  })
};

export default auth;
