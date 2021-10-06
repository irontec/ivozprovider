import { action, Action, Thunk, thunk } from 'easy-peasy';
import ApiClient from 'lib/services/api/ApiClient';


interface authStoreState {
  token: string | null,
}

interface authStoreActions {

  resetToken: Action<authStoreState, null>,
  setToken: Action<authStoreState, string>,
  init: Thunk<() => Promise<void>>
}

const auth: authStoreActions & authStoreState = {
  token: null,

  // actions
  resetToken: action((state: any) => {
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

  init: thunk(async (actions: any) => {
    actions.setToken(
      sessionStorage.getItem('token')
    );
  })
};

export default auth;
