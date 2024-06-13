import { CancelToken } from 'axios';
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
  load: Thunk<StatusStore, CancelToken, unknown, AppStore>;
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
  // thunks
  load: thunk<StatusStore, CancelToken, unknown, AppStore>(
    async (actions, cancelToken, { getStoreActions, getState }) => {
      const storeActions = getStoreActions();

      const request = async () => {
        try {
          const apiGet = storeActions.api.get;

          await apiGet({
            path: '/my/status',
            params: {},
            cancelToken: cancelToken,
            successCallback: async (response) => {
              const oldStatus = JSON.stringify(getState().profile);
              const newStatus = JSON.stringify(response as Status);

              if (newStatus === oldStatus) {
                return;
              }

              actions.setProfile(response as Status);
            },
          });
        } catch (error) {
          storeActions.auth.setToken(null);
          storeActions.api.setErrorMsg('Unable to load ACLs');
        }
      };

      const reqLoop = () => {
        request()
          .catch((error) => {
            throw error;
          })
          .finally(() => {
            if (cancelToken.reason) {
              return;
            }

            setTimeout(reqLoop, 60000);
          });
      };

      reqLoop();
    }
  ),
};

export default Status;
