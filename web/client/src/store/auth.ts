import { action, Action, Thunk, thunk } from 'easy-peasy';
import ApiClient from 'lib/services/api/ApiClient';

interface AuthState {
  token: string | null,
}

interface AuthActions {
  resetToken: Action<AuthState, null>,
  setToken: Action<AuthState, string>,
  init: Thunk<() => Promise<void>>
}

export type AuthStore = AuthActions & AuthState;

const auth = {
  token: null,

  // actions
  resetToken: action<AuthState>((state: any) => {
    sessionStorage.removeItem('token');
    state.token = null;
  }),

  setToken: action<AuthState, string>((state: any, token: string) => {

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
