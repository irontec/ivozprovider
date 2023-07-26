import axios from 'axios';
import { Action, action, Thunk, thunk } from 'easy-peasy';

import { AppStore } from '../index';

export interface EntityAcl {
  iden: string;
  create: boolean;
  read: boolean;
  update: boolean;
  delete: boolean;
}

export enum ClientFeatures {
  'queues' = 'queues',
  'recordings' = 'recordings',
  'faxes' = 'faxes',
  'friends' = 'friends',
  'conferences' = 'conferences',
}

export interface AboutMe {
  vpbx: boolean;
  residential: boolean;
  retail: boolean;
  wholesale: boolean;
  billingInfo: boolean;
  restricted: boolean;
  acls: Array<EntityAcl>;
  features: Array<string>;
}

export type AboutMeState = {
  profile: AboutMe | null;
};

interface AboutMeActions {
  setProfile: Action<AboutMeState, AboutMe>;
  resetProfile: Action<AboutMeState>;
  init: Thunk<AboutMeStore>;
  load: Thunk<AboutMeStore, undefined, unknown, AppStore>;
}

export type AboutMeStore = AboutMeActions & AboutMeState;

const Acls: AboutMeStore = {
  profile: null,
  // actions
  setProfile: action<AboutMeState, AboutMe>((state, profile) => {
    state.profile = profile;
  }),
  resetProfile: action<AboutMeState>((state) => {
    localStorage.removeItem('profile');
    state.profile = null;
  }),
  init: thunk<AboutMeStore>(async (actions) => {
    const profile = localStorage.getItem('profile') as string | undefined;
    if (profile) {
      actions.setProfile(JSON.parse(profile) as AboutMe);
    }
  }),
  // thunks
  load: thunk<AboutMeStore, undefined, unknown, AppStore>(
    async (actions, payload, { getStoreActions }) => {
      const storeActions = getStoreActions();

      try {
        const apiGet = storeActions.api.get;
        const cancelTokenSource = axios.CancelToken.source();

        await apiGet({
          path: '/my/profile',
          params: {},
          cancelToken: cancelTokenSource.token,
          successCallback: async (response) => {
            localStorage.setItem(
              'profile',
              JSON.stringify(response as AboutMe)
            );
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

export default Acls;
