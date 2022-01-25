import auth, { AuthStore } from './auth';
import spec, { SpecStore } from './apiSpec';
import api, { ApiStore } from './api';
import route, { RouteStore } from './route';
import clientSession, { ClientSessionStore } from './clientSession';
import { createStore, createTypedHooks } from 'easy-peasy';

export interface AppStore {
  auth: AuthStore,
  spec: SpecStore,
  api: ApiStore,
  route: RouteStore,
  clientSession: ClientSessionStore
}

const storeModel: AppStore = {
  auth,
  spec,
  api,
  route,
  clientSession
}

const store = createStore<AppStore>(storeModel);

export default store;

const {
  useStoreActions,
  useStoreState,
  useStoreDispatch,
  useStore
} = createTypedHooks<AppStore>();

export {
  useStoreActions,
  useStoreState,
  useStoreDispatch,
  useStore
};