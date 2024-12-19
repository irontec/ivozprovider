import axios from 'axios';
import { Action, action, Thunk, thunk } from 'easy-peasy';

import { AppStore } from '../index';

export interface Status {
  companyDomain: string;
  companyName: string;
  extensionNumber: string;
  gsQRCode: boolean;
  ipRegistered: string;
  language: string;
  terminalName: string;
  terminalPassword: string;
  userAgent: string;
  userName: string;
  voiceMail: string;
  registered?: boolean;
  features: Array<
    | 'queues'
    | 'recordings'
    | 'faxes'
    | 'friends'
    | 'conferences'
    | 'billing'
    | 'invoices'
    | 'progress'
    | 'residential'
    | 'wholesale'
    | 'retail'
    | 'vpbx'
  >;
}

export type StatusState = {
  profile: Status | null;
};

interface StatusActions {
  setProfile: Action<StatusState, Status>;
  resetProfile: Action<StatusState>;
  init: Thunk<StatusStore>;
  load: Thunk<StatusStore, undefined, unknown, AppStore>;
}

export type StatusStore = StatusActions & StatusState;

const Status: StatusStore = {
  profile: null,
  // actions
  setProfile: action<StatusStore, Status>((state, profile) => {
    state.profile = profile;
  }),
  resetProfile: action<StatusStore>((state) => {
    localStorage.removeItem('profile');
    state.profile = null;
  }),
  init: thunk<StatusStore>(async (actions) => {
    const profile = localStorage.getItem('profile') as string | undefined;
    if (profile) {
      actions.setProfile(JSON.parse(profile) as Status);
    }
  }),
  // thunks
  load: thunk<StatusStore, undefined, unknown, AppStore>(
    async (actions, payload, { getStoreActions }) => {
      const storeActions = getStoreActions();

      try {
        const apiGet = storeActions.api.get;
        const cancelToken = axios.CancelToken.source();

        await apiGet({
          path: '/my/status',
          params: {},
          cancelToken: cancelToken.token,
          successCallback: async (response) => {
            localStorage.setItem('profile', JSON.stringify(response as Status));
            actions.init();
          },
        });
      } catch (error) {
        storeActions.auth.setToken(null);
        storeActions.api.setErrorMsg('Unable to load ACLs');
      }
    }
  ),
};

export default Status;
