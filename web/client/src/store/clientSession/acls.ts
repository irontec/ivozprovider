import { action, Action, Thunk, thunk } from 'easy-peasy';
import axios from 'axios';
import { AppStore } from '../index';

interface EntityAcl {
  iden: string,
  create: boolean,
  read: boolean,
  update: boolean,
  delete: boolean
}

export interface Profile {
  pbx: boolean,
  residential: boolean,
  retail: boolean,
  wholesale: boolean,
  restricted: boolean,
  acls: Array<EntityAcl>
}

export type AclsState = {
  profile: Profile | null,
}

interface AclsActions {
  setProfile: Action<AclsState, Profile>,
  load: Thunk<AclsStore, undefined, unknown, AppStore>,
  init: Thunk<AclsStore>,
}

export type AclsStore = AclsActions & AclsState;

const Acls: AclsStore = {
  profile: null,
  // actions
  setProfile: action<AclsState, Profile>((state, profile) => {
    state.profile = profile;
  }),

  // thunks
  load: thunk<AclsStore, undefined, unknown, AppStore>(async (actions, payload, { getStoreActions }) => {

    const storeActions = getStoreActions();

    try {

      const apiGet = storeActions.api.get;
      const cancelTokenSource = axios.CancelToken.source();

      await apiGet({
        path: '/my/profile',
        params: {},
        cancelToken: cancelTokenSource.token,
        successCallback: async (response: any) => {
          sessionStorage.setItem(
            'profile',
            JSON.stringify(response as Profile)
          );
          actions.init();
        }
      });

    } catch (error: any) {

      storeActions.auth.setToken(null);
      storeActions.api.setErrorMsg('Unable to load ACLs');
    }
  }),
  init: thunk<AclsStore>(async (actions) => {
    const profile = sessionStorage.getItem('profile') as string | undefined;
    if (profile) {
      actions.setProfile(JSON.parse(profile) as Profile);
    }
  }),
};

export default Acls;
